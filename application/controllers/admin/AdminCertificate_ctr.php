<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCertificate_ctr extends My_Controller {

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
		$this->load->library('pdf');
		$this->load->model('admin/AdminCertificateModal', 'certificate_modal');
    }


	//--------------------------------------------------------------------------
	public function index()
	{
		$status = '1';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_certificate?');
    	$config['total_rows'] = $this->certificate_modal->get_certificate_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_certificate_list($params,$status);
        $data['sub'] = $this->certificate_modal->certificate_status_count('1');
        $data['process'] = $this->certificate_modal->certificate_status_count('2');
        $data['verify'] = $this->certificate_modal->certificate_status_count('3');
        $data['inter'] = $this->certificate_modal->certificate_status_count('4');
        $data['app'] = $this->certificate_modal->certificate_status_count('5');
        $data['rej'] = $this->certificate_modal->certificate_status_count('6');
        $data['hold'] = $this->certificate_modal->certificate_status_count('7');
		$this->load->view('admin/certificate/certificate_list', $data);	
	}	
	public function progress_list()
	{

		$status = '2';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_certificate_progess?');
    	$config['total_rows'] = $this->certificate_modal->get_certificate_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_certificate_list($params,$status);

		$data['sub'] = $this->certificate_modal->certificate_status_count('1');
        $data['process'] = $this->certificate_modal->certificate_status_count('2');
        $data['verify'] = $this->certificate_modal->certificate_status_count('3');
		var_dump($data['verify']);
        $data['inter'] = $this->certificate_modal->certificate_status_count('4');
        $data['app'] = $this->certificate_modal->certificate_status_count('5');
        $data['rej'] = $this->certificate_modal->certificate_status_count('6');
        $data['hold'] = $this->certificate_modal->certificate_status_count('7');

		$this->load->view('admin/certificate/certificate_prog_list', $data);	
	}	
	public function field_verify_list()
	{
		$status = '3';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_certificate_verify?');
    	$config['total_rows'] = $this->certificate_modal->get_certificate_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_certificate_list($params,$status);
		$data['sub'] = $this->certificate_modal->certificate_status_count('1');
        $data['process'] = $this->certificate_modal->certificate_status_count('2');
        $data['verify'] = $this->certificate_modal->certificate_status_count('3');
        $data['inter'] = $this->certificate_modal->certificate_status_count('4');
        $data['app'] = $this->certificate_modal->certificate_status_count('5');
        $data['rej'] = $this->certificate_modal->certificate_status_count('6');
        $data['hold'] = $this->certificate_modal->certificate_status_count('7');

		$this->load->view('admin/certificate/certificate_verify_list', $data);	
	}	
	public function interview_schedule_list()
	{
		$status = '4';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_certificate_interview?');
    	$config['total_rows'] = $this->certificate_modal->get_certificate_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_certificate_list($params,$status);
		
		$data['sub'] = $this->certificate_modal->certificate_status_count('1');
		$data['process'] = $this->certificate_modal->certificate_status_count('2');
        $data['verify'] = $this->certificate_modal->certificate_status_count('3');
        $data['inter'] = $this->certificate_modal->certificate_status_count('4');
        $data['app'] = $this->certificate_modal->certificate_status_count('5');
        $data['rej'] = $this->certificate_modal->certificate_status_count('6');
        $data['hold'] = $this->certificate_modal->certificate_status_count('7');

		$this->load->view('admin/certificate/interview_schedule', $data);	
	}	

	public function rest_certificate_list()
	{
		if($this->input->get('type') == 'Approved')
		{
			$appStatus = '5';
		}
		elseif($this->input->get('type') == 'Rejected')
		{
			$appStatus = '6';
		}
		elseif($this->input->get('type') == 'On-Hold')
		{
			$appStatus = '7';
		}

		$status = $appStatus;
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_rest_certificate?');
    	$config['total_rows'] = $this->certificate_modal->get_certificate_count($status);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_certificate_list($params,$status);
		//print_r($this->db->last_query());
		$data['sub'] = $this->certificate_modal->certificate_status_count('1');
        $data['process'] = $this->certificate_modal->certificate_status_count('2');
        $data['verify'] = $this->certificate_modal->certificate_status_count('3');
        $data['inter'] = $this->certificate_modal->certificate_status_count('4');
        $data['app'] = $this->certificate_modal->certificate_status_count('5');
        $data['rej'] = $this->certificate_modal->certificate_status_count('6');
        $data['hold'] = $this->certificate_modal->certificate_status_count('7');

		$this->load->view('admin/certificate/certificate_rest_list', $data);	
	}	

	
	public function certificates_details($user_id,$cert_id)
	{
		$data['title'] = 'KYC Details';
		$data['user_info'] = $this->certificate_modal->get_user_details($user_id);
		$data['buss_info'] = $this->certificate_modal->get_user_business($user_id);
		$data['docs_info'] = $this->certificate_modal->get_user_certificate($user_id,$cert_id);
		$data['certficate'] = $this->certificate_modal->get_certificate($cert_id);
		$data['statusRem'] = $this->certificate_modal->get_certificate_status($user_id,$cert_id);
		$data['grivance']  = $this->certificate_modal->get_user_grivances_list($user_id);
		$data['checklist'] = $this->certificate_modal->get_user_check_list($user_id,$cert_id);
		$data['remarks'] = $this->certificate_modal->get_remarks_list($user_id,$cert_id);
		$this->load->view('admin/certificate/certificate_details', $data);	
	}
	public function certificates_details_with_checklist($user_id,$cert_id)
	{
		$data['title'] = 'KYC Details';
		$data['buss_info'] = $this->certificate_modal->get_user_business($user_id);
		$data['user_info'] = $this->certificate_modal->get_user_details($user_id);
		$data['docs_info'] = $this->certificate_modal->get_user_certificate($user_id,$cert_id);
		$data['certficate'] = $this->certificate_modal->get_certificate($cert_id);
		$data['statusRem'] = $this->certificate_modal->get_certificate_status($user_id,$cert_id);
		$data['grivance']  = $this->certificate_modal->get_user_grivances_list($user_id);
		$data['checklist'] = $this->certificate_modal->get_user_check_list($user_id,$cert_id);
		$data['remarks'] = $this->certificate_modal->get_remarks_list($user_id,$cert_id);
		$this->load->view('admin/certificate/certificate_check_detail', $data);	
	}

	public function certificates_assign_sub_admin()
	{
		if(!empty($this->input->post('certSts')) && (!empty($this->input->post('checklist'))) && (!empty($this->input->post('admin'))))
		{
			$user_id = $this->input->post('user');
			$user_info = $this->db->query("SELECT name,phone FROM users WHERE id = '$user_id'")->row();

			if($this->input->post('certSts') == '2'){
				$sms = "Dear $user_info->name, Your Enterprise Application is at the Document Verification Stage. You can also view it on your dashboard, Login: www.udyamika.telangana.gov.in WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}
			if($this->input->post('certSts') == '3'){
				$sms = "Dear $user_info->name, Your documents are verified and are at the Field Verification Stage. A field officer will visit your unit in {#var#} business days. You can also view it on your dashboard, Login: www.udyamika.telangana.gov.in WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}
			if($this->input->post('certSts') == '4'){
				$sms = "Dear $user_info->name, Your Enterprise Application cleared the Field Verification. We have scheduled an interview with you. Please login in to the dashboard for more details WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}
			if($this->input->post('certSts') == '5'){
				$sms = "Dear $user_info->name, Congratulations! Your Enterprise Application is verified and the Certificate is Issued. Please login in to the dashboard for more details WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}
			if($this->input->post('certSts') == '6'){
				$sms = "Dear $user_info->name, Your Enterprise Application is rejected. Please login into your dashboard for more details. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}
			if($this->input->post('certSts') == '7'){
				$sms = "Dear $user_info->name, Your Enterprise Application is on Hold. Please login in to the dashboard for the remarks Login: www.udyamika.telangana.gov.in WEHUB";
				$sendSms = get_sms($user_info->phone,$sms,'1507166418718967852');
			}

			$array = array(
				'certi_id' => $this->input->post('cert_id'),
				'user_id' => $this->input->post('user'),
				'sub_admin' => $this->input->post('admin'),
				'certi_status' => $this->input->post('certSts'),
				'checklist' => $this->input->post('checklist'),
				'remark' => $this->input->post('remark'),
				'assign_date' => date('Y-m-d h:i:s a')
			);
			if(!$this->certificate_modal->check_duplicates("certificate_admin_allot",['certi_id' => $this->input->post('cert_id'),'user_id' => $this->input->post('user')]))
			{
			    $this->certificate_modal->add_certificate_sts($array);
				$this->certificate_modal->update_certificate_sts("option3",['certficationStatus'=>'2','subAdmin'=>$this->input->post('admin'),'updateTime'=>date('Y-m-d H:i:s')],['id' => $this->input->post('cert_id')]);
				$cert_id = $this->input->post('cert_id');
				$dataSts =  array(
					'update_by' => '2',
					'update_user_id' => $this->input->post('user'),
					'statusManage' => $this->input->post('certSts'),
					'statusType' => 'In Process',
					'statusRemark' => $this->input->post('remark'),
					'user_id' => $this->input->post('user'),
					'application_id' => $this->input->post('cert_id'),
					'create_at' => date('Y-m-d h:i:s a'),
					'application_num' => $this->db->query("SELECT certificate_num FROM option3 WHERE id = '$cert_id'")->row_array()['certificate_num'],
				);
				$this->certificate_modal->insert('status_manage_tbl',$dataSts);
				$res['response'] = '1';
				$res['message'] = 'Sub admin assign successfully';
			}
			else
			{
			    $updates = array(
    				'sub_admin' => $this->input->post('admin'),
    				'certi_status' => '2',
    				'checklist' => $this->input->post('checklist'),
    				'remark' => $this->input->post('remark'),
    				'create_at' => date('Y-m-d h:i:s a')
    			);
			    $this->certificate_modal->update_certificate_sts("certificate_admin_allot",$updates,['certi_id' => $this->input->post('cert_id'),'user_id' => $this->input->post('user')]);
			    $this->certificate_modal->update_certificate_sts("option3",['certficationStatus'=>'2','subAdmin'=>$this->input->post('admin'),'updateTime'=>date('Y-m-d H:i:s')],['id' => $this->input->post('cert_id')]);
				$res['response'] = '1';
				$res['message'] = 'Sub admin assign updated successfully';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Invalid request select all fields';
		}
		echo json_encode($res);
	}
	public function interview_schedule_status_upd()
	{
		if(!empty($this->input->post('certificate_status')) && (!empty($this->input->post('cert_id'))))
		{
			if (!empty($_FILES['file_upload']['name'])) {
				$filePath = upload_file('file_upload','document/'.date('d-m-Y'));
			}
			else{ 
				$filePath = ''; 
			}

			$cert_id = $this->input->post('cert_id');
			$dataSts =  array(
				'update_by' => '2',
				'update_user_id' => $this->input->post('user'),
				'statusManage' => $this->input->post('certificate_status'),
				'statusType' => 'Interview Schedule',
				'statusRemark' => $this->input->post('remarks'),
				'user_id' => $this->input->post('user'),
				'application_id' => $this->input->post('cert_id'),
				'create_at' => date('Y-m-d h:i:s a'),
				'application_num' => $this->db->query("SELECT certificate_num FROM option3 WHERE id = '$cert_id'")->row_array()['certificate_num'],
			);
			if($this->certificate_modal->insert('status_manage_tbl',$dataSts))
			{
				$this->certificate_modal->update_certificate_sts("option3",['certficationStatus'=>$this->input->post('certificate_status'),'updateTime'=>date('Y-m-d H:i:s')],['id' => $this->input->post('cert_id')]);
				$fileArray = array(
					'name' => 'Interview Schedule',
					'file_name' => $filePath,
					'user_id' => $this->input->post('user'),
					'certficate_id' => $this->input->post('cert_id'),
					'created_at' => date('Y-m-d h:i:s a')
				);
				$this->certificate_modal->insert('documents',$fileArray);
				$this->session->set_flashdata('met_msg','file update successfully');
				redirect(base_url('master_certif_check_detail/'.$this->input->post('user').'/'.$this->input->post('cert_id')));
			}
			else
			{
				$this->session->set_flashdata('met_msg','Failed to update status');
				redirect(base_url('master_certif_check_detail/'.$this->input->post('user').'/'.$this->input->post('cert_id')));
			}
		}
		else
		{
			$this->session->set_flashdata('met_msg','Invalid parameter');
			redirect(base_url('master_certif_check_detail/'.$this->input->post('user').'/'.$this->input->post('cert_id')));
		}
	}

	public function certificate_downloads()
	{
		$res['tblRow'] = $this->input->post('certificate');
		$file_name = date('Ymdhis').".pdf";
        $html = $this->load->view('admin/certificate/download', $res, true);
        $this->pdf->createPDF($html, $file_name, true);
        
	}
}

?>