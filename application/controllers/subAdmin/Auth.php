<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('subAdmin/auth_model', 'auth_model');
	}

	//--------------------------------------------------------------
	public function login(){

		if(!empty($this->session->userdata('sub_admin_id')))
        {
            redirect(base_url('admin_dashboard'));
        }
		$this->form_validation->set_rules('login_email', 'Login email', 'trim|required');
		$this->form_validation->set_rules('login_password', 'Password', 'trim|required');
        if($this->form_validation->run())
        {
            $admin = $this->auth_model->super_admin_login($this->input->post('login_email'),$this->input->post('login_password'));
            if(!empty($admin))
            {
                $this->session->set_userdata('sub_admin_id',$admin->admin_id);
                $this->session->set_userdata('admin_type',$admin->admin_type);
                // $this->session->set_userdata('admin_name',$admin->admin_name);
                // $this->session->set_userdata('admin_email',$admin->admin_email);
                // $this->session->set_userdata('admin_contact',$admin->admin_contact);
                redirect(base_url('admin_dashboard'), 'refresh');
            }
            else
            {
              $this->session->set_flashdata('incorrect_credential','Incorrect Email Or Password');
              $this->load->view('subAdmin/login');
            }
        }
        else
        {
			$this->load->view('subAdmin/login');
        }

	}
 

		//-----------------------------------------------------------------------
		public function logout(){
			$sessions  = array('sub_admin_id');
			foreach($sessions as $sess_key){
				if(!empty($this->session->userdata($sess_key)))
				{
					unset($_SESSION[$sess_key]);
				}
			}
			redirect(base_url('admin_login'), 'refresh');
		}

	}  // end class


?>