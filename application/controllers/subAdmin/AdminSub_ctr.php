<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSub_ctr extends My_Controller {

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
		$this->load->model('subAdmin/AdminSubModal', 'subadmin_modal');
    }

 
    public function sub_admin_listing()
	{
		$data['title'] = 'Sub Admin List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_subadmin?');
    	$config['total_rows'] = $this->subadmin_modal->get_all_subadmin_count();
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['subadmin'] = $this->subadmin_modal->get_all_subadmin($params);
		//print_r($this->db->last_query());
		$this->load->view('subAdmin/subAdmin/index', $data);	
	}	
    public function sub_admin_details($user_id)
	{
		$data['title'] = 'Sub Admin Details';
		$data['admin'] = $this->subadmin_modal->get_subadmin_details($user_id);
		$this->load->view('subAdmin/subAdmin/details', $data);	
	}	
}

?>