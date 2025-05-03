<?php
class Sub_admin_account_api extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('subAdmin/SubAdminApi_model', 'subAdmin_api');
        $this->load->model('Crud_model', 'crud_model'); 
    }

    
    public function admin_login_otp()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $usrDetails = $this->crud_model->select_row("master_login_tbl", ["admin_contact" => $postdata->phone]);
            if (!$postdata->phone) 
            {
                $res['response'] = '0';
                $res['message'] = 'Enter valid contact number.';
            }
            else 
            {
                $otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $postdata->phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_log',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                if($this->crud_model->check_duplicate("master_login_tbl", ["admin_contact" => $postdata->phone]))
                {
                    $sms = "Dear $usrDetails->name, We detected an attempt to access your $postdata->phone account, Your OTP number for authorized Login is $otp WEHUB";
                    $sendSms = get_sms($postdata->phone,$sms,'1507166418644249650');

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

    public function admin_login_verify_otp()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $phone = $postdata->phone;
            $otp = $postdata->otp;
            $user_info = $this->crud_model->select_row("master_login_tbl", ["admin_contact" => $phone]);
            if($user_info)
            {
                if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $postdata->phone,'otp_type' => 'new_log','otp_number' => $otp]))
                {
                    $user_data = array(
                        'admin_id' => $user_info->admin_id,
                        'admin_name' => $user_info->admin_name,
                        'admin_login' => TRUE
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

    public function admin_profile_pic_update()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $admin_id = $postdata->admin_id;
            if(!empty($postdata->admin_id))
            {
                $pictures = $postdata->picture;
                $pic_ext = $postdata->pic_ext;
                $resFile = base64_decode($pictures); 
                $dates = 'profile_'.date('YmdHis'); 
                $resPaths = 'uploads/profile/'.$dates.'.'.$pic_ext;
                if($resFile != false) 
                {
                    $picPfl = $resPaths;
                    file_put_contents($picPfl,$resFile);
                } else {
                    $picPfl = '';
                }

                $user_info = $this->crud_model->update("master_login_tbl", ['admin_profile' => $picPfl], ["admin_id" => $postdata->admin_id]);
                if($user_info)
                {
                    $res['datas'] = $this->crud_model->select_row("master_login_tbl", ["admin_id" => $postdata->admin_id]);
                    $res['response'] = '1';
                    $res['message'] = 'Profile picture updated successfully'; 
                    $res['picUrl'] = base_url(); 
                } 
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to update profile.';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid selection.';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_profile_details()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $admin_id = $postdata->admin_id;
            if(!empty($postdata->admin_id))
            { 
                $subAdmin_info = $this->crud_model->select_row("master_login_tbl", ["admin_id" => $postdata->admin_id]);
                if($subAdmin_info)
                {
                    $res['subAdmin'] = $subAdmin_info;
                    $res['response'] = '1';
                    $res['message'] = 'Profile details'; 
                    $res['picUrl'] = base_url(); 
                } 
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'Id not exist';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id.';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}

}