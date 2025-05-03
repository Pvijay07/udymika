<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->library('mailer');
		$this->load->model('lvl_model');
    $this->load->library('session');

	}

	//--------------------------------------------------------------
	public function index(){

		// if(!empty($this->session->userdata('l2_id')))
        // {
        //     redirect(base_url('lvl2_dashboard'));
        // }
		$this->form_validation->set_rules('email', 'Login email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
            
        if($this->form_validation->run()===true)
        {
            $user = $this->lvl_model->login($this->input->post('email'),$this->input->post('password'),'3');
            if(!empty($user))
            {
                $this->session->set_userdata('l3_id',$user->id);
                redirect(base_url('lvl3_dashboard'));
            }
            else
            {
              $this->session->set_flashdata('incorrect_credential','Incorrect Email Or Password');
              $this->load->view('L3/signin');
            }
        }

        else
        {
			$this->load->view('L3/signin');
        }

	}
 

		//-----------------------------------------------------------------------
		public function logout(){
			$this->session->sess_destroy();
			redirect(base_url('l3_signin'), 'refresh');
		}

	}  
