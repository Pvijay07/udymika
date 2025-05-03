<?php
	class Crud_model extends CI_Model{

		public function insert($table, $data){
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}

		public function insert_row($tbl,$params)
		{
			$this->db->insert(trim($tbl),$params);
			return  $this->db->insert_id();
		}
		//---------------------------------------------------
		// Edit user Record
		public function update($table, $data, $where){
			$this->db->where($where);
			$this->db->update($table, $data);
			return true;
		}

		//---------------------------------------------------
		// get all
		public function select_all($table, $order_by=""){

			$this->db->select('*');
			$this->db->from($table);
			if(!empty($order_by)){
				$this->db->order_by($order_by);
			} else {
				$this->db->order_by("id", "Desc");
			}
			$query = $this->db->get();
			return $query->result();
		}

		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function select_some($table, $where, $limit=0){

			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($where);
			$this->db->order_by('id', 'desc');
			if($limit != 0){
				$this->db->limit($limit);
			}
			$query = $this->db->get();
			return $query->result();
		}

		public function select_distinct($table,$field){

			$this->db->select($field);
			$this->db->distinct();
			$query = $this->db->get($table);
			return $query->result();
		}

		public function get_name($table,$where){

			$this->db->select('name');
			$this->db->where($where);
			$query = $this->db->get($table);
			return $query->row();
		}


		//---------------------------------------------------
		// Get user detial by ID
		public function select_row($table, $where){
			$query = $this->db->get_where($table, $where);
			return $result = $query->row();
		}

		// public function select_count($table, $where){
		// 	$query = $this->db->get_where($table, $where);
		// 	return $result = $query->num_rows();
		// }

		//---------------------------------------------------
		// Get user detial by ID
		public function select($table, $where, $order_by=""){

			$this->db->select('*');
			$this->db->from($table);
			$this->db->where($where);
			if(!empty($order_by)){
				$this->db->order_by($order_by);
			}
			$query = $this->db->get();
			return $query->result();
		}


		// Delete user Record
		public function delete($table, $where){
			$this->db->where($where);
			$this->db->delete($table);
			return true;
		}

		// check duplicates
		public function check_duplicate($table, $where){
			$query = $this->db->get_where($table,$where);
			return $query->num_rows();
		}

		//sum
		public function select_sum($table, $field, $where){

			$this->db->select_sum($field);
			$this->db->where($where);
			$query = $this->db->get($table);
			return $query->row();

		}


		public function get_count($tbl,$params)
		{
			$tbl   = trim($tbl);
			if(!empty($params))
			{
				foreach($params as $key=>$value)
				{
					$this->db->where(trim($key),trim($value));
				}
			}
			return $this->db->from("$tbl")->count_all_results();
		}


            function get_data_count($table,$where_params)
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
		
		
		function select_count($tbl,$where)
		{
			$tbl   = trim($tbl);
			if(!empty($where))
			{
				foreach($where as $key=>$value)
				{
					$this->db->where(trim($key),trim($value));
				}
			}
			return $this->db->from("$tbl")->count_all_results();
		}
		
		function select_pagination($tbl,$where,$params)
		{
			$tbl   = trim($tbl);
			if(!empty($where))
			{
				foreach($where as $key=>$value)
				{
					$this->db->where(trim($key),trim($value));
				}
			}
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			return $this->db->get($tbl)->result();
		}

		function check_data_exist($table,$params)
		{
			if(!empty($params)):
				foreach($params as $key=>$value)
				{
					$this->db->where(trim($key),trim($value));
				}
			endif;
				$data =  $this->db->get(trim($table))->row();
				if(!empty($data))
				{
					return $data;
				}
				else
				{
					return false;
				}
		}
		public function update_row_data($table,$where_params,$params)
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

		public function get_single_data_object($table,$params,$get_key)
		{
			$this->db->select("$get_key");
			if(!empty($params))
			{
			   foreach($params as $key=>$value)
				{
					$this->db->where(trim($key),trim($value));
				}
			}
			$data =  $this->db->get(trim($table))->row();
			if(!empty($data))
			{
			   return $data->$get_key;
			}
			else
			{
				return null;
			}
		}



	}

?>