<?php
	class AdminDistrictModal extends CI_Model{

		function get_district_count()
		{
			$this->db->select('districts.*');
			$this->db->from('districts');
			return $this->db->count_all_results();
		}
		function get_district_list($params)
		{
			$this->db->select('districts.*');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			return $this->db->get('districts')->result_array();
		}
		function get_manadal_count()
		{
			$this->db->select('mandals.*');
			$this->db->select('districts.id as dist_id,districts.name as dist_name');
			$this->db->from('mandals');
			$this->db->join('districts','mandals.district_id = districts.id','left');
			return $this->db->count_all_results();
		}
		function get_manadal_list($params)
		{
			$this->db->select('mandals.*');
			$this->db->select('districts.id as dist_id,districts.name as dist_name');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->join('districts','mandals.district_id = districts.id','left');
			return $this->db->get('mandals')->result_array();
		}

		function get_panchayat_count()
		{
			$this->db->select('villages.*');
			$this->db->select('districts.id as dist_id,districts.name as dist_name');
			$this->db->select('mandals.id as mandal_id, mandals.name as mandal_name');
			$this->db->join('districts','villages.district_id = districts.id','left');
			$this->db->join('mandals','villages.mandal_id = mandals.id','left');
			$this->db->from('villages');
			return $this->db->count_all_results();
		}
		function get_panchayat_list($params)
		{
			$this->db->select('villages.*');
			$this->db->select('districts.id as dist_id,districts.name as dist_name');
			$this->db->select('mandals.id as mandal_id, mandals.name as mandal_name');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->join('districts','villages.district_id = districts.id','left');
			$this->db->join('mandals','villages.mandal_id = mandals.id','left');
			return $this->db->get('villages')->result_array();
		}

 
		function get_certificate($cert_id)
		{
			$this->db->select('option3.*');
			$this->db->where('id', $cert_id);
			return $this->db->get('option3')->row();
		}

		public function insert($tbl,$data){
			$this->db->insert($tbl, $data);
			return true;
		}
		 
		public function update_certificate_sts($table,$params,$where_params)
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