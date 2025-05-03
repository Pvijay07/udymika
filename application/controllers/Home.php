<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('crud_model', 'crud_model');
	}

	public function index()
	{
		$data['title'] = 'Login | Udyamika';
		$this->load->view('signin', $data);

	}

	public function test()
	{

		$data['title'] = 'Login | Udyamika';

		$this->load->view('test', $data);

	}

	public function mandals()
	{

		$district = $this->input->post("district");
		$mandals = $this->crud_model->select("mandals", ["district_id" => $district, "status" => 1], "name ASC");

		$options =  '<select name="mandal" class="mandal">';
		$options .= '<option value="">Select Mandal</option>';

		foreach($mandals as $mandal){
			$options .= '<option value="'.$mandal->id.'">'.$mandal->name.'</option>';
		}

		$options .= '</select>';

		echo $options;

	}


	public function villages()
	{

		$mandal = $this->input->post("mandal");
		$villages = $this->crud_model->select("villages", ["mandal_id" => $mandal, "status" => 1], "name ASC");


		$options =  '<select name="gram_panchayath" class="village">';
		$options .= '<option value="">Select Gram Panchayath</option>';

		foreach($villages as $village){
			$options .= '<option value="'.$village->id.'">'.$village->name.'</option>';
		}

		$options .= '</select>';

		echo $options;

	}


	public function login()
	{

		if($this->input->post('submit')){

			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url("login"),'refresh');
			} else {

				$count = $this->crud_model->check_duplicate("users", ["email" => $this->input->post("email")]);

				if($count != 0){


					$user_info = $this->crud_model->select_row("users", ["email" => $this->input->post("email")]);
					$validPassword = password_verify($this->input->post('password'), $user_info->password);

					if($validPassword){

						$user_data = array(
							'user_id' => $user_info->id,
							'user_name' => $user_info->name,
							'user_email' => $user_info->email,
							'user_login' => TRUE
						);

						$this->session->set_userdata($user_data);
						echo "success";
						redirect(base_url('user'));
					} else {
						$this->session->set_flashdata('error', 'Invalid Password');
						$this->session->set_flashdata('error_time', time());

						redirect(base_url('/'));
					}

				} else {
					$this->session->set_flashdata('error', 'Invalid Email');
					$this->session->set_flashdata('error_time', time());
 
					
					redirect(base_url('/'));
				}
			}
		} else {

				$data['title'] = 'Login | Udyamika';
				$this->load->view('signin', $data);
			}
	}




	public function register()
	{
		if($this->session->userdata('user_login'))
		{
			redirect('user');
		}
		$data['title'] = 'Registration | Udyamika';
		$this->load->view('register', $data);
	}

	public function register_otp_send()
	{
		if($this->input->post('phone'))
		{
			$phone = $this->input->post('phone');
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			if(!$this->crud_model->check_duplicate("users", ["phone" => $phone]))
			{
				$otp = rand(1000,9999);
				$data = array(                   
					'otp_phone' => $phone,
					'otp_number' => $otp,
					'otp_type' => 'new_reg',
					'otp_date' => date('Y-m-d h:i:s a')
				);

				$sms = "Dear $name, Thank you for registering with Udyamika. Your mobile number is $phone and your email is $email. Please verify your account. Your OTP is $otp. WEBHUB";
                //$sms = "Dear mahesh, Your grievance with the ticket number $otp is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($phone,$sms,'1507166418626442015');
                if($sendSms)
                {
					if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone]))
					{
						$this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'new_reg'], ["otp_phone" => $phone]);
						$res['response'] = '1';
						$res['message'] = 'OTP Sent Successfully!';
						//$res['otp'] = $otp;
					}
					else
					{
						$result = $this->crud_model->insert('otp_verify', $data);
						if($result){
							$res['response'] = '1';
							$res['message'] = 'OTP Sent Successfully!';
							//$res['otp'] = $otp;
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
					$res['message'] = 'Failed to send OTP try agian.';
				}
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Mobile number already exists. Please login or click on Forgot Password';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Enter all fields are required.';
		}
		echo json_encode($res);
		 
	}

	public function register_verify_otp()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]|required');
            $this->form_validation->set_rules('phone', 'Phone No', 'trim|is_unique[users.phone]|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) 
			{
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url("user_register"),'refresh');
			}
			else 
			{
				$phone = $this->input->post('phone');
				$kyc_id = "UDY".rand(100000,999999);
                $otp = rand(1000,9999);
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $phone,
                    'kyc_id' => $kyc_id,
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'otp' => $otp,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => "1",
                    'is_verify' => 1
                );
                if(!$this->crud_model->check_duplicate("users", ["phone" => $phone]))
                {
					if($this->crud_model->insert('users', $data))
					{
						$this->crud_model->update("otp_verify", ["otp_type"=>"used"], ["otp_phone" => $phone]);
						$user_info = $this->crud_model->select_row("users", ["phone" => $phone]);
						$this->session->set_userdata('user_id',$user_info->id);
						$this->session->set_userdata('user_name',$user_info->name);
						$this->session->set_userdata('user_email',$user_info->email);
						$this->session->set_userdata('user_login',TRUE);
						redirect(base_url('user'));
					}
                    else
					{
						redirect(base_url('register'));
					}
                }
                else
                {
                    redirect(base_url('register'));
                }
			}
		} 
		else 
		{
			$data['title'] = 'Registration | Udyamika';
			$this->load->view('register', $data);
		}
	}

	public function forgot()
	{
		$data['title'] = 'Forgot Password | Udyamika';
		$this->load->view('forgot-password', $data);
	}

	public function forgot_password()
	{
		if($this->input->post('mobile'))
		{
			$phone = $this->input->post('mobile');
			if($this->crud_model->check_duplicate("users", ["phone" => $this->input->post("mobile")]))
			{
				$usrDetails = $this->crud_model->select_row("users", ["phone" => $this->input->post("mobile")]);
				$otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $phone,
                    'otp_number' => $otp,
                    'otp_type' => 'for_pass',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
				$sms = "Dear $usrDetails->name, Forgot your password, No Problem Use OTP number $otp to reset the password, In case of any more information. Please reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($phone,$sms,'1507166418652673839');
                if($sendSms)
                {
					if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone]))
					{
						$this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'for_pass'], ["otp_phone" => $phone]);
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
					$res['message'] = 'Failed to send OTP enter valid mobile number and try agian.';
				}
				
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Enter register mobile number.';
			}
		} 
		else 
		{
			$res['response'] = '0';
			$res['message'] = 'Enter valid mobile number.';
		}
		echo json_encode($res);
	}
	public function forgot_password_otp_verify()
	{
		if(!empty($this->input->post('mobile')) && (!empty(($this->input->post('otp_code')))) && (!empty(($this->input->post('password')))))
		{
			$phone = $this->input->post('mobile');
			$otp_code = $this->input->post('otp_code');
			$password = $this->input->post('password');

			if($this->crud_model->check_duplicate("users", ["phone" => $this->input->post("mobile")]))
			{ 
				if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone,"otp_number" => $otp_code]))
				{
					if($this->crud_model->update('users', ['password' => password_hash($password, PASSWORD_BCRYPT), 'updated_at' => date("Y-m-d H:i:s")], ["phone" => $phone]))
					{
						$this->crud_model->update("otp_verify", ['otp_type' => 'used'], ["otp_phone" => $phone]);
						$res['response'] = '1';
						$res['message'] = 'Password reset successfully login for access account.';
					}
					else
					{
						$res['response'] = '0';
						$res['message'] = 'Failed to update password try again.';
					}
				}
				else
				{
					$res['response'] = '0';
					$res['message'] = 'Invalid OTP number.';
				}
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Try to invalid method';
			}
		} 
		else 
		{
			$res['response'] = '0';
			$res['message'] = 'Enter valid mobile number.';
		}
		echo json_encode($res);
	}

	public function forgot_password_sucess()
	{
		$data['title'] = 'Fotgot password Completed Successfully | Udyamika';
		$this->load->view('forgot-success', $data);
	}

	public function login_with_contact_number()
	{
		if($this->session->userdata('user_login'))
		{
			redirect('user');
		}
		$data['title'] = 'Login by OTP | Udyamika';
		$this->load->view('login-mobile', $data);
	}

	public function user_login_by_otp()
	{
		if($this->input->post('mobile'))
		{
			$phone = $this->input->post('mobile');
			if($this->crud_model->check_duplicate("users", ["phone" => $this->input->post("mobile")]))
			{
				$usrDetails = $this->crud_model->select_row("users", ["phone" => $this->input->post("mobile")]);
				$otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_log',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                $sms = "Dear $usrDetails->name, We detected an attempt to access your $phone account, Your OTP number for authorized Login is $otp WEHUB";
                //$sms = "Dear mahesh, Your grievance with the ticket number $otp is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($phone,$sms,'1507166418644249650');
                if($sendSms)
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone]))
    				{
    					$this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'new_log'], ["otp_phone" => $phone]);
    					$res['response'] = '1';
    					$res['message'] = 'OTP Sent Successfully!';
    					//$res['otp'] = $otp;
    				}
    				else
    				{
    					$result = $this->crud_model->insert('otp_verify', $data);
    					if($result){
    						$res['response'] = '1';
    						$res['message'] = 'OTP Sent Successfully!';
    						//$res['otp'] = $otp;
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
    				$res['message'] = 'Failed to send OTP try agian.';
                }
                
				
			}
			else
			{
				////register if not in records
				$otp = rand(1000,9999);
                $data = array(                   
                    'otp_phone' => $phone,
                    'otp_number' => $otp,
                    'otp_type' => 'new_reg',
                    'otp_date' => date('Y-m-d h:i:s a')
                );
                $sms = "Dear Applicant, Thank you for registering with Udyamika. Your mobile number is $phone and your email is xxx@gmail.com. Please verify your account. Your OTP is $otp. WEBHUB";
                //$sms = "Dear mahesh, Your grievance with the ticket number $otp is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                $sendSms = get_sms($phone,$sms,'1507166418626442015');
                if($sendSms)
                {
                    if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone]))
    				{
    					$this->crud_model->update("otp_verify", ["otp_number" => $otp,'otp_type' => 'new_reg'], ["otp_phone" => $phone]);
    					$res['response'] = '1';
    					$res['message'] = 'OTP Sent Successfully!';
    					//$res['otp'] = $otp;
    				}
    				else
    				{
    					$result = $this->crud_model->insert('otp_verify', $data);
    					if($result)
    					{
    						$res['response'] = '1';
    						$res['message'] = 'OTP Sent Successfully!';
    						//$res['otp'] = $otp;
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
    				$res['message'] = 'Failed to send OTP try agian.';
                }	
			}
		} 
		else 
		{
			$res['response'] = '0';
			$res['message'] = 'Enter valid mobile number.';
		}
		echo json_encode($res);
	}

	public function user_otp_login_verify()
	{
        if(!empty($this->input->post('mobile_code')) && (!empty(($this->input->post('otp_code')))))
        {
            $phone = $this->input->post('mobile_code');
            $otp = $this->input->post('otp_code');
            $user_info = $this->crud_model->select_row("users", ["phone" => $phone]);
            if($user_info)
            {
                if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone,'otp_type' => 'new_log','otp_number' => $otp]))
                {
					$this->session->set_userdata('user_id',$user_info->id);
                	$this->session->set_userdata('user_name',$user_info->name);
                	$this->session->set_userdata('user_email',$user_info->email);
                	$this->session->set_userdata('user_login',TRUE);
                    $this->crud_model->update("otp_verify", ['otp_type' => 'used'], ["otp_phone" => $phone]);
                    redirect(base_url('user'));
                }
                else 
                {
                    redirect(base_url('login_by_otp'));
                } 
            } 
            else 
            {
				//$phone = $this->input->post('mobile');
				$kyc_id = "UDY".rand(100000,999999);
                //$otp = rand(1000,9999);
                $pwd = date('his');
                $data = array(
                    'name' => 'Guest',
                    'email' => '',
                    'phone' => $phone,
                    'kyc_id' => $kyc_id,
                    'password' => password_hash($pwd, PASSWORD_BCRYPT),
                    'otp' => $otp,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => "1",
                    'is_verify' => 1
                );
                if(!$this->crud_model->check_duplicate("users", ["phone" => $phone]))
                {
					if($this->crud_model->insert('users', $data))
					{
						$user_info = $this->crud_model->select_row("users", ["phone" => $phone]); 
						if($user_info)
						{
							if($this->crud_model->check_duplicate("otp_verify", ["otp_phone" => $phone,'otp_type' => 'new_reg','otp_number' => $otp]))
							{
								$this->session->set_userdata('user_id',$user_info->id);
								$this->session->set_userdata('user_name',$user_info->name);
								$this->session->set_userdata('user_email',$user_info->email);
								$this->session->set_userdata('user_login',TRUE);
								$this->crud_model->update("otp_verify", ['otp_type' => 'used'], ["otp_phone" => $phone]);
								redirect(base_url('user'));
							}
							else 
							{
								redirect(base_url('login_by_otp'));
							} 
						} 
					}
				}
				else
				{
					$data['title'] = 'Login by OTP | Udyamika';
					$this->load->view('login-mobile', $data);
				} 
            }
		} 
        else 
        {
            $data['title'] = 'Login by OTP | Udyamika';
			$this->load->view('login-mobile', $data);
		}
	}


	public function success()
	{
		$data['title'] = 'Registration Completed Successfully | Udyamika';
		$this->load->view('register-success', $data);
	}

	public function user_pass_update()
	{
		$data['title'] = 'Password update | Udyamika';
		$this->load->view('pass-update', $data);
	}

	public function user_password_submited(){
		$user_id = $this->session->userdata('user_id');
		if(!empty($this->input->post('old_password')) && (!empty($this->input->post('new_password')) && (!empty($this->input->post('confirm_password')))))
		{
			$user_info = $this->crud_model->select_row("users", ["id" => $user_id]); 
			//$passCount = $this->crud_model->check_duplicate("users",["id"=>$user_id,"password"=>password_verify($this->input->post('old_password'), $user_info->password)]);
			if($this->crud_model->select_row("users", ["id" => $user_id]))
			{
				if($this->input->post('new_password') == $this->input->post('confirm_password'))
				{
					if($this->crud_model->update("users",["password"=>password_hash($this->input->post('new_password'), PASSWORD_BCRYPT),"updated_at"=>date('Y-m-d h:i:s a')],["id"=>$user_id]))
					{
						$this->session->set_flashdata('pass_msg','Password updated successfully');
						redirect(base_url('password_update'));
					}
					else
					{
						$this->session->set_flashdata('pass_msg','Failed to update password');
						redirect(base_url('password_update'));
					}
				}
				else
				{
					$this->session->set_flashdata('pass_msg','Both the password not match');
					redirect(base_url('password_update'));
				}
			}
			else
			{
				$this->session->set_flashdata('pass_msg','Old password is invalid');
				redirect(base_url('password_update'));
			}
		}
		else
		{
			$this->session->set_flashdata('pass_msg','All fields are required');
			redirect(base_url('password_update'));
		}
	}

	public function user_grievance_status_update(){
		$user_id = $this->session->userdata('user_id');
		if(!empty($this->input->post('ticket')) && (!empty($this->input->post('status_type'))))
		{
			if($this->crud_model->update("grievance",["status"=>$this->input->post('status_type')],['grievance_id'=>$this->input->post('ticket')]))
			{
			    $tickt = $this->input->post('ticket');
				$user_info = $this->crud_model->select_row("users", ["id" => $user_id]);
				if($this->input->post('status_type') == 'Closed'){
					$sms = "Dear $user_info->name, Your grievance with the ticket number$tickt is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418766838662');
				}
				if($this->input->post('status_type') == 'Review'){
					$sms = "Dear $user_info->name, Your grievance with the ticket number $tickt is progress. Please login into your dashboard for the comments from our executive. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418759787173');
				}
				
				$res['response'] = '1';
				$res['message'] = 'Update successfully'; 
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Failed to update.';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid id.';
		}
		echo json_encode($res);
	}


}