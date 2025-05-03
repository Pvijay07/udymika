<?php
	class AdminKycModal extends CI_Model{

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

		function get_certificate($user_id)
		{
			$this->db->select('enterprise.user_id');
			$this->db->select('option3.*');
			$this->db->where('enterprise.tbl_name', 'option3');
			$this->db->where('enterprise.user_id', $user_id);
			$this->db->join('option3', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('enterprise')->row();
		}

		function get_all_remarks($user_id)
		{
			$this->db->select('statusRemark');
			$this->db->where('user_id', $user_id);
			return $this->db->get('status_manage_tbl')->result_array();
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
		public function insert_data($tbl,$params)
		{
			$this->db->insert(trim($tbl),$params);
		return  $this->db->insert_id();
		}

		function kyc_count($status)
		{
			$this->db->select('users.*');
			$this->db->where('status', $status);
			$this->db->where('dataType', '1');
			$this->db->from('users');
			return $this->db->count_all_results();
		}

	}
?>