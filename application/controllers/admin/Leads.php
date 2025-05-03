<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/leads_model', 'leads_model');
		$this->load->model('admin/user_model', 'user_model');
		$this->load->model('admin/crud_model', 'crud_model'); 
		// load CSV library
        $this->load->library('CSVReader');
	}

	public function index($id){

		$data['title'] = 'Leads';

		

		$this->load->view('admin/all-leads',$data);

	}


	public function all(){

		$data['title'] = 'Total Leads';

		if($this->input->post('search')){
			
			$data['service'] = $this->input->post("service");
			$data['city'] = $this->input->post("city");
			$data['status'] = $this->input->post("status");

			$this->db->select('*');
			$this->db->from('leads');	

			if($this->input->post("service") != ''){
				$this->db->where('service', $this->input->post("service"));
			}
			if($this->input->post("city") != ''){
				$this->db->where('city', $this->input->post("city"));
			}
			if($this->input->post("status")!=''){
				$this->db->where('status', $this->input->post("status"));
			}
			$this->db->order_by('id', 'desc');
			$query = $this->db->get();
			$data['leads'] = $query->result();

		} else {
			
			$data['leads'] = $this->leads_model->get_all();
			
			$data['service'] = "";
			$data['city'] = "";
			$data['status'] = "";

		}

		$this->load->view('admin/all-leads',$data);

	}

	public function web(){

		$data['title'] = 'Web Enquiry Leads';

		$search = array('source' => 'Web Enquiry');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function call(){

		$data['title'] = 'Call Enquiry Leads';

		$search = array('source' => 'Call API');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function hot(){

		$data['title'] = 'Unattended Leads';

		$search = array('status' => 'New');
		
		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function future(){

		$data['title'] = 'Unattended Leads';

		$search = array('status' => 'Future');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}


	public function notinterest(){

		$data['title'] = 'Not Interested Leads';

		$search = array('status' => 'Not Interested');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function notresponding(){

		$data['title'] = 'Not Responding Leads';

		$search = array('status' => 'Not Responding');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function priceissue(){

		$data['title'] = 'Price Issue Leads';

		$search = array('status' => 'Price Issue');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function joined(){

		$data['title'] = 'Joined Leads';

		$search = array('status' => 'Joined');		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function followups(){

		$data['title'] = 'Today Follow Ups';		

		$search = array('followup_date' => date("Y-m-d"));		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function upcomingFollowups(){

		$data['title'] = 'Upcoming Follow Ups';		

		$data['leads'] = $this->leads_model->get_future_followups();

		$this->load->view('admin/future-leads',$data);

	}

	public function pendingFollowups(){

		$data['title'] = 'Pending Follow Ups';		

		$data['leads'] = $this->leads_model->get_pending_followups();

		$this->load->view('admin/future-leads',$data);

	}

	
	public function demos(){

		$data['title'] = 'Today Appointments ';		

		$search = array('demo_date' => date("Y-m-d"));		

		$data['leads'] = $this->leads_model->get_leads($search);

		$this->load->view('admin/future-leads',$data);

	}

	public function upcomingDemos(){

		$data['title'] = 'Upcoming Appointments ';		

		$data['leads'] = $this->leads_model->get_future_demos();

		$this->load->view('admin/future-leads',$data);

	}

	public function pendingDemos(){

		$data['title'] = 'Pending Appointments ';		

		$data['leads'] = $this->leads_model->get_pending_demos();

		$this->load->view('admin/future-leads',$data);

	}

	public function demoStatus(){

		$data['title'] = 'Appointment Status';		

		$data['leads'] = $this->crud_model->get_all("appointments");

		$this->load->view('admin/appointment-leads',$data);

	}

		

	//-----------------------------------------------------------
	public function import(){   
	
		if($this->input->post("submit")){
			
			$id = $this->input->post("service");
			$start = $this->input->post("start");
			$end = $this->input->post("end");

			if($id==126){

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id&start=$start&end=$end"),true);

				$i = 0;
				foreach($json_data as $row){
					
											
						$fields = array('name' => $row['fname'],
										'service' => $row['service'],
										'ip_address' => $row['submit_ip'],
										'created_at' => $row['submit_time']);

						if($this->check_duplicate($fields) == TRUE){

								$fields = array('name' => $row['fname'],
												'city' => $row['location'],
												'mobile' => $row['mobile'],
												'msg' => $row['message'],
												'service' => $row['service'],
												'created_at' => $row['submit_time'],
												'updated_at' => "",
												'ip_address' => $row['submit_ip'],
												'status' => 'New',
												'source' => 'Web Enquiry');

								$this->db->insert('leads', $fields);

								$i++;

						}
					
				}


			} elseif($id==1179){

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id&start=$start&end=$end"),true);

				$i = 0;
				foreach($json_data as $row){
					
											
						$fields = array('name' => $row['fname'],
										'service' => $row['service'],
										'ip_address' => $row['submit_ip'],
										'created_at' => $row['submit_time']);

						if($this->check_duplicate($fields) == TRUE){

								$fields = array('name' => $row['fname'],
												'city' => $row['location'],
												'mobile' => $row['mobile'],
												'email' => $row['email'],
												'msg' => '',
												'service' => $row['service'],
												'created_at' => $row['submit_time'],
												'updated_at' => "",
												'ip_address' => $row['submit_ip'],
												'status' => 'New',
												'source' => 'Web Enquiry');

								$this->db->insert('leads', $fields);

								$i++;

						}
					
				}


			} elseif($id==703){

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id&start=$start&end=$end"),true);

				$i = 0;
				foreach($json_data as $row){
					
											
						$fields = array('name' => $row['fname'],
										'service' => $row['service'],
										'ip_address' => $row['submit_ip'],
										'created_at' => $row['submit_time']);

						if($this->check_duplicate($fields) == TRUE){

								$fields = array('name' => $row['fname'],
												'city' => $row['location'],
												'mobile' => $row['mobile'],
												'msg' => $row['message'],
												'service' => $row['service'],
												'created_at' => $row['submit_time'],
												'updated_at' => "",
												'ip_address' => $row['submit_ip'],
												'status' => 'New',
												'source' => 'Web Enquiry');

								$this->db->insert('leads', $fields);

								$i++;

						}
					
				}


			} elseif($id==1124){

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id&start=$start&end=$end"),true);

				$i = 0;
				foreach($json_data as $row){
					
											
						$fields = array('name' => $row['fname'],
										'service' => $row['service'],
										'ip_address' => $row['submit_ip'],
										'created_at' => $row['submit_time']);

						if($this->check_duplicate($fields) == TRUE){

								$fields = array('name' => $row['fname'],
												'city' => $row['location'],
												'mobile' => $row['mobile'],
												'msg' => $row['message'],
												'service' => $row['service'],
												'created_at' => $row['submit_time'],
												'updated_at' => "",
												'ip_address' => $row['submit_ip'],
												'status' => 'New',
												'source' => 'Web Enquiry');

								$this->db->insert('leads', $fields);

								$i++;

						}
					
				}


			} else {

				header('Content-type: application/json');
				
				$json_data = json_decode(file_get_contents("https://www.petsfolio.com/api/index.php?id=$id&start=$start&end=$end"),true);
				$i = 0;
				foreach($json_data as $row){
					
						$services =  array('703'=>'Contact', 
											'1160'=>'Protection Dog', 
											'1159'=>'Dog Behavior', 
											'23'=>'Dog Training',
											'24'=>'Dog Walking',
											'25' => 'Grooming',
											'26' => 'Pets Hostel',
											'27' => 'Vet on Wheels',
											'1122' => 'Dog Obedience',
											'126' => 'Services',
											'1124' => 'Pre Puppy Consultation',
											'1179' => 'Group Training');

						$fields = array('name' => $row['yname'],
										'mobile' => $row['ymobile'],
										'service' => $services[$id],
										'ip_address' => $row['submit_ip']);

						if($this->check_duplicate($fields) == TRUE){

								$fields = array('name' => $row['yname'],
												'city' => $row['ycity'],
												'mobile' => $row['ymobile'],
												'msg' => $row['msg'],
												'service' => $services[$id],
												'created_at' => $row['submit_time'],
												'updated_at' => "",
												'ip_address' => $row['submit_ip'],
												'status' => 'New',
												'source' => 'Web Enquiry');

								$this->db->insert('leads', $fields);

								$i++;

						}
					
				}

		}

			$this->session->set_flashdata('success', $i. ' Leads has been imported successfully!');
			redirect(base_url('admin/leads/import'));

		} else {

			$data['msg'] = "";
			$this->load->view('admin/api-import', $data);

		}
	}	
	
	
	public function check_duplicate($arr){

        $query = $this->db->get_where('leads', $arr);
        if($query->num_rows() == 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }

	//-----------------------------------------------------------
	public function create(){

		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Number', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/leads/create'),'refresh');
			}
			else{
				
				$data = array(
					'name' => $this->input->post('name'),
					'course' => $this->input->post('course'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'),
					'city' => $this->input->post('city'),
					'ip_address' => $this->input->ip_address(),
					'status' => $this->input->post('lead_status'),
					'followup_date' => $this->input->post('followup_date'),
					'demo_status' => $this->input->post('demo_status'),
					'demo_date' => $this->input->post('demo_date'),
					'demo_time' => $this->input->post('demo_time'),
					'sales' => $this->input->post('sales'),
					'assign_to' => $this->input->post('assign_to'),
					'source' =>  $this->input->post('lead_source'),
					'message' => $this->input->post('comment'),
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s"),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->db->insert('leads', $data);
				$last_id =  $this->db->insert_id();
				
				if($last_id){

					$data2 = array('lead_id' => $last_id,
								   'lead_status' => $this->input->post('lead_status'),
								   'followup_date' => $this->input->post('followup_date'),
								   'demo_status' => $this->input->post('demo_status'),
								   'demo_date' => $this->input->post('demo_date'),
								   'demo_time' => $this->input->post('demo_time'),
								   'comments' => $this->input->post('comment'),
								   'updated_at' => date('Y-m-d : H:i:s'),
								   'updated_by' => $this->session->userdata('user_id'));
								   
					$this->db->insert('leads_status',$data2);

					$this->session->set_flashdata('success', 'Lead has been added successfully!');
					redirect(base_url('admin/leads/create'));
				}
			}
		}
		else{

			$data['title'] = 'Add New Lead';
			$data['telecallers'] = $this->crud_model->get_some("ci_users", array("usertype" => "Telecaller"));
			$data['faculties'] = $this->crud_model->get_some("ci_users", array("usertype" => "Faculty"));
			$data['courses'] = $this->crud_model->get_all("courses");
			$this->load->view('admin/leads-add', $data);
			
		}	
		
		
	}

	//-----------------------------------------------------------
	public function edit($id){

		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Number', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/leads/create'),'refresh');
			}
			else{
				
				$data = array(
					'name' => $this->input->post('name'),
					'course' => $this->input->post('course'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'),
					'city' => $this->input->post('city'),
					'ip_address' => $this->input->ip_address(),
					'status' => $this->input->post('lead_status'),
					'followup_date' => $this->input->post('followup_date'),
					'demo_status' => $this->input->post('demo_status'),
					'demo_date' => $this->input->post('demo_date'),
					'demo_time' => $this->input->post('demo_time'),
					'faculty' => $this->input->post('faculty'),
					'message' => $this->input->post('comment'),
					'source' =>  $this->input->post('lead_source'),
					'assign_to' =>  $this->input->post('assign_to'),
					'updated_at' => date('Y-m-d H:i:s'),
				);

				$data = $this->security->xss_clean($data);
				$this->db->where('id', $id);
				$result = $this->db->update('leads', $data);
								
				if($result){

					$data2 = array('lead_status' => $this->input->post('lead_status'),
								   'followup_date' => $this->input->post('followup_date'),
								   'demo_status' => $this->input->post('demo_status'),
								   'demo_date' => $this->input->post('demo_date'),
								   'demo_time' => $this->input->post('demo_time'),
								   'comments' => $this->input->post('comment'),
								   'updated_at' => date('Y-m-d H:i:s'),
								   'updated_by' => $this->session->userdata('user_id'));
								   
					$this->db->where('lead_id', $id);
					$this->db->update('leads_status', $data2);

					$this->session->set_flashdata('success', 'Lead has been updated successfully!');
					redirect(base_url('admin/leads/edit/'.$id));
				}
			}
		}
		else{

			$data['title'] = 'Edit Leads';
			
			$data['lead'] = $this->leads_model->get_lead_id($id);
			$data['telecallers'] = $this->crud_model->get_some("ci_users", array("usertype" => "Telecaller"));
			$data['faculties'] = $this->crud_model->get_some("ci_users", array("usertype" => "Faculty"));
			$data['courses'] = $this->crud_model->get_all("courses");

			$this->load->view('admin/leads-edit', $data);
			
		}	
				
	}

	//-----------------------------------------------------------
	public function update($id){

		if($this->input->post('submit')){
			
			
				$data = array(
					'lead_status' => $this->input->post('lead_status'),
					'followup_date' => $this->input->post('followup_date'),
					'demo_status' => $this->input->post('demo_status'),
					'demo_date' => $this->input->post('demo_date'),
					'demo_time' => $this->input->post('demo_time'),
					'comments' => $this->input->post('comments'),
					'updated_at' => date("Y-m-d H:i:s"),
					'lead_id' => $id,
					'updated_by' => $this->session->userdata('user_id')
				);

					
					$data2 = array("is_imp" => $this->input->post('is_imp'),
								   "status" => $this->input->post('lead_status'),
								   "followup_date" => $this->input->post('followup_date'),
								   "demo_status" => $this->input->post('demo_status'),
								   "demo_date" => $this->input->post('demo_date'),
								   'demo_time' => $this->input->post('demo_time'),
								   'message' => $this->input->post('comments'),
								   'faculty' => $this->input->post('faculty'),
								   "updated_at" => date("Y-m-d H:i:s"));

					$this->db->where('id', $id);
					$this->db->update('leads', $data2);	
							

				$data = $this->security->xss_clean($data);
				$result = $this->db->insert('leads_status', $data);

				$this->session->set_flashdata('success', 'Lead has been updated successfully!');
				redirect(base_url('admin/leads/update/'.$id));

		} else {

			$data['title'] = 'Edit Leads';
			
			$data['lead'] = $this->leads_model->get_lead_id($id);
			$data['leads_status'] = $this->leads_model->get_leads_by_id($id);
			$data['faculties'] = $this->crud_model->get_some("ci_users", array("usertype" => "Faculty"));

			$this->load->view('admin/leads-history', $data);

		}	
		
	}

	//-----------------------------------------------------------
	public function history($id){

		if($this->input->post('submit')){
			
			
				$data = array(
					'lead_status' => $this->input->post('lead_status'),
					'followup_date' => $this->input->post('followup_date'),
					'demo_status' => $this->input->post('demo_status'),
					'demo_date' => $this->input->post('demo_date'),
					'demo_time' => $this->input->post('demo_time'),
					'comments' => $this->input->post('comments'),
					'updated_at' => date("Y-M-d H:i:s"),
					'lead_id' => $id,
					'updated_by' => $this->session->userdata('user_id')
				);

					
					$data2 = array("is_imp" => $this->input->post('is_imp'),
								   "status" => $this->input->post('lead_status'),
								   "followup_date" => $this->input->post('followup_date'),
								   "demo_status" => $this->input->post('demo_status'),
								   "demo_date" => $this->input->post('demo_date'),
								   'demo_time' => $this->input->post('demo_time'),
								   'message' => $this->input->post('comments'),
								   'sales' => $this->input->post('sales'));

					$this->db->where('id', $id);
					$this->db->update('leads', $data2);	
							

				$data = $this->security->xss_clean($data);
				$result = $this->db->insert('leads_status', $data);

				$this->session->set_flashdata('success', 'Lead has been updated successfully!');
				redirect(base_url('admin/leads/update/'.$id));

		} else {

			$data['title'] = 'Update Lead Appointments';
			
			$data['lead'] = $this->leads_model->get_lead_id($id);
			$data['leads_status'] = $this->crud_model->get_some("appointments", array("lead_id" => $id));
			$data['excutives'] = $this->crud_model->get_all("sales");

			$this->load->view('admin/appointment-history', $data);

		}	
		
	}

	public function view(){
		if($this->input->post('id')){

			$id = $this->input->post('id');

			$query = $this->db->get_where('leads', array('id' => $id));
			$row = $query->row();
			

			$data = '<table class="table mb-0">
			<tbody>
				<tr>
					<th scope="row">Course Name</th>
					<td>'.$row->course.'</td>
				</tr>
				<tr>
					<th scope="row">Name</th>
					<td>'.$row->name.'</td>
				</tr>
				<tr>
					<th scope="row">Mobile No.</th>
					<td>'.$row->mobile.'</td>
				</tr>
				<tr>
					<th scope="row">Email</th>
					<td>'.$row->email.'</td>
				</tr>
				<tr>
					<th scope="row">City</th>
					<td>'.$row->city.'</td>
				</tr>
				
				<tr>
					<th scope="row">Comment</th>
					<td>'.$row->message.'</td>
				</tr>
				<tr>
					<th scope="row">Submit Date</th>
					<td>'.$row->created_at.'</td>
				</tr>
				<tr>
					<th scope="row">Updated Date</th>
					<td>'.$row->updated_at.'</td>
				</tr>
				
				<tr>
					<th scope="row">Status</th>
					<td>'.$row->status.'</td>
				</tr>
				<tr>
					<th scope="row">Source</th>
					<td>'.$row->source.'</td>
				</tr>
			</tbody>
		</table>';

		echo $data;

		
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('refferals', array('id' => $id));
		$this->session->set_flashdata('success', 'Use has been deleted successfully!');
		redirect(base_url('admin/refferals'));
	}

	//---------------------------------------------------------------
	//  Export Users PDF 
	public function create_users_pdf(){

		$this->load->helper('pdf_helper'); // loaded pdf helper
		$data['all_users'] = $this->user_model->get_users_for_export();
		$this->load->view('admin/users/users_pdf', $data);
	}

	//---------------------------------------------------------------		
	// Export data in CSV format 
	public function export_csv(){ 

		$filename = 'refferals_'.date('Y-m-d').'.csv'; 

		$storData = array();
        $metaData[] = array(
						'id' => 'S.No.', 
						'student' => 'Student Name', 
						'mobile' => 'Mobile No.', 
						'course' => 'Course Name',
						'refer_by' => 'Reffered By',
						'payment' => 'Payment Info',
						'created_at' => 'Reffered Date & Time',
						'status' => 'Status',
						'amount' => 'Amount',
						'reason' => 'Reason'
						);       
       
        // get data 
		$data = $this->referals_model->get_all_refferals();

		$i=1;
        foreach($data as $key=>$row) {
			$user_info = $this->referals_model->get_user_by_id($row->user_id);

			if($row->status==1) $status = 'Success'; elseif($row->status==2) $status = 'Fail'; else $status = 'New';

            $storData[] = array(
                'id' => $i,
				'student' => $row->student,
                'mobile' => $row->mobile,
                'course' => $row->course,
				'refer_by' => $user_info->name,
				'payment' => $user_info->payment_type.'-'.$user_info->upi_mobile,
				'created_at' => $row->created_at,
				'status' => $status,
				'amount' => $row->amount,
				'reason' => $row->reason
            );
			$i++;
        }
        $data = array_merge($metaData,$storData);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=$filename"); 
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
	}

	

}


	?>