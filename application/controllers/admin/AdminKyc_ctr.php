<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminKyc_ctr extends My_Controller {

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
		$this->load->model('admin/AdminKycModal', 'kyc_modal');
    }

	
	//--------------------------------------------------------------------------
	public function index()
	{
		// echo phpinfo(); exit;
		 //1= register; 2=submited; 3 = verify; 4 = rejected;
		$status = '2';
		$data['title'] = 'KYC List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_kyc?');
    	$config['total_rows'] = $this->kyc_modal->get_all_kyc_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->kyc_modal->get_all_kyc($params,$status);
		//print_r($this->db->last_query());
		$data['kyc_sub'] = $this->kyc_modal->kyc_count($status);
		$data['kyc_verify'] = $this->kyc_modal->kyc_count('3');  
		$data['kyc_rejected'] = $this->kyc_modal->kyc_count('4');  
		$this->load->view('admin/kyc/kyc_list', $data);	
	}	
	public function kyc_verified()
	{
		$status = '3';
		$data['title'] = 'KYC Verify List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_kyc_verify?');
    	$config['total_rows'] = $this->kyc_modal->get_all_kyc_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->kyc_modal->get_all_kyc($params,$status);
		$data['kyc_sub'] = $this->kyc_modal->kyc_count('2');
		$data['kyc_verify'] = $this->kyc_modal->kyc_count('3');  
		$data['kyc_rejected'] = $this->kyc_modal->kyc_count('4');  
		$this->load->view('admin/kyc/kyc_verify', $data);	
	}	
	public function kyc_rejects()
	{
		$status = '4';
		$data['title'] = 'KYC Verify List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_kyc_rejected?');
    	$config['total_rows'] = $this->kyc_modal->get_all_kyc_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->kyc_modal->get_all_kyc($params,$status);
		$data['kyc_sub'] = $this->kyc_modal->kyc_count('2');
		$data['kyc_verify'] = $this->kyc_modal->kyc_count('3');  
		$data['kyc_rejected'] = $this->kyc_modal->kyc_count('4');  
		$this->load->view('admin/kyc/kyc_rejected', $data);	
	}	

	public function kyc_details($user_id)
	{
		$data['title'] = 'KYC Details';
		$data['user_info'] = $this->kyc_modal->get_user_kyc($user_id);
		$data['kyc_sub'] = $this->kyc_modal->kyc_count('2'); //1= register; 2=submited; 3 = verify; 4 = rejected;
		$data['kyc_verify'] = $this->kyc_modal->kyc_count('3');  
		$data['kyc_rejected'] = $this->kyc_modal->kyc_count('4');  
		$data['certficate'] = $this->kyc_modal->get_certificate($user_id);
		$data['remarks'] = $this->kyc_modal->get_all_remarks($user_id);
		$this->load->view('admin/kyc/kyc_details', $data);	
	}
	
	public function kyc_status_updates()
	{
		if(!empty($this->input->post('user_id')))
		{
			$user_info = $this->kyc_modal->get_user_kyc($this->input->post('user_id'));
			$status = $this->input->post('kyc_status');
			$remasrk = $this->input->post('kyc_remarks');
			$user_id = $this->input->post('user_id');
			$app_num = $this->input->post('app_num');
			$datas =  array(
				'update_by' => '1',
				'update_user_id' => $this->session->userdata('admin_id'),
				'statusManage' => $this->input->post('kyc_status'),
				'statusType' => 'KYC Verif',
				'statusRemark' => $this->input->post('kyc_remarks'),
				'user_id' => $this->input->post('user_id'),
				'application_id' => $user_info->kyc_id,
				'create_at' => date('Y-m-d h:i:s a'),
				'application_num' => ''
			);
			if($this->kyc_modal->update_data('users',['status'=>$status],['id'=>$user_id]))
			{
				$this->kyc_modal->insert_data('status_manage_tbl',$datas);
				if($status == '3')
				{
					$sms = "Dear $user_info->name, Your KYC is successfully verified. Please login to finish the next steps (Website: www.udyamika.telangana.gov.in) WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418675851721');
				}
				if($status == '4')
				{
					$sms = "Dear $user_info->name, Your KYC is rejected. Please login into your dashboard and kindly re-apply (Website: www.udyamika.telangana.gov.in)In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418682865035');
				}
				$res['response'] = '1';
				$res['message'] = 'Status updated successfully.';
				$res['newSts'] = ($this->input->post('kyc_status')=='3')?"Verified":"Rejected";
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Failed to updated status.';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid status selection.';
		}
		echo json_encode($res);
	}
	public function kyc_downloads()
	{
		$this->load->library('pdf');
		$sts = $this->input->post('kyc_sts');
		$tr = '';
		foreach($this->input->post('kyc_list') as $certificate_id)
		{
			$datas = $this->db->query("SELECT users.name,users.email,users.phone,users.adhaar_no,users.created_at,users.updated_at FROM users WHERE id = '$certificate_id'")->row();
			$tr .= "<tr> <td>$datas->name</td> <td>$datas->adhaar_no</td> <td>".date('M d Y', strtotime($datas->updated_at))."</td>  <td>$datas->email </td> <td>$datas->phone </td></tr>";
		}
		$data['tblRow'] = $tr;
		$file_name = date('Ymdhis').".pdf";
        $html = $this->load->view('admin/kyc/download', $data, true);
        $this->pdf->createPDF($html, $file_name, true);
	}
}

?>