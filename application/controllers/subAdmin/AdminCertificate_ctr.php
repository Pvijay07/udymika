<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminCertificate_ctr extends My_Controller {

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
		$this->load->library('pdf');
		$this->load->model('subAdmin/AdminCertificateModal', 'certificate_modal');
    }


	//--------------------------------------------------------------------------
	 
	public function progress_list()
	{
		$admin_id = $this->session->userdata('sub_admin_id');
		$sts = '2';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config = $this->config->item('pagination');
		$config['base_url'] = site_url('master_certificate_progess?');
		$config['total_rows'] = $this->certificate_modal->get_all_certificate_count($admin_id,$sts);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['certi_list'] = $this->certificate_modal->get_all_certificate($params,$admin_id,$sts);
		//print_r($this->db->last_query());
		$data['assign'] = $this->certificate_modal->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'2']);
		$data['verify'] = $this->certificate_modal->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'3']);
		$this->load->view('subAdmin/certificate/certificate_prog_list', $data);	
	}	
	public function field_verify_list()
	{
		$admin_id = $this->session->userdata('sub_admin_id');
		$sts = '3';
		$data['title'] = 'Certificate List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_certificate_verify?');
    	$config['total_rows'] = $this->certificate_modal->get_all_certificate_count($admin_id,$sts);
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->certificate_modal->get_all_certificate($params,$admin_id,$sts);

		$data['assign'] = $this->certificate_modal->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'2']);
		$data['verify'] = $this->certificate_modal->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'3']);

		//print_r($this->db->last_query());
		$this->load->view('subAdmin/certificate/certificate_verify_list', $data);	
	}	
	 

	public function certificates_details($user_id,$app_id)
	{
		$data['title'] = 'In process details';
		$data['user_info'] = $this->certificate_modal->get_user_details($user_id);
		$data['docs_info'] = $this->certificate_modal->get_user_certificate($user_id,$app_id);
		$data['buss_info'] = $this->certificate_modal->get_user_business($user_id);
		$data['checklist'] = $this->certificate_modal->get_user_check_list($user_id,$app_id);
		//print_r($this->db->last_query());
		$data['grivance']  = $this->certificate_modal->get_user_grivances_list($user_id);
		$data['remarks']  = $this->certificate_modal->get_remarks_list($user_id,$app_id);
		$data['certficate'] = $this->certificate_modal->get_certificate($app_id);
		$this->load->view('subAdmin/certificate/certificate_details', $data);	
	}	
	public function certificates_verify_details($user_id,$app_id)
	{
		$data['title'] = 'Verify details';
		$data['user_info'] = $this->certificate_modal->get_user_details($user_id);
		$data['docs_info'] = $this->certificate_modal->get_user_certificate($user_id,$app_id);
		$data['buss_info'] = $this->certificate_modal->get_user_business($user_id);
		$data['checklist'] = $this->certificate_modal->get_user_check_list($user_id,$app_id);
		$data['grivance']  = $this->certificate_modal->get_user_grivances_list($user_id);
		$data['remarks']  = $this->certificate_modal->get_remarks_list($user_id,$app_id);
		$data['certficate'] = $this->certificate_modal->get_certificate($app_id);
		$this->load->view('subAdmin/certificate/verify_details', $data);	
	}	

	public function subadmin_verify_status_upd()
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
			$user_id = $this->input->post('user');
			$appNum = $this->db->query("SELECT certificate_num FROM option3 WHERE id = '$cert_id'")->row_array()['certificate_num'];
			$user_info = $this->db->query("SELECT name,phone FROM users WHERE id = '$user_id'")->row();
			$dataSts =  array(
				'update_by' => '2',
				'update_user_id' => $this->input->post('user'),
				'statusManage' => $this->input->post('certificate_status'),
				'statusType' => 'Application Verify',
				'statusRemark' => $this->input->post('remarks'),
				'user_id' => $this->input->post('user'),
				'application_id' => $this->input->post('cert_id'),
				'create_at' => date('Y-m-d h:i:s a'),
				'application_num' => $appNum,
			);
			if($this->certificate_modal->insert('status_manage_tbl',$dataSts))
			{
				$this->certificate_modal->update_certificate_sts("option3",['certficationStatus'=>$this->input->post('certificate_status')],['id' => $this->input->post('cert_id')]);
				//print_r($this->db->last_query());
				$fileArray = array(
					'name' => 'Application Verify',
					'file_name' => $filePath,
					'user_id' => $this->input->post('user'),
					'certficate_id' => $this->input->post('cert_id'),
					'created_at' => date('Y-m-d h:i:s a')
				);
				$this->certificate_modal->insert('documents',$fileArray);
				if($this->input->post('certificate_status') == '3'){
					$sms = "Dear $user_info->name, Your Enterprise Application cleared the Field Verification. We have scheduled an interview with you. Please login in to the dashboard for more details WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418735551689');
				}
				if($this->input->post('certificate_status') == '6'){
					$sms = "Dear $user_info->name, Your Enterprise Application is rejected. Please login into your dashboard for more details. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418735551689');
				}

				$this->session->set_flashdata('met_msg','file update successfully');
				redirect(base_url('admin_certificate_progess'));
				 
			}
			else
			{
				$this->session->set_flashdata('met_msg','Failed to update status');
				redirect(base_url('admin_certificate_progess'));
			}
		}
		else
		{
			$this->session->set_flashdata('met_msg','Invalid parameter');
			redirect(base_url('admin_certificate_progess'));
		}
	}

	public function subadmin_verify_app_status()
	{
		$data['title'] = 'Application verify';
		//1 = radio, 2= text, 3 = image, 4 = video, 5 = remarks;
		$this->form_validation->set_rules('question_id', 'Question', 'trim|required');
		$this->form_validation->set_rules('application_id', 'Application id', 'trim|required');
		$this->form_validation->set_rules('user_id', 'User id', 'trim|required');
		if ($this->form_validation->run()) 
		{
		    $this->session->set_flashdata('met_msg','Fill required fields');
			redirect(base_url('admin_certificate_progess'));
		}
		else
		{
			if (!empty($_FILES['upload_image']['name'])) {
				$filePath = upload_file('upload_image','document/'.date('d-m-Y'));
			}
			else{ 
				$filePath = ''; 
			}

			if (!empty($_FILES['video_file']['name'])) {
				$videoPath = upload_file('video_file','document/'.date('d-m-Y'));
			}
			else{ 
				$videoPath = ''; 
			}

			$question_id = $this->input->post('question_id');
			$verify_remarks = $this->input->post('verify_remarks');
			$application_id = $this->input->post('application_id');
			//$queType = $this->input->post('queType');
			//$user_id = $this->input->post('user_id');
			
			foreach($question_id as $key=>$ques)
			{
				$queType = $this->db->query("SELECT queType FROM checklist_question_tbl WHERE q_id = '$ques'")->row_array()['queType'];
				//print_r($this->db->last_query());
				if($queType == 1)
				{
					$textAns = $this->input->post('process_checklist_'.$ques);
				}
				elseif($queType == 2)
				{
					$textAns = $this->input->post('text_answer_'.$ques);
				}
				elseif($queType == 3)
				{
					$textAns = $filePath;
				}
				elseif($queType == 4)
				{
					$textAns = $videoPath;
				}
				elseif($queType == 5)
				{
					$textAns = $verify_remarks;
				}

				$verifyList = array(
					'app_id' =>  $this->input->post('application_id'),
					'user_id' =>  $this->input->post('user_id'),
					'checklist_id' =>  $this->input->post('checklist_id'),
					'ques_id' =>  $ques,
					'ques_ans' =>  $textAns,
					'verify_at' =>  date('Y-m-d'),
					'verify_by' => '2',
					'verify_admin_id' => $this->session->userdata('sub_admin_id')
				);
				$this->certificate_modal->insert_data('admin_verify_tbl',$verifyList);
			}

			 
		    if(!empty($filePath))
			{
				$fileArray = array(
					'name' => 'Application Verify docs',
					'file_name' => $filePath,
					'user_id' => $this->input->post('user_id'),
					'certficate_id' => $this->input->post('application_id'),
					'created_at' => date('Y-m-d h:i:s a')
				);
				$this->certificate_modal->insert('documents',$fileArray);
			}
			if(!empty($videoPath))
			{
				$fileArray = array(
					'name' => 'Application Verify video',
					'file_name' => $videoPath,
					'user_id' => $this->input->post('user_id'),
					'certficate_id' => $this->input->post('application_id'),
					'created_at' => date('Y-m-d h:i:s a')
				);
				$this->certificate_modal->insert('documents',$fileArray);
			}
			
			// if(!empty($verify_remarks))
			// {
			//     $dataSts =  array(
			// 		'update_by' => '2',
			// 		'update_user_id' => $this->session->userdata('sub_admin_id'),
			// 		'statusManage' => $this->input->post('cert_status'),
			// 		'statusType' => 'sub_admin_remark',
			// 		'statusRemark' => $this->input->post('verify_remarks'),
			// 		'user_id' => $this->input->post('user_id'),
			// 		'application_id' => $this->input->post('application_id'),
			// 		'create_at' => date('Y-m-d h:i:s a'),
			// 		'application_num' => $this->db->query("SELECT certificate_num FROM option3 WHERE id = '$application_id'")->row_array()['certificate_num'],
			// 	);
			// 	$allUpdates = $this->certificate_modal->insert('status_manage_tbl',$dataSts);
			// }
				
			
			$this->session->set_flashdata('met_msg','Data submited successfully');
			redirect(base_url('admin_certificate_details/'.$this->input->post('user_id').'/'.$this->input->post('application_id')));

		}
	}

	public function ticket_query_replay(){
		if($this->input->post('submit')){
			$id = $this->session->userdata("sub_admin_id");
			if (!empty($this->session->userdata("sub_admin_id")))
			{
				if (!empty($_FILES['fileInsert']['name'])) {
					$filePath = upload_file('fileInsert','grievances/'.date('d-m-Y'));
				}
				else{ 
					$filePath = ''; 
				}

				$data = array(
					'greivances_id' => $this->input->post('ticketId'),
					'user_id' => $this->input->post('ticketUserId'),
					'user_type' => 'sub admin',
					'contents' => $this->input->post("queryDetails"),
					'added_at' => date("Y-m-d h:i:s a"),
					'added_time' => date("h:i:s a"),
					'admin_id' => '0',
					'sub_admin' => $id,
					'app_id' => $this->input->post("ticketAppId"),
					'fileUpoads' =>$filePath
				);
				$result = $this->certificate_modal->insert('greivances_chat_tbl', $data);
				if($result)
				{
					$this->session->set_flashdata('msg', 'Your query submited successfully!');
					redirect(base_url($this->input->post('pageId').'/'.$this->input->post('ticketUserId').'/'.$this->input->post('ticketAppId')));
				}
				
			} 
			else 
			{
				$this->session->set_flashdata('msg', 'session expire login agian');
				redirect(base_url($this->input->post('pageId').'/'.$this->input->post('ticketUserId').'/'.$this->input->post('ticketAppId')));
			}
		}
	}

	public function admin_get_chat_replay()
	{
		if($this->input->post('ticket'))
		{
			$ticket = $this->input->post('ticket');
			$user_id = $this->input->post('user_id');
			$grievence = $this->db->query("select * from greivances_chat_tbl where greivances_id =  '$ticket' order by g_id asc")->result_array();
			if($grievence)
			{
				$userPic = $this->db->query("select userPic from users where id =  '$id'")->row_array()['userPic'];
				$chats = '';
				foreach($grievence as $rows)
				{
					if(!empty($rows['fileUpoads'])){
						$dwnLink = base_url($rows['fileUpoads']);
						$icon = base_url("assets/images/new-download-icon.png");
						$dwnIcon = "<a href='$dwnLink' download><img src='$icon' class='downlChatIcon'></a>";
						$dwnIconAd = "<a href='$dwnLink' download><img src='$icon' class='downlChatIconAd'></a>";
					}else{
						$dwnIcon = '';
						$dwnIconAd = '';
					}


					$img = base_url("assets/images/logo-cht-icon.png");
					if(file_exists($userPic)){ 
						$userImg = base_url($userPic); 
					} else { $userImg = $img; }

					$desc = $rows['contents'];
					$upd = $rows['added_at'];
					$user_type = $rows['user_type'];
					
					if($user_type == 'sub admin'){
					$chats .= '<div class="query-cht query-chts">
					<div class="cht-img">
						<img src="'.$img.'" alt="" />
					</div>
					<div>
						<p>'.$desc.'</p>
						 
						<strong>Updated on '.$dwnIconAd.''.$upd.'</strong>
					</div>
				</div>';
					}else{
						$chats .= '<div class="query-cht">
					<div class="cht-img">
						<img src="'.$img.'" alt="" />
					</div>
					<div>
						<p>'.$desc.'</p>
						 
						<strong>Updated on '.$upd.''.$dwnIcon.'</strong>
					</div>
				</div>';
					}
				}
				$res['response'] = '1';
				$res['message'] = 'Chatting list avail.';
				$res['chat'] = $chats;
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'No Chat.';
			}
		} 
		else 
		{
			$res['response'] = '0';
			$res['message'] = 'Chat not available.';
		}
		echo json_encode($res);
	}

	public function get_certificate_pdf_download()
	{
		$res['tblRow'] = $this->input->post('certificate');
		$file_name = date('Ymdhis').".pdf";
        $html = $this->load->view('subAdmin/certificate/download', $res, true);
        $this->pdf->createPDF($html, $file_name, true);
	}

	
	public function admin_grievance_sts_update()
	{
		if(!empty($this->input->post('ticket')) && (!empty($this->input->post('status_type'))))
		{
			if($this->certificate_modal->update_certificate_sts('grievance',['status'=>$this->input->post('status_type'),'updated_at'=>date('Y-m-d h:i:s a'),'admin_id'=>$this->input->post('admin_id'),'user_type'=>'admin'],['grievance_id'=>$this->input->post('ticket')]))
			{
				$user_id = $this->input->post('user_id');
				$tickt = $this->input->post('ticket');
				$user_info = $this->db->query("select name,phone from users where id = '$user_id'")->row();
				if($this->input->post('status_type') == 'Closed'){
					$sms = "Dear $user_info->name, Your grievance with the ticket number$tickt is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418766838662');
				}

				if($this->input->post('status_type') == 'Review'){
					$sms = "Dear $user_info->name, Your grievance with the ticket number $tickt is progress. Please login into your dashboard for the comments from our executive. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
					$sendSms = get_sms($user_info->phone,$sms,'1507166418759787173');
				}

				$res['response'] = '1';
				$res['message'] = 'Status Updated successfully.';
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
			$res['message'] = 'Invalid request.';
		}
		echo json_encode($res);
	}
	
	
}

?>