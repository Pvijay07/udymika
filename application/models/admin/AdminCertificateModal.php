<?php
	class AdminCertificateModal extends CI_Model{

		function certificate_status_count($sts)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.id,enterprise.user_id');
			$this->db->select('users.id,users.name,users.email,users.phone,users.adhaar_no,users.created_at');
			$this->db->where('certficationStatus',$sts);
			//$this->db->where('business_register','Yes');
			$this->db->join('enterprise', 'option3.enterprise_id = enterprise.id', 'left');
			$this->db->join('users', 'enterprise.user_id = users.id', 'left');
			$this->db->from('option3');
			return $this->db->count_all_results();
		}

		function get_certificate_count($sts)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.id as enter_id,enterprise.user_id');
			$this->db->select('users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at');
			$this->db->where('certficationStatus',$sts);
			//$this->db->where('business_register','Yes');
			$this->db->join('enterprise', 'option3.enterprise_id = enterprise.id', 'left');
			$this->db->join('users', 'enterprise.user_id = users.id', 'left');
			$this->db->from('option3');
			return $this->db->count_all_results();
		}
		
		function get_certificate_list($params,$sts)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.id as enter_id,enterprise.user_id');
			$this->db->select('users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at');
			$this->db->where('certficationStatus',$sts);
			//$this->db->where('business_register','Yes');
			if(isset($params) && !empty($params))
			{
				$this->db->limit($params['limit'], $params['offset']);
			}
			$this->db->join('enterprise', 'option3.enterprise_id = enterprise.id', 'left');
			$this->db->join('users', 'enterprise.user_id = users.id', 'left');
			return $this->db->get('option3')->result_array();
		}


		 
		function get_user_details($user_id)
		{
			$this->db->select('users.*');
			$this->db->where('id', $user_id);
			//$this->db->join('users', 'documents.user_id = users.id', 'left');
			return $this->db->get('users')->row();
		}
		function get_user_certificate($user_id,$cert_id)
		{
			$this->db->select('documents.id as doc_id, documents.name as doc_name, documents.file_name,documents.created_at as upload_date');
			$this->db->where('user_id', $user_id);
			//$this->db->where('certficate_id', $cert_id);
			return $this->db->get('documents')->result_array();
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
		public function add_certificate_sts($data){
			$this->db->insert('certificate_admin_allot', $data);
			return true;
		}
		public function get_certificate_status($user_id,$cert_id)
		{
			$this->db->select('status_manage_tbl.*');
			$this->db->where('user_id', $user_id);
			$this->db->where('application_id', $cert_id);
			return $this->db->get('status_manage_tbl')->result_array();
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
		function get_user_grivances_list($user_id)
		{
			$this->db->select('grievance.*');
			$this->db->where('user_id', $user_id);
			return $this->db->get('grievance')->result_array();
		}
		function get_user_business($user_id)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.user_id');
			$this->db->where('user_id', $user_id);
			$this->db->join('enterprise', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('option3')->row();
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

		function check_list()
		{
			$this->db->select('checklist_tbl.cl_id,checklist_tbl.checklist_name');
			$this->db->where('status','1');
			return $this->db->get('checklist_tbl')->result_array();
		}

		function get_remarks_list($user_id,$cert_id)
		{
			$this->db->select('status_manage_tbl.*');
			$this->db->where('user_id',$user_id);
			return $this->db->get('status_manage_tbl')->result_array();
		}
		
		function check_duplicates($table,$params)
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

 

	}
?>