<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDistict_ctr extends My_Controller {

	function __construct()
    {
        parent::__construct();
        $allowedAdmin = array('admin_id');
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
						redirect(base_url('master_logout'));
					}
					break;
					case "GET":
					redirect(base_url('master_logout'));
					break;
				}
			}
        }
		if($this->session->userdata('admin_type') != '1')
		{
			redirect(base_url('master_logout'));
		}
		$this->load->model('admin/AdminDistrictModal', 'district_model');
    }


	//--------------------------------------------------------------------------
	public function district_list()
	{
		$data['title'] = 'District List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_district_manage?');
    	$config['total_rows'] = $this->district_model->get_district_count();
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['distric'] = $this->district_model->get_district_list($params);
		//print_r($this->db->last_query());
		$this->load->view('admin/district/dist', $data);	
	}	
	public function manadal_list()
	{
		$data['title'] = 'Mandal List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_manadal_manage?');
    	$config['total_rows'] = $this->district_model->get_manadal_count();
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['mandals'] = $this->district_model->get_manadal_list($params);
		$data['district'] = $this->district_model->get_district_list([]);
		//print_r($this->db->last_query());
		 
		$this->load->view('admin/district/mandal', $data);	
	}	
	public function grampanchayat_list()
	{
		$data['title'] = 'Gram Panchayat List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_gram_manage?');
    	$config['total_rows'] = $this->district_model->get_panchayat_count();
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['panchayat'] = $this->district_model->get_panchayat_list($params);
		$data['mandals'] = $this->district_model->get_manadal_list([]);
		$data['district'] = $this->district_model->get_district_list([]);
		 
		$this->load->view('admin/district/village', $data);	
	}	
	  

	public function add_district()
	{
		if(!empty($this->input->post('dist')))
		{
			$array = array(
				'name' => $this->input->post('dist'),
				'status' => '1'
			);
			if($this->district_model->insert('districts',$array))
			{
				$res['response'] = '1';
				$res['message'] = 'Added successfully';
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Failed to add';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid request select all fields';
		}
		echo json_encode($res);
	}
	public function add_manadal()
	{
		if(!empty($this->input->post('dist')) && (!empty($this->input->post('mandal'))))
		{
			$array = array(
				'name' => $this->input->post('mandal'),
				'district_id' => $this->input->post('dist'),
				'status' => '1'
			);
			if($this->district_model->insert('mandals',$array))
			{
				$res['response'] = '1';
				$res['message'] = 'Added successfully';
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Failed to add';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid request select all fields';
		}
		echo json_encode($res);
	}
	public function add_gram_panchayat()
	{
		if(!empty($this->input->post('dist')) && (!empty($this->input->post('mandal'))))
		{
			$array = array(
				'name' => $this->input->post('vilage'),
				'district_id' => $this->input->post('dist'),
				'mandal_id' => $this->input->post('mandal'),
				'status' => '1'
			);
			if($this->district_model->insert('villages',$array))
			{
				$res['response'] = '1';
				$res['message'] = 'Added successfully';
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Failed to add';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid request select all fields';
		}
		echo json_encode($res);
	}
	 
}

?>