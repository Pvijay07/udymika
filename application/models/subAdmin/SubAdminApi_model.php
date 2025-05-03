<?php
	class SubAdminApi_model extends CI_Model{

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

		function user_list_assign_admin($admin_id,$sts)
		{
			$this->db->select('option3.id as cert_id,option3.certificate_num,option3.enterprise_id,option3.subAdmin');
			$this->db->select('enterprise.user_id');
			$this->db->select('users.id,users.name,users.email,users.phone,users.adhaar_no,users.created_at,users.userPic,kyc_id');
			$this->db->where('option3.subAdmin', $admin_id);
			$this->db->where('option3.certficationStatus', $sts);
			$this->db->join('enterprise', 'option3.enterprise_id = enterprise.id', 'left');
			$this->db->join('users', 'enterprise.user_id = users.id', 'left');
			return $this->db->get('option3')->result_array();
		}
		function admin_assigned_user_detail($user_id)
		{
			$this->db->select('users.*');
			$this->db->where('id', $user_id);
			return $this->db->get('users')->row_array();
		}

 

        function get_user_check_list($user_id,$app_id)
        {
        	return	$this->db->query("SELECT admin_verify_tbl.ques_id,admin_verify_tbl.ques_ans,checklist_question_tbl.checklist_que FROM `admin_verify_tbl` LEFT JOIN checklist_question_tbl ON admin_verify_tbl.ques_id = checklist_question_tbl.q_id WHERE user_id = '$user_id' AND app_id ='$app_id' GROUP BY admin_verify_tbl.ques_id")->result_array();
        }
        
        function get_verify_check_list($user_id,$app_id,$admin_id)
        {
        	return	$this->db->query("SELECT admin_verify_tbl.ques_id,admin_verify_tbl.ques_ans,checklist_question_tbl.checklist_que,checklist_question_tbl.queType FROM `admin_verify_tbl` LEFT JOIN checklist_question_tbl ON admin_verify_tbl.ques_id = checklist_question_tbl.q_id WHERE user_id = '$user_id' AND app_id ='$app_id' and verify_admin_id = '$admin_id' GROUP BY admin_verify_tbl.ques_id")->result_array();
        }
		
		function get_check_list_type($checklist_id)
		{
			$this->db->select('checklist_question_tbl.q_id,checklist_que,checklist_question_tbl.queType');
			$this->db->select('checklist_que_option_tbl.o_id,option_name,option_value');
			$this->db->where('checklist_question_tbl.check_list_id', $checklist_id);
			$this->db->join('checklist_que_option_tbl', 'checklist_que_option_tbl.question_id = checklist_question_tbl.q_id', 'left');
			return $this->db->get('checklist_question_tbl')->result_array();

		}
		function check_list()
		{
			$this->db->select('checklist_tbl.cl_id,checklist_tbl.checklist_name');
			$this->db->where('status','1');
			return $this->db->get('checklist_tbl')->result_array();
		}

        function alloted_check_list($user_id,$app_id)
		{
			$this->db->select('checklist');
			$this->db->select('checklist_tbl.checklist_name');
			$this->db->where('certificate_admin_allot.certi_id',$app_id);
			$this->db->where('certificate_admin_allot.user_id',$user_id);
			$this->db->join('checklist_tbl', 'certificate_admin_allot.checklist = checklist_tbl.cl_id', 'left');
			return $this->db->get('certificate_admin_allot')->row_array();
		}
		
		function get_user_business($user_id)
		{
			$this->db->select('option3.*');
			$this->db->select('enterprise.user_id');
			$this->db->where('user_id', $user_id);
			$this->db->join('enterprise', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('option3')->row();
		}

		public function insert_data($tbl,$params)
		{
			$this->db->insert(trim($tbl),$params);
		    return  $this->db->insert_id();
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

		function get_monthly_application($admin_id,$monthWise)
		{
			$month = date('Y-m', strtotime($monthWise));
			$this->db->select('option3.*');
			$this->db->select('enterprise.user_id');
			$this->db->order_by('applyMonth','ASC');
			$this->db->where('subAdmin', $admin_id);
			$this->db->where('applyMonth', $month);
			$this->db->join('enterprise', 'enterprise.id = option3.enterprise_id', 'left');
			return $this->db->get('option3')->result_array();
		}

		function get_sector_wise_application($admin_id,$month)
		{
			if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$mont = "AND applyMonth = '$searchMonth' AND certficationStatus = 5";
			}
			else
			{
				$mont = "AND certficationStatus = 5";
			}
			return $this->db->query("SELECT COUNT(option3.sector) as totSector,sector FROM option3 WHERE option3.subAdmin='$admin_id' $mont")->result_array();
		}

		function sector_wise_app_reports($admin_id,$month,$sectorName)
		{
			/*if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$this->db->where('applyMonth',$searchMonth);
			}
			$this->db->where('subAdmin',$admin_id);
			$this->db->where('certficationStatus','5');
			$this->db->where('sector',$sectorName);
			$this->db->get('option3')->result_array();
			return $this->db->count_all_results();*/
			
			$this->db->query("SELECT COUNT(id) as totSector FROM option3 WHERE certficationStatus = '5' AND subAdmin = '$admin_id' AND sector = '$sectorName'")->row_array()['totSector'];
		}
		function sector_wise_app_list($admin_id,$month,$sectorName)
		{
			if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$this->db->where('applyMonth',$searchMonth);
			}
			$this->db->where('subAdmin',$admin_id);
			$this->db->where('certficationStatus','5');
			$this->db->where('sector',$sectorName);
			return $this->db->get('option3')->result_array();
		}
		
		function sector_wise_data_count($admin_id,$month)
		{
		    if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$mont = "AND applyMonth = '$searchMonth' AND certficationStatus = 5";
			}
			else
			{
				$mont = "AND certficationStatus = 5";
			}
			return $this->db->query("SELECT COUNT(option3.sector) as totSector, option3.sector FROM option3 WHERE subAdmin = '$admin_id' $mont GROUP BY option3.sector")->result_array();
		}
		
		
		function district_wise_app_reports($admin_id,$month,$distId)
		{
		    $this->db->select('users.id,users.name');
		    $this->db->select('enterprise.user_id');
		    $this->db->select('option3.*');
			if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$this->db->where('applyMonth',$searchMonth);
			}
		
			$this->db->where('subAdmin',$admin_id);
			$this->db->where('certficationStatus','5');
			$this->db->where('users.district',$distId);
			$this->db->join('enterprise','users.id = enterprise.user_id','left');
			$this->db->join('option3','enterprise.id = option3.enterprise_id','left');
			$this->db->from('users');
			return $this->db->count_all_results();
		}

		function district_wise_app_counts($admin_id,$month)
		{
		    if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$mont = "AND applyMonth = '$searchMonth' AND certficationStatus = 5";
			}
			else
			{
				$mont = "AND certficationStatus = 5";
			}
			//return $this->db->query("SELECT count(users.district) as totDist, districts.name FROM users LEFT JOIN enterprise ON users.id = enterprise.user_id LEFT JOIN option3 ON enterprise.id = option3.enterprise_id LEFT JOIN districts ON users.district = districts.id WHERE option3.subAdmin = '$admin_id' $mont group by users.district")->result_array();
			return $this->db->query("SELECT tbl1.name, IFNULL(tbl2.district,0) totCount FROM (SELECT districts.name,districts.id FROM districts) as tbl1 LEFT JOIN (SELECT COUNT(district) as district FROM `users`) as tbl2 ON tbl1.id = tbl2.district GROUP BY tbl1.id")->result_array();
		}
		function district_wise_app_value_counts($admin_id,$month)
		{
		    if(!empty($month))
			{
				$searchMonth = date('Y-m', strtotime($month));
				$mont = "AND applyMonth = '$searchMonth' AND certficationStatus = 5";
			}
			else
			{
				$mont = "AND certficationStatus = 5";
			}
			//return $this->db->query("SELECT count(users.district) as totDist, districts.name FROM users LEFT JOIN enterprise ON users.id = enterprise.user_id LEFT JOIN option3 ON enterprise.id = option3.enterprise_id LEFT JOIN districts ON users.district = districts.id WHERE option3.subAdmin = '$admin_id' $mont group by users.district")->result_array();
			return $this->db->query("SELECT IFNULL(tbl2.district,0) totCount FROM (SELECT districts.name,districts.id FROM districts) as tbl1 LEFT JOIN (SELECT COUNT(district) as district FROM `users`) as tbl2 ON tbl1.id = tbl2.district GROUP BY tbl1.id")->result_array();
		}
		
		
		function get_application_sts($user_id,$app_id)
		{
			return $this->db->query("SELECT statusManage,statusType,statusRemark FROM status_manage_tbl WHERE user_id = '$user_id' AND application_id = '$app_id'")->result_array();
		}
		function get_kyc_sts($user_id)
		{
			return $this->db->query("SELECT statusManage,statusType,statusRemark FROM status_manage_tbl WHERE user_id = '$user_id'")->result_array();
		}
		 
	}
?>