<?php defined('BASEPATH') or exit('No direct script access allowed');
class Grievence extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('lvl_model');

    if (!$this->session->userdata('l1_id')) {
      redirect('signin'); 
  }
  // else{
  //   redirect('lvl_dashboard'); 

  }
  public function index()
  {

    $this->load->view('L1/signin');
  }
  public function lvl_grievence()
  {
    $status = 'Open';
    $data['title'] = 'Grievances List';
    $params['limit'] = 20;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('lvl_grievence');
    $config['total_rows'] = $this->lvl_model->get_all_l1__grievence_count($status);
    $config['reuse_query_string'] = TRUE;
    $this->pagination->initialize($config);
    $data['user_details'] = $this->lvl_model->get_l1_grievence($params, $status);
    $data['raised'] = $this->lvl_model->get_all_l1__grievence_count('Open');
    $data['process'] = $this->lvl_model->get_all_l1__grievence_count('Review');
    $data['close'] = $this->lvl_model->get_all_l1__grievence_count('Closed');
    $this->load->view('L1/L1_grievence', $data);
  
  }

  public function progress_list()
  {
    $status = 'Review';
    $data['title'] = 'Progress List';
    $params['limit'] = 20;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('lvl_grievence');
    $config['total_rows'] = $this->lvl_model->get_all_l1__grievence_count($status);
    $config['reuse_query_string'] = TRUE;
    $this->pagination->initialize($config);
    $data['kyc'] = $this->lvl_model->get_l1_grievence($params, $status);
    $data['raised'] = $this->lvl_model->get_all_l1__grievence_count('Open');
    $data['process'] = $this->lvl_model->get_all_l1__grievence_count('Review');
    $data['close'] = $this->lvl_model->get_all_l1__grievence_count('Closed');
    $this->load->view('L1/progress_list', $data);
  }
  public function closed_list()
  {
    $status = 'Closed';
    $data['title'] = 'Close List';
    $params['limit'] = 20;
    $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
    $config = $this->config->item('pagination');
    $config['base_url'] = site_url('lvl_grievence');
    $config['total_rows'] = $this->lvl_model->get_all_l1__grievence_count($status);
    $config['reuse_query_string'] = TRUE;
    $this->pagination->initialize($config);
    $data['kyc'] = $this->lvl_model->get_l1_grievence($params, $status);
    $data['raised'] = $this->lvl_model->get_all_l1__grievence_count('Open');
    $data['process'] = $this->lvl_model->get_all_l1__grievence_count('Review');
    $data['close'] = $this->lvl_model->get_all_l1__grievence_count('Closed');
    $this->load->view('L1/closed_list', $data);
  }
  public function dashboard()
  {
    $data['title'] = 'Dashboard';
    $data['grievence'] = $this->lvl_model->get_all_l1();
    $data['l2'] = $this->lvl_model->get_all_l2();
    $data['l3'] = $this->lvl_model->get_all_l3();
    $data['close'] = $this->lvl_model->get_all_grievence_closed('Closed');
    $this->load->view('L1/L1_dashboard', $data);
  }

  public function lvl_grievance_details($ticket_id, $user_id)
  {

    $status = 'Open';
    $data['title'] = 'Grievances Details';
    $data['user_info'] = $this->lvl_model->get_user_details($user_id);
    $data['docs_info'] = $this->lvl_model->get_user_certificate($user_id);
    $data['grievance'] = $this->lvl_model->get_userl1__grievance($user_id, $status, $ticket_id);
    $data['griev'] = $this->lvl_model->get_grievance_l($ticket_id);
    $data['buss_info'] = $this->lvl_model->get_user_business($user_id);
    $data['certficate'] = $this->lvl_model->get_certificate($user_id);
    $this->lvl_model->update_data('grievance', ['readStatus' => '1'], ['id' => $ticket_id, 'readStatus' => '0']);
    $this->load->view('L1/L1_grivanc_details', $data);
  }
  public function grievance_lvl_update()
  {
    $user_id = $this->input->post('ticketUserId');
    $priority_type = $this->input->post('priority_type'); 
    $status_type = $this->input->post('status_type');
    $tickt = $this->input->post('ticket'); 
    $querydetails = $this->input->post('queryDetails');
    $this->lvl_model->update_data('grievance', ['status' => $status_type, 'priority' => $priority_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
    $this->lvl_model->update_data('l1_grievance', ['status' => $status_type, 'priority' => $priority_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
    $user_info = $this->db->query("select name,email,phone from users where id = '$user_id'")->row();
    $grevience = $this->db->query("select subject,query_type,user_id,status,content,file,created_at from grievance where grievance_id = '$tickt'")->row();
    $msg = "";
    $data = array(
      'grievance_id' => $tickt,
      'subject' => $grevience->subject,
      'user_id' => $grevience->user_id,
      'query_type' => $grevience->query_type,
      'content' => $grevience->content,
      'created_at' => $grevience->created_at,
      'updated_at' => date("Y-m-d h:i:s a"),
      'status'=>'Open',
      'priority'=>$priority_type,
      'admin_id' => '1',
      'trans_date'=>date("Y-m-d h:i:s a"),
      'file' => $grevience->file
    );
    if ($this->input->post('status_type') == 'Closed') {
      $sms = "Dear $user_info->name, Your grievance with the ticket number $tickt is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
      $this->get_sms($user_info->phone,$sms,'1507166418766838662');
    }
    if ($this->input->post('status_type') == 'Reassign to L2' && $this->input->post('status_type') != 'Reassign to L3' && $this->input->post('status_type') != 'Closed') {
      $this->lvl_model->insert('l2_grievance', $data);
    }
    if ($this->input->post('status_type') == 'Reassign to L3' && $this->input->post('status_type') != 'Reassign to L2' && !$this->input->post('status_type') != 'Closed') {

      $this->lvl_model->insert('l3_grievance', $data);
    }
    $page_detail = $this->input->post('pageId');
    if (!empty($_FILES['fileInsert']['name'])) {
      $filePath = upload_file('fileInsert', 'grievances/' . date('d-m-Y'));
    } else {
      $filePath = '';
    }
    $data1 = array(
      'greivances_id' => $tickt,
      'user_id' => $user_id,
      'user_type' => 'L1',
      'contents' => $this->input->post("queryDetails"),
      'added_at' => date("Y-m-d h:i:s a"),
      'added_time' => date("h:i:s a"),
      'admin_id' => '1',
      'sub_admin' => '0',
      'app_id' => $this->input->post("ticketAppId"),
      'fileUpoads' => $filePath
    );
    if ($this->lvl_model->insert('greivances_chat_tbl', $data1)) {
      redirect(base_url($page_detail));
    } else {
      $this->session->set_flashdata('met_msg', 'Failed to update data');
      redirect(base_url($page_detail));
    }
  }

  public function get_sms($phone,$sms,$id)
  {
      $requestParams = array(
          'user'=>'Wehubfoundation',
          'password'=>'Wehub@0308',
          'mobile'=>$phone,
          'message'=>$sms,
          'sender'=>'TWEHUB',
          'type'=>'3',
          'template_id'=>$id
      );

      $apiUrl = 'https://api.bulksmsgateway.in/sendmessage.php?';
      foreach($requestParams as $key => $val){
          $apiUrl .= $key.'='.urlencode($val).'&';
      }
      $apiUrl = rtrim($apiUrl, "&");
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $response = curl_exec($ch);
      curl_close($ch);
      return true;
  }

  public function grievance_priority_update()
  {
    if (!empty($this->input->post('ticket')) && (!empty($this->input->post('priority_type')))) {
      $sta = $this->lvl_model->update_data('grievance', ['priority' => $this->input->post('priority_type'), 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $this->input->post('ticket')]);
      $st = $this->lvl_model->update_data('l1_grievance', ['priority' => $this->input->post('priority_type'), 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $this->input->post('ticket')]);

      if ($sta && $st) {
        $user_id = $this->input->post('user_id');
        $res['response'] = '1';
        $res['message'] = 'Priority Updated successfully.';
        $res['priority'] = $this->input->post('priority_type');
      } else {
        $res['response'] = '0';
        $res['message'] = 'Failed to update.';
      }
    } else {
      $res['response'] = '0';
      $res['message'] = 'Invalid request.';
    }
    echo json_encode($res);
  }



  public function grievance_admin_added()
  {
    if (!empty($this->input->post('griv_subject')) && (!empty($this->input->post('griv_type')))) {
      $page_detail = $this->input->post('page_detail');
      if (!empty($_FILES['griv_file']['name'])) {
        $filePath = upload_file('griv_file', 'grievances/' . date('d-m-Y'));
      } else {
        $filePath = '';
      }

      $dataSts =  array(
        'grievance_id' => "GUDY" . rand(100000, 999999),
        'subject' => $this->input->post('griv_subject'),
        'query_type' => $this->input->post('griv_type'),
        'file' => $filePath,
        'content' => $this->input->post('griv_details'),
        'created_at' => date('Y-m-d h:i:s a'),
        'updated_at' => date('Y-m-d h:i:s a'),
        'user_id' => $this->input->post('user_id'),
        'user_type' => $this->input->post('user_type'),
        'status' => $this->input->post('griv_type'),
      );
      if ($this->lvl_model->insert('grievance', $dataSts)) {
        $this->session->set_flashdata('met_msg', 'Ticket erase successfully');
        redirect(base_url($page_detail . '/' . $this->input->post('user_id') . '/' . $this->input->post('ticket_id')));
      } else {
        $this->session->set_flashdata('met_msg', 'Failed to update data');
        redirect(base_url($page_detail . '/' . $this->input->post('user_id') . '/' . $this->input->post('ticket_id')));
      }
    } else {
      $this->session->set_flashdata('met_msg', 'Invalid parameter');
      redirect(base_url($page_detail . '/' . $this->input->post('user_id') . '/' . $this->input->post('ticket_id')));
    }
  }


  public function grievance_chat_replay()
  {
    if (!empty($this->session->userdata("admin_id")) && (!empty($this->input->post('ticketId')))) {
      $page_detail = $this->input->post('pageId');
      if (!empty($_FILES['fileInsert']['name'])) {
        $filePath = upload_file('fileInsert', 'grievances/' . date('d-m-Y'));
      } else {
        $filePath = '';
      }
      $data = array(
        'greivances_id' => $this->input->post('ticketId'),
        'user_id' => $this->input->post('ticketUserId'),
        'user_type' => 'L1',
        'contents' => $this->input->post("queryDetails"),
        'added_at' => date("Y-m-d h:i:s a"),
        'added_time' => date("h:i:s a"),
        'admin_id' => '1',
        'sub_admin' => '0',
        'app_id' => $this->input->post("ticketAppId"),
        'fileUpoads' => $filePath
      );

      if ($this->grievances_modal->insert('greivances_chat_tbl', $data)) {
        $this->session->set_flashdata('met_msg', 'Ticket erase successfully');
        redirect(base_url($page_detail . '/' . $this->input->post('ticketUserId') . '/' . $this->input->post('ticketAppId')));
      } else {
        $this->session->set_flashdata('met_msg', 'Failed to update data');
        redirect(base_url($page_detail . '/' . $this->input->post('ticketUserId') . '/' . $this->input->post('ticketAppId')));
      }
    } else {
      $this->session->set_flashdata('met_msg', 'Invalid parameter');
      redirect(base_url($page_detail . '/' . $this->input->post('ticketUserId') . '/' . $this->input->post('ticketAppId')));
    }
  }


  // public function get_chat_by_ticket()
  // {
  //   if ($this->input->post('ticket')) {

  //     $ticket = $this->input->post('ticket');
  //     $id = $this->input->post("user_id");
  //     $grievence = $this->db->query("select * from greivances_chat_tbl where greivances_id =  '$ticket' and user_id = '$id' order by g_id asc")->result_array();
  //     if (count($grievence) > 0) {
  //       $userPic = $this->db->query("select userPic from users where id =  '$id'")->row_array()['userPic'];

  //       $chats = '';
  //       foreach ($grievence as $rows) {
  //         if (!empty($rows['fileUpoads'])) {
  //           $dwnLink = base_url($rows['fileUpoads']);
  //           $icon = base_url("assets/images/new-download-icon.png");
  //           $dwnIcon = "<a href='$dwnLink' download><img src='$icon' class='downlChatIcon'></a>";
  //           $dwnIconAd = "<a href='$dwnLink' download><img src='$icon' class='downlChatIconAd'></a>";
  //         } else {
  //           $dwnIcon = '';
  //           $dwnIconAd = '';
  //         }

  //         $userImg = '';
  //         $img = base_url("assets/images/logo-cht-icon.png");
  //         if (!empty($userPic)) {
  //           if (file_exists($userPic)) {
  //             $userImg = base_url($userPic);
  //           } else {
  //             $userImg = '';
  //           }
  //         }
  //         $desc = $rows['contents'];
  //         $upd = $rows['added_at'];
  //         $user_type = $rows['user_type'];

  //         if ($user_type == 'admin') {
  //           $chats .= '<div class="query-cht query-chts">
	// 				<div class="cht-img">
	// 					<img src="' . $img . '" alt="" />
	// 				</div>
	// 				<div>
	// 					<p>' . $desc . '</p>
						 
	// 					<strong>Updated on ' . $dwnIconAd . '' . $upd . '</strong>
	// 				</div>
	// 			</div>';
  //         } else {
  //           $chats .= '<div class="query-cht">
	// 				<div class="cht-img">
	// 					<img src="' . $userImg . '" alt="" />
	// 				</div>
	// 				<div>
	// 					<p>' . $desc . '</p>
						 
	// 					<strong>Updated on ' . $upd . '' . $dwnIcon . '</strong>
	// 				</div>
	// 			</div>';
  //         }
  //       }

  //       $this->lvl_model->update_data('greivances_chat_tbl', ['chatRead' => '1'], ['greivances_id' => $ticket, 'chatRead' => '0']);
  //       $res['response'] = '1';
  //       $res['message'] = '';
  //       $res['chat'] = $chats;
  //     } else {
  //       $res['response'] = '0';
  //       $res['message'] = 'No Chat.';
  //     }
  //   } else {
  //     $res['response'] = '0';
  //     $res['message'] = 'Chat not available.';
  //   }


  //   $this->output->set_output(json_encode($res));
  // }
  public function get_chat_by_ticket()

	{

		if($this->input->post('ticket'))

		{

			$ticket = $this->input->post('ticket');

			$id = $this->input->post("user_id");

			$grievence = $this->db->query("select * from greivances_chat_tbl where greivances_id =  '$ticket' and user_id = '$id' order by g_id asc")->result_array();

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

					} else { $userImg = ''; }



					$desc = $rows['contents'];

					$upd = $rows['added_at'];

					$user_type = $rows['user_type'];

					

          if ($user_type == 'admin' || $user_type == 'L1' || $user_type == 'L2' || $user_type == 'L3') {

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

						<img src="'.$userImg.'" alt="" />

					</div>

					<div>

						<p>'.$desc.'</p>

						 

						<strong>Updated on '.$upd.''.$dwnIcon.'</strong>

					</div>

				</div>';

					}

				}

				$this->grievances_modal->update_data('greivances_chat_tbl',['chatRead'=>'1'], ['greivances_id' => $ticket,'chatRead'=>'0']);

				$res['response'] = '1';

				$res['message'] = '';

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


  public function grievance_download()
  {
    $this->load->library('pdf');
    //$sts = $this->input->post('cer_sts');
    $tr = '';
    foreach ($this->input->post('grievance') as $certificate_id) {
      $datas = $this->db->query("SELECT grievance.id, users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at FROM grievance left join users on grievance.user_id = users.id WHERE grievance.id = '$certificate_id'")->row();
      $tr .= "<tr> <td>$datas->name</td> <td>$datas->adhaar_no</td> <td>" . date('M d Y', strtotime($datas->created_at)) . "</td>  <td>$datas->email </td> <td>$datas->phone </td></tr>";
    }
    $data['tblRow'] = $tr;
    $file_name = date('Ymdhis') . ".pdf";
    $html = $this->load->view('admin/grievance/download', $data, true);
    $this->pdf->createPDF($html, $file_name, true);
  }

  public function grievance_admin_update()
  {
    if (!empty($this->input->post('ticket')) && (!empty($this->input->post('status_type')))) {
      if ($this->lvl_model->update_data('grievance', ['status' => $this->input->post('status_type'), 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $this->input->post('ticket')])) {
        $user_id = $this->input->post('user_id');
        $tickt = $this->input->post('ticket');
        $user_info = $this->db->query("select name,phone from users where id = '$user_id'")->row();
        if ($this->input->post('status_type') == 'Closed') {
          $sms = "Dear $user_info->name, Your grievance with the ticket number$tickt is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
          $sendSms = get_sms($user_info->phone, $sms, '1507166418766838662');
        }
        if ($this->input->post('status_type') == 'Review') {
          $sms = "Dear $user_info->name, Your grievance with the ticket number $tickt is progress. Please login into your dashboard for the comments from our executive. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
          $sendSms = get_sms($user_info->phone, $sms, '1507166418759787173');
        }

        $res['response'] = '1';
        $res['message'] = 'Status Updated successfully.';
      } else {
        $res['response'] = '0';
        $res['message'] = 'Failed to update.';
      }
    } else {
      $res['response'] = '0';
      $res['message'] = 'Invalid request.';
    }
    echo json_encode($res);
  }

  // public function ticket_query(){
  // 	if($this->input->post('submit')){
  // 		$id = $this->session->userdata("user_id");
  // 		if (!empty($this->session->userdata("user_id")))
  // 		{
  // 			if (!empty($_FILES['fileInsert']['name'])) {
  // 				$filePath = upload_file('fileInsert','grievances/'.date('d-m-Y'));
  // 			}
  // 			else{ 
  // 				$filePath = ''; 
  // 			}

  // 			$data = array(
  // 				'greivances_id' => $this->input->post('ticketId'),
  // 				'user_id' => $id,
  // 				'user_type' => 'User',
  // 				'contents' => $this->input->post("queryDetails"),
  // 				'added_at' => date("Y-m-d h:i:s a"),
  // 				'added_time' => date("h:i:s a"),
  // 				'admin_id' => '0',
  // 				'sub_admin' => '0',
  // 				'app_id' => '0',
  // 				'fileUpoads' =>$filePath
  // 			);
  // 			$data = $this->security->xss_clean($data);
  // 			$result = $this->crud_model->insert('greivances_chat_tbl', $data);
  // 			if($result)
  // 			{
  // 				$this->session->set_flashdata('success', 'Query submited successfully!');
  // 				redirect(base_url('user/grievance'));
  // 			}

  // 		} 
  // 		else 
  // 		{
  // 			$this->session->set_flashdata('errors', $data['errors']);
  // 			redirect(base_url("user/grievance"),'refresh');
  // 		}
  // 	}
  // }
  // if ($this->input->post('status_type') == 'Reassign to L2') {
  //     $msg = "Dear $user_info->name, grievance with the ticket number $tickt is assigned to you. Please log in to your dashboard. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
  //     $email = 'jspvip07@gmail.com';
  // }
  // if ($this->input->post('status_type') == 'Reassign to L3') {
  //     $msg = "Dear $user_info->name, grievance with the ticket number $tickt is assigned to you. Please log in to your dashboard. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
  //     $email = 'vijayrajpallapu3210@gmail.com';
  // }
}
