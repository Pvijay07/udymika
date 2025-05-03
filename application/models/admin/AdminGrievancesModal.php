<?php
	class AdminGrievancesModal extends CI_Model{

		function get_all_grievence_count($status)
		{
			$this->db->select('grievance.*');
			$this->db->select('users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at');
			$this->db->join('users', 'grievance.user_id = users.id', 'left');
			$this->db->where('grievance.status',$status);
			$this->db->from('grievance');
			return $this->db->count_all_results();
		}
		
		function get_all_grievence($params,$status)
		{
			$this->db->select('grievance.*');
			$this->db->select('users.id as user_id,users.name,users.email,users.phone,users.adhaar_no');
			$this->db->order_by('grievance.id', 'desc');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->where('grievance.status',$status);
			$this->db->join('users', 'grievance.user_id = users.id', 'left');
			return $this->db->get('grievance')->result_array();
		}
		function get_user_grievance($user_id,$status,$ticket_id)
		{
			$this->db->select('grievance.*');
			$this->db->order_by('id', 'desc');
			$this->db->where('user_id', $user_id);
			//$this->db->where('id', $ticket_id);
			//$this->db->where('grievance.status',$status);
			return $this->db->get('grievance')->result_array();
		}
		function get_grievance($id)
		{
			$this->db->select('grievance.*');
			$this->db->order_by('id', 'desc');
			$this->db->where('id', $id);
			return $this->db->get('grievance')->row();
		}
		function get_user_details($user_id)
		{
			$this->db->select('users.*');
			$this->db->where('id', $user_id);
			return $this->db->get('users')->row();
		}
		function get_user_certificate($user_id)
		{
			$this->db->select('documents.id as doc_id, documents.name as doc_name, documents.file_name,documents.created_at as upload_date');
			//$this->db->select('users.*');
			$this->db->where('user_id', $user_id);
			//$this->db->join('users', 'documents.user_id = users.id', 'left');
			return $this->db->get('documents')->result_array();
		}

		function get_grivance_remark($user_id,$cert_id)
		{
			$this->db->select('statusRemark');
			$this->db->where('user_id', $user_id);
			return $this->db->get('status_manage_tbl')->result_array();
		}

		public function insert($tbl,$data){
			$this->db->insert($tbl, $data);
			return true;
		}
		
		function get_user_business($user_id)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.user_id');
			$this->db->where('user_id', $user_id);
			$this->db->join('enterprise', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('option3')->row();
		}
		
		function get_certificate($user_id)
		{
			$this->db->select('enterprise.user_id');
			$this->db->select('option3.*');
			$this->db->where('enterprise.tbl_name', 'option3');
			$this->db->where('enterprise.user_id', $user_id);
			$this->db->join('option3', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('enterprise')->row();
		}
		function get_user_check_list($user_id,$app_id)
		{
			$checklist_type = $this->db->query("SELECT checklist FROM certificate_admin_allot WHERE user_id = '$user_id' AND certi_id = '$app_id'")->row_array()['checklist'];
			return	$this->db->query("SELECT q_id,check_list_id,checklist_que,queType FROM checklist_question_tbl WHERE check_list_id = '$checklist_type'")->result_array();
			// 			if($checklist_type)
			// 			{
			// 				$this->db->select('user_assign_checklist_tbl.*');
			// 				$this->db->select('checklist_question_tbl.checklist_que');
			// 				$this->db->where('user_id', $user_id);
			// 				$this->db->where('application_id', $app_id);
			// 				$this->db->where('checklist_id', $checklist_type);
			// 				$this->db->join('checklist_question_tbl', 'user_assign_checklist_tbl.question_id = checklist_question_tbl.q_id', 'left');
			// 				return $this->db->get('user_assign_checklist_tbl')->result_array();
			// 			}
		}

		public function update_data($table,$params,$where_params)
		{
			if(!empty($where_params))
			{
				foreach($where_params as $w_key=>$w_val)
				{
					$this->db->where(trim($w_key),$w_val);
				}
			}
			if(!empty($params))
			{
				foreach($params as $s_key=>$s_val)
				{
					$this->db->set(trim($s_key),$s_val);
				}
			}
			return $this->db->update(trim($table));
		}


	}
?>