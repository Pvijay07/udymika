<?php
	class Leads_model extends CI_Model{

		
		//---------------------------------------------------
		public function get_all(){
			
			$this->db->select('*');
			$this->db->from('leads');
			if($this->session->userdata("user_type") == "Telecaller"){
				$this->db->where('assign_to', $this->session->userdata("user_id"));
			}
			$this->db->order_by('created_at', 'desc');
			$query = $this->db->get();
			return $query->result();
		}


		//---------------------------------------------------
		// Get user detial by ID
		public function get_leads($search){
			$this->db->select('*');
			$this->db->where($search);
			$this->db->from('leads');
			if($this->session->userdata("user_type") == "Telecaller"){
				$this->db->where('assign_to', $this->session->userdata("user_id"));
			}
			$this->db->order_by('created_at', 'desc');
			$query = $this->db->get();
			return $query->result();
		}


		//---------------------------------------------------
		// Get user detial by ID
		public function get_lead_id($id){
			$query = $this->db->get_where('leads', array('id' => $id));
			return $result = $query->row();
		}


		public function get_leads_by_id($id){
			$this->db->select('*');
			$this->db->where('lead_id',$id);
			$this->db->from('leads_status');
			$this->db->order_by('id', 'desc');
			$query = $this->db->get();
			return $query->result();
		}

		//---------------------------------------------------
		// Get user detial by ID
		public function get_lead_status_id($id){
			$query = $this->db->get_where('leads_status', array('lead_id' => $id));
			return $result = $query->row();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit($data, $id){
			$this->db->where('id', $id);
			$this->db->update('refferals', $data);
			return true;
		}

		//---------------------------------------------------
		// Change user status
		//-----------------------------------------------------
		function change_status()
		{		
			$this->db->set('is_active', $this->input->post('status'));
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ci_users');
		} 

		//---------------------------------------------------
		// get users for csv export
		public function get_refferals_for_export(){
			
			$this->db->select('*');
			$this->db->from('refferals');
			$this->db->join('ci_users', 'ci_users.id = refferals.user_id', 'left');
			$query = $this->db->get();

			return $result = $query->result_array();
		}

		//---------------------------------------------------
		// get users for csv export
		public function get_future_followups(){
			
			$sql = "SELECT * FROM `leads` WHERE status = 'Follow Up'";
			
			if($this->session->userdata("user_type") == "Telecaller"){
				$user = $this->session->userdata("user_id");
				$sql .= " AND assign_to = '$user'";
			}
				$today = date("Y-m-d");
				$sql .= " AND followup_date > '$today' ORDER BY followup_date DESC";
			
			$query = $this->db->query($sql);
			return $query->result();
		}

		//---------------------------------------------------
		// get users for csv export
		public function get_pending_followups(){
			
			$sql = "SELECT * FROM `leads` WHERE status = 'Follow Up'";
			
			if($this->session->userdata("user_type") == "Telecaller"){
				$user = $this->session->userdata("user_id");
				$sql .= " AND assign_to = '$user'";
			}
				$today = date("Y-m-d");
				$sql .= " AND followup_date < '$today' ORDER BY followup_date DESC";
			
			$query = $this->db->query($sql);
			return $query->result();
		}


		//---------------------------------------------------
		// get users for csv export
		public function get_future_demos(){
			
			$sql = "SELECT * FROM `leads` WHERE id != ''";
			
			if($this->session->userdata("user_type") == "Telecaller"){
				$user = $this->session->userdata("user_id");
				$sql .= " AND assign_to = '$user'";
			}
				$today = date("Y-m-d");
				$sql .= " AND demo_date > '$today' ORDER BY demo_date DESC";
			
			$query = $this->db->query($sql);
			return $query->result();
		}


		//---------------------------------------------------
		// get users for csv export
		public function get_pending_demos(){
			
			$sql = "SELECT * FROM `leads` WHERE demo_date != ''";
			
			if($this->session->userdata("user_type") == "Telecaller"){
				$user = $this->session->userdata("user_id");
				$sql .= " AND assign_to = '$user'";
			}
				$today = date("Y-m-d");
				$sql .= " AND demo_date < '$today' ORDER BY demo_date DESC";
			
			$query = $this->db->query($sql);
			return $query->result();
		}



		

	}

?>