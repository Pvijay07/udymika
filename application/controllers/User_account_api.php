<?php
require APPPATH . '/libraries/REST_Controller.php';
class User_account_api extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('admin/User_model', 'user_model');
        $this->load->model('Crud_model', 'crud_model'); 
    }

    public function index()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        //print_r($postdata);
		if(!empty($postdata))
        {
            $email = $postdata->email;
            $password = $postdata->password;
            $user_info = $this->crud_model->select_row("users", ["email" => $email]);
            $validPassword = password_verify($password, $user_info->password);
            if($validPassword)
            {
                $user_data = array(
                    'user_id' => $user_info->id,
                    'user_name' => $user_info->name,
                    'user_login' => TRUE
                );
                $res['datas'] = $user_data;
                $res['response'] = '1';
                $res['message'] = 'Login succussfully';
            } 
            else 
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid email or password enter valid details.';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}

    public function register()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        //print_r($postdata);
		if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->name, 'Name', 'trim|required');
            $this->form_validation->set_rules($postdata->email, 'Email', 'trim|valid_email|is_unique[users.email]|required');
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|is_unique[users.phone]|required');
            $this->form_validation->set_rules($postdata->password, 'Password', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {
                $kyc_id = "UDY".rand(100000,999999);
                $otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $postdata->phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_reg',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                $sms = "Dear $postdata->name, Thank you for registering with Udyamika. Your mobile number is $postdata->phone and your email is $postdata->email. Please verify your account. Your OTP is $otp. WEBHUB";
                $sendSms = get_sms($postdata->phone,$sms,'1507166418626442015');

                if(!$this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone]))
                    {
                        $this->crud_model->update("otp_verify", ["otp_number" => $otp], ["otp_phone" => $postdata->phone]);
                        $res['response'] = '1';
                        $res['message'] = 'OTP Sent Successfully!';
                        $res['otp'] = $otp;
                    }
                    else
                    {
                        $result = $this->crud_model->insert('otp_verify', $data);
                        if($result){
                            $res['response'] = '1';
                            $res['message'] = 'OTP Sent Successfully!';
                            $res['otp'] = $otp;
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to send OTP enter valid mobile number and try agian.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number allready exist please login or forgot password.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}

    public function register_otp_verify()
    {
        $postdata = json_decode( file_get_contents('php://input') ); 
        //print_r($postdata);
		if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|is_unique[users.phone]|required');
            $this->form_validation->set_rules($postdata->password, 'Password', 'trim|required');
            $this->form_validation->set_rules($postdata->otp, 'OTP', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {
                $kyc_id = "UDY".rand(100000,999999);
                $otp = rand(1000,9999);
                $data = array(
                    'name' => $postdata->name,
                    'email' => $postdata->email,
                    'phone' => $postdata->phone,
                    'kyc_id' => $kyc_id,
                    'password' => password_hash($postdata->password, PASSWORD_BCRYPT),
                    'otp' => "",
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => "1",
                    'is_verify' => 1
                );
                if(!$this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if(!$this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone,"otp_number" => $postdata->otp,"otp_type"=>"new_reg"]))
                    {
                        $res['response'] = '0';
                        $res['message'] = 'Invalid OTP enter correct OTP.';
                    }
                    else
                    {
                        $result = $this->crud_model->insert('users', $data);
                        if($result){
                            $this->crud_model->update("otp_verify", ["otp_type"=>"used"], ["otp_phone" => $postdata->phone]);
                            $res['response'] = '1';
                            $res['message'] = 'OTP Verified successfully.';
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to verify OTP.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number allready exist please login or forgot password.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid details.';
		}
        echo json_encode($res);
    }

    public function forgot_password()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $usrDetails = $this->crud_model->select_row("users", ["phone" => $postdata->phone]);
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'ENter valid contact number.';
            }
            else 
            {
                $otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $postdata->phone,
                    'otp_number' => $otp,
                    'otp_type' => 'for_pass',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                $sms = "Dear $usrDetails->name, Forgot your password, No Problem Use OTP number $otp to reset the password, In case of any more information. Please reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($postdata->phone,$sms,'1507166418652673839');

                if($this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone]))
                    {
                        $this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'for_pass'], ["otp_phone" => $postdata->phone]);
                        $res['response'] = '1';
                        $res['message'] = 'OTP Sent Successfully!';
                        $res['otp'] = $otp;
                    }
                    else
                    {
                        $result = $this->crud_model->insert('otp_verify', $data);
                        if($result)
                        {
                            $res['response'] = '1';
                            $res['message'] = 'OTP Sent Successfully!';
                            $res['otp'] = $otp;
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to send OTP enter valid mobile number and try agian.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number not exist.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}

    public function forgot_pass_otp_verify()
    {
        $postdata = json_decode( file_get_contents('php://input') ); 
        //print_r($postdata);
		if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|is_unique[users.phone]|required');
            $this->form_validation->set_rules($postdata->password, 'Password', 'trim|required');
            $this->form_validation->set_rules($postdata->otp, 'OTP', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {
                $data = array(
                    'password' => password_hash($postdata->password, PASSWORD_BCRYPT),
                    'updated_at' => date("Y-m-d H:i:s")
                );
                if($this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if(!$this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone,"otp_number" => $postdata->otp,"otp_type"=>"for_pass"]))
                    {
                        $res['response'] = '0';
                        $res['message'] = 'Invalid OTP enter correct OTP.';
                    }
                    else
                    {
                        $result = $this->crud_model->update('users', ['password' => password_hash($postdata->password, PASSWORD_BCRYPT)], ["phone" => $postdata->phone]);
                        if($result)
                        {
                            $this->crud_model->update("otp_verify", ["otp_type"=>"used"], ["otp_phone" => $postdata->phone]);
                            $res['response'] = '1';
                            $res['message'] = 'OTP verify and password reset successfully.';
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to verify OTP.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number allready exist please login or forgot password.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid details.';
		}
        echo json_encode($res);
    }


    public function login_with_mobile_number()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $usrDetails = $this->crud_model->select_row("users", ["phone" => $postdata->phone]);
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'ENter valid contact number.';
            }
            else 
            {
                $sms = "Dear $usrDetails->name, We detected an attempt to access your $postdata->phone account, Your OTP number for authorized Login is $otp WEHUB";
                $sendSms = get_sms($postdata->phone,$sms,'1507166418644249650');
                $otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $postdata->phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_log',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                if($this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone]))
                    {
                        $this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'new_log'], ["otp_phone" => $postdata->phone]);
                        $res['response'] = '1';
                        $res['message'] = 'OTP Sent Successfully!';
                        $res['otp'] = $otp;
                    }
                    else
                    {
                        $result = $this->crud_model->insert('otp_verify', $data);
                        if($result)
                        {
                            $res['response'] = '1';
                            $res['message'] = 'OTP Sent Successfully!';
                            $res['otp'] = $otp;
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to send OTP enter valid mobile number and try agian.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number not exist. enter register mobile number.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}

    public function login_verify_with_otp()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $phone = $postdata->phone;
            $otp = $postdata->otp;
            $user_info = $this->crud_model->select_row("users", ["phone" => $phone]);
            if($user_info)
            {
                if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone,'otp_type' => 'new_log','otp_number' => $otp]))
                {
                    $user_data = array(
                        'user_id' => $user_info->id,
                        'user_name' => $user_info->name,
                        'user_login' => TRUE
                    );
                    $this->crud_model->update("otp_verify", ['otp_type' => 'used'], ["otp_phone" => $postdata->phone]);
                    $res['datas'] = $user_data;
                    $res['response'] = '1';
                    $res['message'] = 'Login succussfully';
                }
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'Invalid OTP.';
                }
                
            } 
            else 
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid mobile number please enter register mobile number.';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}



    public function register_with_mobile_number()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->phone, 'Phone No', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'ENter valid contact number.';
            }
            else 
            {
                $otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $postdata->phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_reg',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                $sms = "Dear Applicant, Thank you for registering with Udyamika. Your mobile number is $postdata->phone and your email is xxx@gmail.com. Please verify your account. Your OTP is $otp. WEBHUB";
                //$sms = "Dear mahesh, Your grievance with the ticket number $otp is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($postdata->phone,$sms,'1507166418626442015');
                if(!$this->crud_model->check_duplicate("users", ["phone" => $postdata->phone]))
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone]))
                    {
                        $this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'new_reg'], ["otp_phone" => $postdata->phone]);
                        $res['response'] = '1';
                        $res['message'] = 'OTP Sent Successfully!';
                        $res['otp'] = $otp;
                    }
                    else
                    {
                        $result = $this->crud_model->insert('otp_verify', $data);
                        if($result)
                        {
                            $res['response'] = '1';
                            $res['message'] = 'OTP Sent Successfully!';
                            $res['otp'] = $otp;
                        }
                        else
                        {
                            $res['response'] = '0';
                            $res['message'] = 'Failed to send OTP enter valid mobile number and try agian.';
                        }
                    }
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Mobile number allready exist. please login or forgot password.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}

    public function registeration_verify_with_otp()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $phone = $postdata->phone;
            $otp = $postdata->otp;
            $password = date('Ymdhis');
            $kyc_id = "UDY".rand(100000,999999);
            if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone,'otp_type' => 'new_reg','otp_number' => $otp]))
            {
                $user_data = array(
                    'name' => 'Guest',
                    'email' => '',
                    'phone' => $postdata->phone,
                    'kyc_id' => $kyc_id,
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'otp' => $otp,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => "1",
                    'is_verify' => 1
                );
                if($this->crud_model->insert('users', $user_data))
                {
                    $this->crud_model->update("otp_verify", ['otp_type' => 'used'], ["otp_phone" => $postdata->phone]);
                    $user_info = $this->crud_model->select_row("users", ["phone" => $postdata->phone]);
                    $user_rec = array(
                        'user_id' => $user_info->id,
                        'user_name' => $user_info->name,
                        'user_login' => TRUE
                    );

                    $res['datas'] = $user_rec;
                    $res['response'] = '1';
                    $res['message'] = 'Registration succussfully';
                }
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to registeration try again after some time.';
                }
            }
            else 
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid OTP.';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid login details.';
		}
        echo json_encode($res);
	}
     
 
}