<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/leads_model', 'leads_model');
		$this->load->model('admin/user_model', 'user_model'); 
		$this->load->model('admin/dashboard_model', 'dashboard_model'); 
		// load CSV library
        $this->load->library('CSVReader');
	}

	public function index(){

		$data['title'] = 'Reports';
		$data['users'] = $this->dashboard_model->get_users();
		$data['start'] = "";
		$data['end'] = "";
		$this->load->view('admin/reports',$data);

	}

	public function search(){

		if($this->input->post('submit')){

			$data['start'] = $this->input->post("start")." 00:00:00";;
			$data['end'] = $this->input->post("end")." 23:59:59";
			$data['users'] = $this->dashboard_model->get_users();
			$this->load->view('admin/reports',$data);
		}

	}



	

	

}


	?>