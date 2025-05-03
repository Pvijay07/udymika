<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends My_Controller {

	function __construct()
    {
        parent::__construct();
        $allowedAdmin = array('sub_admin_id');
        $check = array_intersect_key(array_flip($allowedAdmin),($this->session->userdata()));
        if(count($check)<=0)
        {
            $allowed = array();
			if (!in_array($this->router->fetch_method(), $allowed))
			{
				switch($_SERVER['REQUEST_METHOD'])
				{
					case "POST":
					if ($this->input->is_ajax_request())
					{
						$res['response'] = "error";
						$res['message']  = "Session timed out. Please login again";
						echo json_encode($res);
						exit();
					}
					else
					{
						$this->session->set_flashdata('msg','Session timed out. Please login again');
						redirect(base_url('admin_logout'));
					}
					break;
					case "GET":
					redirect(base_url('admin_logout'));
					break;
				}
			}
        }
		if($this->session->userdata('admin_type') != '2')
		{
			redirect(base_url('admin_logout'));
		}
		$this->load->model('subAdmin/Dashboard_model', 'dashboard_model');
    }


	//--------------------------------------------------------------------------
	public function index(){
		$admin_id = $this->session->userdata('sub_admin_id');
		$data['title'] = 'Dashboard';
		$data['assign'] = $this->dashboard_model->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'2']);
		$data['verify'] = $this->dashboard_model->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'3']);
		$data['approve'] = $this->dashboard_model->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'5']);
		$data['reject'] = $this->dashboard_model->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'6']);
		$data['griv_rai'] = $this->dashboard_model->get_application_count("grievance",['status' => 'Raised']);
		$data['griv_comp'] = $this->dashboard_model->get_application_count("grievance",['status' => 'Closed','user_type'=>'admin','admin_id'=>$admin_id]);
		$data['district_wise'] = $this->dashboard_model->dashboardDistrict();
		
		$this->load->view('subAdmin/dashboard', $data);	
	}	

	public function subadmin_passwprd_updates(){
		$admin_id = $this->session->userdata('sub_admin_id');
		$this->load->view('subAdmin/account/index');	
		 
	}
	
	public function subadmin_passwprd_submited(){
		$admin_id = $this->session->userdata('sub_admin_id');
		if(!empty($this->input->post('old_password')) && (!empty($this->input->post('new_password')) && (!empty($this->input->post('confirm_password')))))
		{
			$passCount = $this->dashboard_model->get_application_count("master_login_tbl",["admin_id"=>$admin_id,"admin_password"=>md5($this->input->post('old_password'))]);
			if($passCount == '1')
			{
				if($this->input->post('new_password') == $this->input->post('confirm_password'))
				{
					if($this->dashboard_model->updates("master_login_tbl",["admin_password"=>md5($this->input->post('new_password')),"update_at"=>date('Y-m-d h:i:s a')],["admin_id"=>$admin_id]))
					{
						$this->session->set_flashdata('pass_msg','Password updated successfully');
						redirect(base_url('subAdmin_password'));
					}
					else
					{
						$this->session->set_flashdata('pass_msg','Failed to update password');
						redirect(base_url('subAdmin_password'));
					}
				}
				else
				{
					$this->session->set_flashdata('pass_msg','Both the password not match');
					redirect(base_url('subAdmin_password'));
				}
			}
			else
			{
				$this->session->set_flashdata('pass_msg','Old password is invalid');
				redirect(base_url('subAdmin_password'));
			}
			
		}
		else
		{
			$this->session->set_flashdata('pass_msg','All fields are required');
			redirect(base_url('subAdmin_password'));
		}

	}
		 
}

?>