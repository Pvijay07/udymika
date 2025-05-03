<?php
	class AdminChecklistModal extends CI_Model{

		function get_all_checklist_count()
		{
			$this->db->select('checklist_tbl.*');
			$this->db->from('checklist_tbl');
			return $this->db->count_all_results();
		}
		
		function get_all_checklist($params)
		{
			$this->db->select('checklist_tbl.*');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			return $this->db->get('checklist_tbl')->result_array();
		}

		function get_user_grievance($user_id)
		{
			$this->db->select('grievance.*');
			$this->db->order_by('id', 'desc');
			$this->db->where('user_id', $user_id);
			return $this->db->get('grievance')->result_array();
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
		function get_checklist_ques($checklist)
		{
			$this->db->select('checklist_question_tbl.*');
			$this->db->where('check_list_id', $checklist);
			return $this->db->get('checklist_question_tbl')->result_array();
		}

	}
?>