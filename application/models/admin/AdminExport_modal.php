<?php
	class AdminExport_modal extends CI_Model{

		 

		public function insert_data($tbl,$data){
			$this->db->insert($tbl, $data);
			return true;
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