<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/user_model', 'user_model'); 
		$this->load->model('admin/crud_model', 'crud_model'); 
		// load Excel library
         //$this->load->library('excel');
	}

	public function index(){

		$data['title'] = 'Excel Export';
		$data['cities'] = $this->crud_model->get_cities("leads", "city");
		$data['courses'] = $this->crud_model->get_all("courses");	
		$this->load->view('admin/export',$data);

	}

	public function export(){

		
			/* file name */
		$filename = 'users_'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
	   /* get data */
		$usersData = $this->crud_model->get_all("ci_users");
		/* file creation */
		$file = fopen('php:/* output','w'); 
		$header = array("id","Name"); 
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit;   
		
	}

	
	public function exportExcelData($records)
	{
	$heading = false;
			if (!empty($records))
				foreach ($records as $row) {
					if (!$heading) {
						// display field/column names as a first row
						echo implode("\t", array_keys($row)) . "\n";
						$heading = true;
					}
					echo implode("\t", ($row)) . "\n";
				}
	}
	
	public function download()  {

		$from_date = $this->input->post("from_date")." 00:00:00";
		$to_date = $this->input->post("to_date")." 23:59:59";
		$service = $this->input->post("service");
		$city = $this->input->post("city");
		$status = $this->input->post("status");

		if($this->session->userdata("user_type") == "Telecaller"){
				$user = $this->session->userdata("user_id");
		} else {
			$user = "";
		}

		$allData = $this->crud_model->search_leads($from_date, $to_date, $service, $city, $user, "status", $status, "results");
		
		$dataToExports = [];
		foreach ($allData as $data) {
			$arrangeData['Service'] = $data->service;
			$arrangeData['Client Name'] = $data->name;
			$arrangeData['Email'] = $data->email;
			$arrangeData['Mobile No.'] = $data->mobile;
			$arrangeData['City'] = $data->city;
			$arrangeData['Status'] = $data->status;
			$arrangeData['Followup Date'] = $data->followup_date;
			$arrangeData['Appointment Status'] = $data->demo_status;
			$arrangeData['Appointment Date'] = $data->demo_date;
			$arrangeData['Appointment Time'] = $data->demo_date;
			$arrangeData['Source'] = $data->source;
			$dataToExports[] = $arrangeData;
		}

		
		// set header
		$filename = date("YmdHis")."-export.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		$this->exportExcelData($dataToExports); 	


	}

	
	

}
?>