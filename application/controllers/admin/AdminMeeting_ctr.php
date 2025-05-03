<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminMeeting_ctr extends My_Controller {

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
		$this->load->model('admin/AdminMeeting_model', 'meeting_model');
    }
    
    public function meeting_schedule()
	{
		if(!empty($this->session->userdata('admin_id')))
		{
			$meeting_type = $this->input->post('meeting_type');
			$date_time = $this->input->post('date_time');
			$time_from = $this->input->post('time_from');
			$time_to = $this->input->post('time_to');
			$get_link = $this->input->post('get_link');
			$meeting_multi_user = $this->input->post('meeting_multi_user');
			$meeting_page = $this->input->post('meeting_page');
			$meeting_page_type = $this->input->post('meeting_page_type');
			if($this->input->post('meeting_page_type') == '1')
			{
				$tags = explode(',' , $meeting_multi_user);
				$k = 0;
				while($k<count($tags))
				{
				    $doc_id = $tags[$k];
					if($meeting_page == 'cert')
					{
						$user_id = $this->db->query("SELECT enterprise.user_id FROM enterprise LEFT JOIN option3 ON enterprise.id = option3.enterprise_id WHERE enterprise.tbl_name = 'option3' AND option3.id = '$doc_id'")->row_array()['user_id'];
						$updated_by = '1';
						$user_type = 'users';
					}
					elseif($meeting_page == 'kyc')
					{
						$user_id = $tags[$k];
						$updated_by = '1';
						$user_type = 'users';
					}
					elseif($meeting_page == 'griv')
					{
						$user_id = $this->db->query("SELECT grievance.user_id FROM grievance WHERE  id = '$doc_id'")->row_array()['user_id'];
						$updated_by = '1';
						$user_type = 'users';
					}
					elseif($meeting_page == 'admin')
					{
						$user_id = $tags[$k];
						$updated_by = '2';
						$user_type = 'admin';
					}
					else
					{
						$user_id = $tags[$k];
						$updated_by = '1';
						$user_type = 'users';
					}
					$datas =  array(
						'meetingType' => $this->input->post('meeting_type'),
						'meetingDate' => $this->input->post('date_time'),
						'timeFrom' => $this->input->post('time_from'),
						'timeTo' => $this->input->post('time_to'),
						'linkDetail' => $this->input->post('get_link'),
						'meetingDetails' => '',
						'user_id' => $user_id?$user_id:'0',
						'user_type' => $user_type,
						'update_by' => $updated_by,
						'update_user_id' => $this->session->userdata('admin_id')
					);
					$this->meeting_model->insert_data('schedule_meeting_tbl',$datas);
					$k++;
				}
				$data['response'] = '1';
				$data['message'] = 'Meeting schedule successfully';
			}
			else
			{
				$datas =  array(
					'meetingType' => $this->input->post('meeting_type'),
					'meetingDate' => $this->input->post('date_time'),
					'timeFrom' => $this->input->post('time_from'),
					'timeTo' => $this->input->post('time_to'),
					'linkDetail' => $this->input->post('get_link'),
					'meetingDetails' => '',
					'user_id' => $this->input->post('meeting_user_id')?$this->input->post('meeting_user_id'):'0',
					'user_type' => 'users',
					'update_by' => '1',
					'update_user_id' => $this->session->userdata('admin_id')
				);
				if($this->meeting_model->insert_data('schedule_meeting_tbl',$datas))
				{
					$data['response'] = '1';
					$data['message'] = 'Meeting schedule successfully';
				}
				else
				{
					$data['response'] = '0';
					$data['message'] = 'Meeting schedule failed try again';
				}
			} 
		}
		else
		{
			$data['response'] = '0';
			$data['message'] = 'Fill all fields';
		}
		echo json_encode($data);
	}
 
	
	/*public function meeting_schedule()
	{
		if(!empty($this->session->userdata('admin_id')))
		{
			$datas =  array(
				'meetingType' => $this->input->post('meeting_type'),
				'meetingDate' => $this->input->post('date_time'),
				'timeFrom' => $this->input->post('time_from'),
				'timeTo' => $this->input->post('time_to'),
				'linkDetail' => $this->input->post('get_link'),
				'meetingDetails' => '',
				'user_id' => $this->input->post('meeting_user_id')?$this->input->post('meeting_user_id'):'0',
				'user_type' => 'users',
				'update_by' => '1',
				'update_user_id' => $this->session->userdata('admin_id')
			);
			if($this->meeting_model->insert_data('schedule_meeting_tbl',$datas))
			{
				$data['response'] = '1';
				$data['message'] = 'Meeting schedule successfully';
				//$this->session->set_flashdata('met_msg','Meeting schedule successfully');
				//redirect(base_url('master_dashboard'));
			}
			else
			{
				$data['response'] = '0';
				$data['message'] = 'Meeting schedule failed try again';
				//$this->session->set_flashdata('met_msg','Meeting schedule failed try again');
				//redirect(base_url('master_dashboard'));
			}
		}
		else
		{
			$data['response'] = '0';
			$data['message'] = 'Fill all fields';

			//$this->session->set_flashdata('met_msg','Fill all fields');
			//redirect(base_url('master_dashboard'));
		}
		echo json_encode($data);
	}*/
}

?>