<?php
	class AdminSubModal extends CI_Model{

		function get_all_subadmin_count()
		{
			$this->db->select('master_login_tbl.*');
			$this->db->select('districts.name');
			$this->db->order_by('admin_id', 'desc');
			$this->db->where('admin_id!=', '1');
			$this->db->join('districts', 'districts.id = master_login_tbl.admin_district', 'left');
			$this->db->from('master_login_tbl');
			return $this->db->count_all_results();
		}
		
		function get_all_subadmin($params)
		{
			$this->db->select('master_login_tbl.*');
			$this->db->select('districts.name');
			$this->db->order_by('admin_id', 'desc');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->where('admin_id!=', '1');
			$this->db->join('districts', 'districts.id = master_login_tbl.admin_district', 'left');
			return $this->db->get('master_login_tbl')->result_array();
		}
		 
		function get_subadmin_details($user_id)
		{
			$this->db->select('master_login_tbl.*');
			$this->db->select('districts.name');
			$this->db->where('admin_id', $user_id);
			$this->db->join('districts', 'districts.id = master_login_tbl.admin_district', 'left');
			return $this->db->get('master_login_tbl')->row();
		}
		function get_district()
		{
			$this->db->select('id, name');
			return $this->db->get('districts')->result_array();
		}
		function get_sub_admin($admin_id)
		{
			$this->db->select('master_login_tbl.*');
			$this->db->where('admin_id',$admin_id);
			return $this->db->get('master_login_tbl')->row();
		}

		public function insert($table, $data){
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}


		//---------------------------------------------------
		// Edit user Record
		public function update($table, $data, $where){
			$this->db->where($where);
			$this->db->update($table, $data);
			return true;
		}

		public function delete($table, $where){
			$this->db->where($where);
			$this->db->delete($table);
			return true;
		}

		function get_sub_admin_details($admin_id)
		{
			$this->db->select('master_login_tbl.*');
			$this->db->select('districts.name');
			$this->db->order_by('admin_id', 'desc');
			$this->db->where('admin_id', $admin_id);
			$this->db->join('districts', 'districts.id = master_login_tbl.admin_district', 'left');
			return $this->db->get('master_login_tbl')->row();
		}

		 

	}
?>