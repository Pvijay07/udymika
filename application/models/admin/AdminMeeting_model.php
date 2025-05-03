<?php
	class AdminMeeting_model extends CI_Model{

		function get_all_kyc_count($status)
		{
			$this->db->select('users.*');
			$this->db->where('status', $status);
			$this->db->from('users');
			return $this->db->count_all_results();
		}
		
		function get_all_kyc($params,$status)
		{
			$this->db->select('users.*');
			$this->db->order_by('id', 'desc');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->where('status', $status);
			return $this->db->get('users')->result_array();
		}

		function get_user_kyc($user_id)
		{
			$this->db->select('users.*');
			$this->db->where('id', $user_id);
			return $this->db->get('users')->row();
		}

		 
		public function insert_data($tbl,$params)
		{
			$this->db->insert(trim($tbl),$params);
			return $this->db->insert_id();
		}

		// function kyc_count($status)
		// {
		// 	$this->db->select('users.*');
		// 	$this->db->where('status', $status);
		// 	$this->db->where('dataType', '1');
		// 	$this->db->from('users');
		// 	return $this->db->count_all_results();
		// }

	}
?>