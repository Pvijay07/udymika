<?php defined('BASEPATH') or exit('No direct script access allowed');



class AdminGrievance_ctr extends My_Controller
{



	function __construct()
	{

		parent::__construct();

		$allowedAdmin = array('admin_id');

		$check = array_intersect_key(array_flip($allowedAdmin), ($this->session->userdata()));

		if (count($check) <= 0) {

			$allowed = array();

			if (!in_array($this->router->fetch_method(), $allowed)) {

				switch ($_SERVER['REQUEST_METHOD']) {

					case "POST":

						if ($this->input->is_ajax_request()) {

							$res['response'] = "error";

							$res['message'] = "Session timed out. Please login again";

							echo json_encode($res);

							exit();
						} else {

							$this->session->set_flashdata('msg', 'Session timed out. Please login again');

							redirect(base_url('master_logout'));
						}

						break;

					case "GET":

						redirect(base_url('master_logout'));

						break;
				}
			}
		}

		if ($this->session->userdata('admin_type') != '1') {

			redirect(base_url('master_logout'));
		}

		$this->load->model('admin/AdminGrievancesModal', 'grievances_modal');
		$this->load->model('lvl_model');
		$this->load->library('pagination');

	}





	//--------------------------------------------------------------------------

	public function lvl_grievance()
	{
		$data['title'] = 'Grievances List';
		$data['L1']    = $this->lvl_model->get_all_l1__grievence_count('Open');
		$data['L2']    = $this->lvl_model->get_grievence_count('Open');
		$data['L3']    = $this->lvl_model->get_grievence_count_l3('Open');

		$this->load->view('admin/lvl_grievance', $data);
	}


	public function index()
	{

		$status = 'Open';

		$data['title'] = 'Grievances List';

		$params['limit'] = RECORDS_PER_PAGE;

		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$config = $this->config->item('pagination');

		$config['base_url'] = site_url('master_grievance?');

		$config['total_rows'] = $this->grievances_modal->get_all_grievence_count($status);

		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);

		$data['kyc'] = $this->grievances_modal->get_all_grievence($params, $status);


		$data['raised'] = $this->grievances_modal->get_all_grievence_count('Open');

		$data['process'] = $this->grievances_modal->get_all_grievence_count('Review');

		$data['close'] = $this->grievances_modal->get_all_grievence_count('Closed');


		$this->load->view('admin/grievance/grivanc_list', $data);
	}
	public function grievance_l1()
	{

		$status                       = 'Open';
		$data['title']                = 'Grievances List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l1');
		$config['total_rows']         = $this->lvl_model->get_all_l1__grievence_count($status);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['user_details'] = $this->lvl_model->get_l1_grievence($params, $status);
		$data['raised']       = $this->lvl_model->get_all_l1__grievence_count('Open');
		$data['process']      = $this->lvl_model->get_all_l1__grievence_count('Review');
		$data['close']        = $this->lvl_model->get_all_l1__grievence_count('Closed');
		$this->load->view('admin/L1/L1_grievence', $data);
	}
	public function gre_progress_list_l1()
	{

		$status                       = 'Review';
		$data['title']                = 'Progress List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l1');
		$config['total_rows']         = $this->lvl_model->get_all_l1__grievence_count($status);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['kyc']     = $this->lvl_model->get_l1_grievence($params, $status);
		$data['raised']  = $this->lvl_model->get_all_l1__grievence_count('Open');
		$data['process'] = $this->lvl_model->get_all_l1__grievence_count('Review');
		$data['close']   = $this->lvl_model->get_all_l1__grievence_count('Closed');
		$this->load->view('admin/L1/progress_list', $data);
	}
	public function gre_closed_list_l1()
	{

		$status                       = 'Closed';
		$data['title']                = 'Close List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l1');
		$config['total_rows']         = $this->lvl_model->get_all_l1__grievence_count($status);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['kyc']     = $this->lvl_model->get_l1_grievence($params, $status);
		$data['raised']  = $this->lvl_model->get_all_l1__grievence_count('Open');
		$data['process'] = $this->lvl_model->get_all_l1__grievence_count('Review');
		$data['close']   = $this->lvl_model->get_all_l1__grievence_count('Closed');
		$this->load->view('admin/L1/closed_list', $data);
	}
	public function lvl_grievance_details($ticket_id, $user_id)
	{

		$status             = 'Open';
		$data['title']      = 'Grievances Details';
		$data['user_info']  = $this->lvl_model->get_user_details($user_id);
		$data['docs_info']  = $this->lvl_model->get_user_certificate($user_id);
		$data['grievance']  = $this->lvl_model->get_userl1__grievance($user_id, $status, $ticket_id);
		$data['griev']      = $this->lvl_model->get_grievance_l($ticket_id);
		$data['priority']   = $this->lvl_model->get_priority($ticket_id);
		$data['buss_info']  = $this->lvl_model->get_user_business($user_id);
		$data['certficate'] = $this->lvl_model->get_certificate($user_id);
		$this->lvl_model->update_data('grievance', ['readStatus' => '1'], ['id' => $ticket_id, 'readStatus' => '0']);
		$this->load->view('admin/L1/L1_grivanc_details', $data);
	}
	public function grievance_l2()
	{

		$status                       = 'Open';
		$data['title']                = 'Grievances List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l2');
		$config['total_rows']         = $this->lvl_model->get_grievence_count($status);
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$data['user_details'] = $this->lvl_model->get_l2_grievence($params, $status);
		$data['raised']       = $this->lvl_model->get_grievence_count('Open');
		$data['process']      = $this->lvl_model->get_grievence_count('Review');
		$data['close']        = $this->lvl_model->get_grievence_count('Closed');
		$this->load->view('admin/L2/L2_grievence', $data);
	}

	public function gre_progress_list_l2()
	{

		$status                       = 'Review';
		$data['title']                = 'Progress List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l2');
		$config['total_rows']         = $this->lvl_model->get_grievence_count($status);
		$config['full_tag_open']      = '<p>';
		$config['full_tag_close']     = '</p>';
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$data['kyc']                  = $this->lvl_model->get_l2_grievence($params, $status);
		$data['raised']               = $this->lvl_model->get_grievence_count('Open');
		$data['process']              = $this->lvl_model->get_grievence_count('Review');
		$data['close']                = $this->lvl_model->get_grievence_count('Closed');
		$this->load->view('admin/L2/l2_progress_list', $data);
	}
	public function gre_closed_list_l2()
	{

		$status                       = 'Closed';
		$data['title']                = 'Close List';
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l2');
		$config['total_rows']         = $this->lvl_model->get_grievence_count($status);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['kyc']                  = $this->lvl_model->get_l2_grievence($params, $status);
		$data['raised']               = $this->lvl_model->get_grievence_count('Open');
		$data['process']              = $this->lvl_model->get_grievence_count('Review');
		$data['close']                = $this->lvl_model->get_grievence_count('Closed');
		$this->load->view('admin/L2/l2_closed_list', $data);
	}
	public function lvl_grievance_details_l2($ticket_id, $user_id)
	{
		$status            = 'Open';
		$data['title']     = 'Grievances Details';
		$data['user_info'] = $this->lvl_model->get_user_details($user_id);
		$data['docs_info'] = $this->lvl_model->get_user_certificate($user_id);
		$data['grievance'] = $this->lvl_model->get_use_grievance($user_id, $status, $ticket_id);
		$griev = $this->lvl_model->get_grievance($ticket_id);
		$data['griev'] = $griev;
		$data['buss_info'] = $this->lvl_model->get_user_business($user_id);
		$data['priority']   = $this->lvl_model->get_priority($griev->grievance_id);
		$data['certficate'] = $this->lvl_model->get_certificate($user_id);
		$this->lvl_model->update_data('grievance', ['readStatus' => '1'], ['id' => $ticket_id, 'readStatus' => '0']);
		$this->load->view('admin/L2/L2_grivanc_details', $data);
	}
	public function grievance_l3()
	{

		$status                       = 'Open';
		$data['title']                = 'Grievances List';
		$params['limit']              = 10;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l3');
		$config['total_rows']         = $this->lvl_model->get_grievence_count_l3($status);
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$data['user_details'] = $this->lvl_model->get_l3_grievence($params, $status);
		$data['raised']       = $this->lvl_model->get_grievence_count_l3('Open');
		$data['process']      = $this->lvl_model->get_grievence_count_l3('Review');
		$data['close']        = $this->lvl_model->get_grievence_count_l3('Closed');
		$this->load->view('admin/L3/L3_grievence', $data);
	}
	public function gre_progress_list_l3()
	{

		$status                       = 'Review';
		$data['title']                = 'Progress List';
		$params['limit']              = 20;
		$params['limit']              = 20;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l3');
		$config['total_rows']         = $this->lvl_model->get_grievence_count_l3($status);
		$config['reuse_query_string'] = true;
		$this->pagination->initialize($config);
		$data['kyc']                  = $this->lvl_model->get_l3_grievence($params, $status);
		$data['raised']       = $this->lvl_model->get_grievence_count_l3('Open');
		$data['process']              = $this->lvl_model->get_grievence_count_l3('Review');
		$data['close']                = $this->lvl_model->get_grievence_count_l3('Closed');
		$this->load->view('admin/L3/l3_progress_list', $data);
	}
	public function gre_closed_list_l3()
	{

		$status                       = 'Closed';
		$data['title']                = 'Close List';
		$params['limit']              = 10;
		$params['offset']             = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config                       = $this->config->item('pagination');
		$config['base_url']           = site_url('grievance_l3');
		$config['total_rows']         = $this->lvl_model->get_grievence_count_l3($status);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['kyc']                  = $this->lvl_model->get_l3_grievence($params, $status);
		$data['raised']       = $this->lvl_model->get_grievence_count_l3('Open');
		$data['process']              = $this->lvl_model->get_grievence_count_l3('Review');
		$data['close']                = $this->lvl_model->get_grievence_count_l3('Closed');
		$this->load->view('admin/L3/l3_closed_list', $data);
	}
	public function lvl_grievance_details_l3($ticket_id, $user_id)
	{
		$status             = 'Open';
		$data['title']      = 'Grievances Details';
		$data['user_info']  = $this->lvl_model->get_user_details($user_id);
		$data['docs_info']  = $this->lvl_model->get_user_certificate($user_id);
		$data['grievance']  = $this->lvl_model->get_us_grievance($user_id, $status, $ticket_id);
		$griev = $this->lvl_model->get($ticket_id);
		$data['griev'] = $griev;
		$data['buss_info']  = $this->lvl_model->get_user_business($user_id);
		$data['priority']   = $this->lvl_model->get_priority($griev->grievance_id);
		$data['certficate'] = $this->lvl_model->get_certificate($user_id);
		$this->lvl_model->update_data('grievance', ['readStatus' => '1'], ['id' => $ticket_id, 'readStatus' => '0']);
		$this->load->view('admin/L3/L3_grivanc_details', $data);
	}




	public function grievance_admin_update_l1()
	{

		$user_id       = $this->input->post('ticketUserId');
		$priority_type = $this->input->post('priority_type');
		$status_type   = $this->input->post('status_type');
		$tickt         = $this->input->post('ticket');
		$querydetails  = $this->input->post('queryDetails');
		$this->lvl_model->update_data('grievance', ['status' => $status_type, 'priority' => $priority_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$this->lvl_model->update_data('l1_grievance', ['status' => $status_type, 'priority' => $priority_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$user_info = $this->db->query("select name,email,phone from users where id = '$user_id'")->row();
		$grevience = $this->db->query("select subject,query_type,user_id,status,content,file,created_at from grievance where grievance_id = '$tickt'")->row();
		$msg       = "";
		$data1      = array(
			'grievance_id' => $tickt,
			'subject'      => $grevience->subject,
			'user_id'      => $grevience->user_id,
			'query_type'   => $grevience->query_type,
			'content'      => $grevience->content,
			'created_at'   => $grevience->created_at,
			'updated_at'   => date("Y-m-d h:i:s a"),
			'status'       => 'Open',
			'priority'     => $priority_type,
			'admin_id'     => '1',
			'trans_date' => date("Y-m-d h:i:s a"),
			'file'         => $grevience->file
		);
		if ($this->input->post('status_type') == 'Closed') {
			$sms = "Dear $user_info->name, Your grievance with the ticket number $tickt is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
			$this->get_sms($user_info->phone, $sms, '1507166418766838662');
		}
		if ($this->input->post('status_type') == 'Reassign to L2') {
			$this->lvl_model->insert('l2_grievance', $data1);
		}
		if ($this->input->post('status_type') == 'Reassign to L3') {

			$this->lvl_model->insert('l3_grievance', $data1);
		}
		$page_detail = $this->input->post('pageId');
		if (!empty($_FILES['fileInsert']['name'])) {
			$filePath = upload_file('fileInsert', 'grievances/' . date('d-m-Y'));
		} else {
			$filePath = '';
		}
		$data1 = array(
			'greivances_id' => $tickt,
			'user_id'       => $user_id,
			'user_type'     => 'L1',
			'contents'      => $this->input->post("queryDetails"),
			'added_at'      => date("Y-m-d h:i:s a"),
			'added_time'    => date("h:i:s a"),
			'admin_id'      => '1',
			'sub_admin'     => '0',
			'app_id'        => $this->input->post("ticketAppId"),
			'fileUpoads'    => $filePath
		);
		if ($this->lvl_model->insert('greivances_chat_tbl', $data1)) {
			$this->session->set_flashdata('success', 'success');
			// echo 'alert("success")';
			redirect(base_url($page_detail));
		} else {
			$this->session->set_flashdata('met_msg', 'Failed to update data');
			redirect(base_url($page_detail));
		}
	}






	public function grievance_admin_update_l2()
	{

		$user_id       = $this->input->post('ticketUserId');
		$priority_type = $this->input->post('priority_type');
		$status_type   = $this->input->post('status_type');
		$tickt         = $this->input->post('ticket');
		$querydetails  = $this->input->post('queryDetails');
		$this->lvl_model->update_data('grievance', ['status' => $status_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$this->lvl_model->update_data('l2_grievance', ['status' => $status_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$user_info = $this->db->query("select name,email,phone from users where id = '$user_id'")->row();
		$grevience = $this->db->query("select subject,query_type,user_id,status,content,file,priority,created_at from grievance where grievance_id = '$tickt'")->row();
		$msg       = "";
		$data1      = array(
			'grievance_id' => $tickt,
			'subject'      => $grevience->subject,
			'user_id'      => $grevience->user_id,
			'query_type'   => $grevience->query_type,
			'content'      => $grevience->content,
			'created_at'   => $grevience->created_at,
			'updated_at'   => date("Y-m-d h:i:s a"),
			'status'       => 'Open',
			'priority'     => $grevience->priority,
			'admin_id'     => '1',
			'trans_date' => date("Y-m-d h:i:s a"),
			'file'         => $grevience->file
		);
		if ($this->input->post('status_type') == 'Closed') {
			$msg = "Dear $user_info->name, Your grievance with the ticket number $tickt is successfully closed. Hope our team answered your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
			$this->get_sms($user_info->phone, $msg, '1507166418766838662');
		}
		if ($this->input->post('status_type') == 'Reassign to L1') {
			$this->lvl_model->insert('l1_grievance', $data1);
		}
		if ($this->input->post('status_type') == 'Reassign to L3') {

			$this->lvl_model->insert('l3_grievance', $data1);
		}
		$page_detail = $this->input->post('pageId');
		if (!empty($_FILES['fileInsert']['name'])) {
			$filePath = upload_file('fileInsert', 'grievances/' . date('d-m-Y'));
		} else {
			$filePath = '';
		}
		$data = array(
			'greivances_id' => $tickt,
			'user_id'       => $user_id,
			'user_type'     => 'L2',
			'contents'      => $this->input->post("queryDetails"),
			'added_at'      => date("Y-m-d h:i:s a"),
			'added_time'    => date("h:i:s a"),
			'admin_id'      => '1',
			'sub_admin'     => '0',
			'app_id'        => $this->input->post("ticketAppId"),
			'fileUpoads'    => $filePath
		);
		echo json_encode($data);
		if ($this->lvl_model->insert('greivances_chat_tbl', $data)) {
			redirect(base_url($page_detail));
		} else {
			$this->session->set_flashdata('met_msg', 'Failed to update data');
			redirect(base_url($page_detail));
		}

		$this->output->set_output(json_encode($res));
	}
	public function grievance_admin_update_l3()
	{
		$user_id       = $this->input->post('ticketUserId');
		$priority_type = $this->input->post('priority_type');
		$status_type   = $this->input->post('status_type');
		$tickt         = $this->input->post('ticket');
		$querydetails  = $this->input->post('queryDetails');
		$this->lvl_model->update_data('grievance', ['status' => $status_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$this->lvl_model->update_data('l3_grievance', ['status' => $status_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);
		$user_info = $this->db->query("select name,email,phone from users where id = '$user_id'")->row();
		$grevience = $this->db->query("select subject,query_type,user_id,status,content,file,priority,created_at from grievance where grievance_id = '$tickt'")->row();

		$msg  = "";
		$data1 = array(
			'grievance_id' => $tickt,
			'subject'      => $grevience->subject,
			'user_id'      => $grevience->user_id,
			'query_type'   => $grevience->query_type,
			'content'      => $grevience->content,
			'created_at'   => $grevience->created_at,
			'updated_at'   => date("Y-m-d h:i:s a"),
			'status'       => 'Open',
			'priority'     => $grevience->priority,
			'admin_id'     => '1',
			'trans_date' => date("Y-m-d h:i:s a"),
			'file'         => $grevience->file
		);
		if ($this->input->post('status_type') == 'Closed') {
			$msg = "Dear $user_info->name, Your grievance with the ticket number $tickt is successfully closed. Hope our team answered your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
			$this->get_sms($user_info->phone,$msg,'1507166418766838662');

		}
		if ($this->input->post('status_type') == 'Reassign to L1') {
			$this->lvl_model->update_data('grievance', ['status' => 'Open', 'priority' => $priority_type, 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $tickt]);

			$this->lvl_model->insert('l1_grievance', $data1);
		}
		if ($this->input->post('status_type') == 'Reassign to L2') {

			$this->lvl_model->insert('l2_grievance', $data1);
		}
		$page_detail = $this->input->post('pageId');
		if (!empty($_FILES['fileInsert']['name'])) {
			$filePath = upload_file('fileInsert', 'grievances/' . date('d-m-Y'));
		} else {
			$filePath = '';
		}
		$data = array(
			'greivances_id' => $tickt,
			'user_id'       => $user_id,
			'user_type'     => 'L3',
			'contents'      => $this->input->post("queryDetails"),
			'added_at'      => date("Y-m-d h:i:s a"),
			'added_time'    => date("h:i:s a"),
			'admin_id'      => '1',
			'sub_admin'     => '0',
			'app_id'        => $this->input->post("ticketAppId"),
			'fileUpoads'    => $filePath
		);
		if ($this->lvl_model->insert('greivances_chat_tbl', $data)) {
			redirect(base_url($page_detail));
		} else {
			$this->session->set_flashdata('met_msg', 'Failed to update data');
			redirect(base_url($page_detail));

			// redirect(base_url($page_detail . '/' . $this->input->post('ticketAppId') . '/' . $this->input->post('ticketUserId')));
		}



		$this->output->set_output(json_encode($res));
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











	public function gre_progress_list()
	{

		$status = 'Review';

		$data['title'] = 'Progress List';

		$params['limit'] = RECORDS_PER_PAGE;

		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$config = $this->config->item('pagination');

		$config['base_url'] = site_url('master_grievance?');

		$config['total_rows'] = $this->grievances_modal->get_all_grievence_count($status);

		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);

		$data['kyc'] = $this->grievances_modal->get_all_grievence($params, $status);

		$data['raised'] = $this->grievances_modal->get_all_grievence_count('Open');

		$data['process'] = $this->grievances_modal->get_all_grievence_count('Review');

		$data['close'] = $this->grievances_modal->get_all_grievence_count('Closed');

		//print_r($this->db->last_query());

		$this->load->view('admin/grievance/progress_list', $data);
	}

	public function gre_closed_list()
	{

		$status = 'Closed';

		$data['title'] = 'Close List';

		$params['limit'] = RECORDS_PER_PAGE;

		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

		$config = $this->config->item('pagination');

		$config['base_url'] = site_url('master_grievance?');

		$config['total_rows'] = $this->grievances_modal->get_all_grievence_count($status);

		$config['reuse_query_string'] = TRUE;

		$this->pagination->initialize($config);

		$data['kyc'] = $this->grievances_modal->get_all_grievence($params, $status);

		$data['raised'] = $this->grievances_modal->get_all_grievence_count('Open');

		$data['process'] = $this->grievances_modal->get_all_grievence_count('Review');

		$data['close'] = $this->grievances_modal->get_all_grievence_count('Closed');

		//print_r($this->db->last_query());

		$this->load->view('admin/grievance/close_list', $data);
	}



	public function grievance_details($user_id, $ticket_id)
	{

		$appid = $this->db->query("SELECT enterprise.user_id,option3.id FROM enterprise LEFT JOIN option3 ON enterprise.id = option3.enterprise_id WHERE enterprise.user_id = '$user_id' ORDER BY option3.id DESC LIMIT 1")->row();

		$cert_id = $appid->id;

		$status = 'Raised';

		$data['title'] = 'Grievances Details';

		$data['user_info'] = $this->grievances_modal->get_user_details($user_id);

		$data['docs_info'] = $this->grievances_modal->get_user_certificate($user_id);

		$data['grievance'] = $this->grievances_modal->get_user_grievance($user_id, $status, $ticket_id);

		$data['griev'] = $this->grievances_modal->get_grievance($ticket_id);

		$data['buss_info'] = $this->grievances_modal->get_user_business($user_id);



		$data['certficate'] = $this->grievances_modal->get_certificate($user_id);

		//print_r($this->db->last_query());

		$data['checklist'] = $this->grievances_modal->get_user_check_list($user_id, $cert_id);

		$data['remarks'] = $this->grievances_modal->get_grivance_remark($user_id, $cert_id);

		$this->grievances_modal->update_data('grievance', ['readStatus' => '1'], ['id' => $ticket_id, 'readStatus' => '0']);

		$this->load->view('admin/grievance/grivanc_details', $data);
	}

	public function grievance_progress_details($user_id, $ticket_id)
	{

		$status = 'Process';

		$data['title'] = 'Grievances Details';

		$data['user_info'] = $this->grievances_modal->get_user_details($user_id);

		$data['docs_info'] = $this->grievances_modal->get_user_certificate($user_id);

		$data['grievance'] = $this->grievances_modal->get_user_grievance($user_id, $status, $ticket_id);

		$data['griev'] = $this->grievances_modal->get_grievance($ticket_id);

		$data['certficate'] = $this->grievances_modal->get_certificate($user_id);

		$this->load->view('admin/grievance/grivanc_progress_det', $data);
	}

	public function grievance_closed_details($user_id, $ticket_id)
	{

		$status = 'Closed';

		$data['title'] = 'Grievances Details';

		$data['user_info'] = $this->grievances_modal->get_user_details($user_id);

		$data['docs_info'] = $this->grievances_modal->get_user_certificate($user_id);

		$data['grievance'] = $this->grievances_modal->get_user_grievance($user_id, $status, $ticket_id);

		$data['griev'] = $this->grievances_modal->get_grievance($ticket_id);

		$this->load->view('admin/grievance/grivanc_close_det', $data);
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



			$dataSts = array(

				'grievance_id' => "GUDY" . rand(100000, 999999),

				'subject'      => $this->input->post('griv_subject'),

				'query_type'   => $this->input->post('griv_type'),

				'file'         => $filePath,

				'content'      => $this->input->post('griv_details'),

				'created_at'   => date('Y-m-d h:i:s a'),

				'updated_at'   => date('Y-m-d h:i:s a'),

				'user_id'      => $this->input->post('user_id'),

				'user_type'    => $this->input->post('user_type'),

				'status'       => $this->input->post('griv_type'),

			);

			if ($this->grievances_modal->insert('grievance', $dataSts)) {

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





	public function grievance_admin_chat_replay()
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

				'user_id'       => $this->input->post('ticketUserId'),

				'user_type'     => 'admin',

				'contents'      => $this->input->post("queryDetails"),

				'added_at'      => date("Y-m-d h:i:s a"),

				'added_time'    => date("h:i:s a"),

				'admin_id'      => $this->session->userdata("admin_id"),

				'sub_admin'     => '0',

				'app_id'        => $this->input->post("ticketAppId"),

				'fileUpoads'    => $filePath

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





	public function get_chat_by_ticket()
	{

		if ($this->input->post('ticket')) {

			$ticket = $this->input->post('ticket');

			$id = $this->input->post("user_id");

			$grievence = $this->db->query("select * from greivances_chat_tbl where greivances_id =  '$ticket' and user_id = '$id' order by g_id asc")->result_array();
			if ($grievence) {

				$userPic = $this->db->query("select userPic from users where id =  '$id'")->row_array()['userPic'];



				$chats = '';

				foreach ($grievence as $rows) {

					if (!empty($rows['fileUpoads'])) {

						$dwnLink = base_url($rows['fileUpoads']);

						$icon = base_url("assets/images/new-download-icon.png");

						$dwnIcon = "<a href='$dwnLink' download><img src='$icon' class='downlChatIcon'></a>";

						$dwnIconAd = "<a href='$dwnLink' download><img src='$icon' class='downlChatIconAd'></a>";
					} else {

						$dwnIcon = '';

						$dwnIconAd = '';
					}





					$img = base_url("assets/images/logo-cht-icon.png");

					if (file_exists($userPic)) {

						$userImg = base_url($userPic);
					} else {
						$userImg = '';
					}



					$desc = $rows['contents'];

					$upd = $rows['added_at'];

					$user_type = $rows['user_type'];


					if ($user_type == 'admin' || $user_type == 'L1' || $user_type == 'L2' || $user_type == 'L3') {
						$chats .= '<div class="query-cht query-chts">
							<div class="cht-img">
								<img src="' . $img . '" alt="" />
							</div>
							<div>
								<p>' . $desc . '</p>
								<strong>Updated on ' . $dwnIconAd . '' . $upd . '</strong>
								<h6>Replied By '. $user_type.' </h6>
							</div>
						</div>';
					} else {
						$chats .= '<div class="query-cht">
							<div class="cht-img">
								<img src="' . $userImg . '" alt="" />
							</div>
							<div>
								<p>' . $desc . '</p>
								<strong>Updated on ' . $upd . '' . $dwnIcon . '</strong>
								<h6>Replied By '. $user_type.' </h6>
							</div>
						</div>';
					}
				}

				$this->grievances_modal->update_data('greivances_chat_tbl', ['chatRead' => '1'], ['greivances_id' => $ticket, 'chatRead' => '0']);

				$res['response'] = '1';

				$res['message'] = '';

				$res['chat'] = $chats;
			} else {

				$res['response'] = '0';

				$res['message'] = 'No Chat.';
			}
		} else {

			$res['response'] = '0';

			$res['message'] = 'Chat not available.';
		}

		echo json_encode($res);
	}


	// public function get_chat_by_ticket()
	// {
	// 	if ($this->input->post('ticket')) {
	// 		$ticket = $this->input->post('ticket');
	// 		$id = $this->input->post("user_id");
	
	// 		// ... (existing code) ...
	
	// 		foreach ($grievence as $rows) {
	// 			// ... (existing code) ...
	
	// 			if ($user_type == 'admin' || $user_type == 'L1' || $user_type == 'L2' || $user_type == 'L3') {
	// 				$chats .= '<div class="query-cht query-chts">
	// 					<div class="cht-img">
	// 						<img src="' . $img . '" alt="" />
	// 					</div>
	// 					<div>
	// 						<p>' . $desc . '</p>
	// 						<strong>Updated on ' . $dwnIconAd . '' . $upd . ' '. $user_type.'</strong>
	// 						<h6>Replied By '. $user_type.' </h6>
	// 					</div>
	// 				</div>';
	// 			} else {
	// 				$chats .= '<div class="query-cht">
	// 					<div class="cht-img">
	// 						<img src="' . $userImg . '" alt="" />
	// 					</div>
	// 					<div>
	// 						<p>' . $desc . '</p>
	// 						<strong>Updated on ' . $upd . '' . $dwnIcon . '</strong>
	// 						<h6>Replied By '. $user_type.' </h6>
	// 					</div>
	// 				</div>';
	// 			}
	// 		}
	
	// 		// ... (existing code) ...
	
	// 		$res['chat'] = $chats;
	// 	} else {
	// 		// ... (existing code) ...
	// 	}
	
	// 	echo json_encode($res);
	// }
	
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

			if ($this->grievances_modal->update_data('grievance', ['status' => $this->input->post('status_type'), 'updated_at' => date('Y-m-d h:i:s a')], ['grievance_id' => $this->input->post('ticket')])) {

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
}
