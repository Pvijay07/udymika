<?php
	class Dashboard_model extends CI_Model{

		function get_application_count($table,$where_params)
		{
			if(!empty($where_params))
			{
				foreach($where_params as $w_key=>$w_val)
				{
					$this->db->where(trim($w_key),$w_val);
				}
			}
			$this->db->from(trim($table));
			return $this->db->count_all_results();
		}
		function get_griev_count($table)
		{
			$this->db->from(trim($table));
			return $this->db->count_all_results();
		}
		public function updates($table,$params,$where_params)
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
		
		public function dashboardDistrict()
		{
		    return $this->db->query("SELECT * from districts GROUP BY id")->result_array();
		}


	}
?>