<?php defined('BASEPATH') OR exit('No direct script access allowed');



class AdminExport_ctr extends My_Controller {



	function __construct()

    {

        parent::__construct();

        $allowedAdmin = array('admin_id');

        $check = array_intersect_key(array_flip($allowedAdmin),($this->session->userdata()));

        if(count($check)<=0)

        {

            $allowed = array();

			if (!in_array($this->router->fetch_method(), $allowed))

			{

				switch($_SERVER['REQUEST_METHOD'])

				{

					case "POST":

					if ($this->input->is_ajax_request())

					{

						$res['response'] = "error";

						$res['message']  = "Session timed out. Please login again";

						echo json_encode($res);

						exit();

					}

					else

					{

						$this->session->set_flashdata('msg','Session timed out. Please login again');

						redirect(base_url('master_logout'));

					}

					break;

					case "GET":

					redirect(base_url('master_logout'));

					// break;

				}

			}

        }

		if($this->session->userdata('admin_type') != '1')

		{

			redirect(base_url('master_logout'));

		}

		$this->load->model('admin/AdminExport_modal', 'export_data');

    }





	//--------------------------------------------------------------------------

	public function index()

	{

		$data['title'] = 'User Export';

		$this->load->view('admin/export/index', $data);	

	}	



    public function excell_data_imports()

	{

        $data['heading'] = 'Export user';

        $data['files'] = $this->db->query("SELECT * FROM fileexportlist");



        $this->load->library('excell/PHPExcel');

        $adminid = $this->session->userdata('team_admin_id');

	    if(isset($_FILES["excelfile"]["name"]))

        {

            $fileName = $_FILES["excelfile"]["name"];

             

    	    //$object = PHPExcel_IOFactory::load("userformate.xlsx");

    	    $path = $_FILES["excelfile"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            foreach($object->getWorksheetIterator() as $worksheet)

            {

               

                $highestRow = $worksheet->getHighestRow();

                $highestColumn = $worksheet->getHighestColumn();

                $i=0;

                $j=0;

                for($row=2; $row<=$highestRow; $row++)

                {

                    $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();

                    $email = $worksheet->getCellByColumnAndRow(1, $row)->getValue();

                    $password = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

                    $phone = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                    $dob = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

                    $kyc = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                    $category = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                    $district = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                    $mandal = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                    $village = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                    $adhaar_no = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

                    $adhaar_file = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

                    $pan_no = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

                    $pan_file = $worksheet->getCellByColumnAndRow(13, $row)->getValue();

                    $education = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

                    $employment = $worksheet->getCellByColumnAndRow(15, $row)->getValue();

                    $institution = $worksheet->getCellByColumnAndRow(16, $row)->getValue();

                    $pwd = $worksheet->getCellByColumnAndRow(17, $row)->getValue();

                    $otp = $worksheet->getCellByColumnAndRow(18, $row)->getValue();

                    $created_at = $worksheet->getCellByColumnAndRow(19, $row)->getValue();

                    $updated_at = $worksheet->getCellByColumnAndRow(20, $row)->getValue();

                    $status = $worksheet->getCellByColumnAndRow(21, $row)->getValue();

                    $is_verify = $worksheet->getCellByColumnAndRow(22, $row)->getValue();

                    $token = $worksheet->getCellByColumnAndRow(23, $row)->getValue();

                    $userPic = $worksheet->getCellByColumnAndRow(24, $row)->getValue();

                    $dataType = $worksheet->getCellByColumnAndRow(25, $row)->getValue();

                    $otherInstitute = $worksheet->getCellByColumnAndRow(26, $row)->getValue();



                    // $months =  date('Y-m',strtotime($month));

                    // $invoicDates =  date('Y-m-d',strtotime($invoicDate));                    

                    if(!empty($name) && !empty($phone))

                    {

                        $in_param["name"]=$name;

                        $in_param["email"]= $email;

                        $in_param["password"]= $password;

                        $in_param["phone"]= $phone;

                        $in_param["dob"]=$dob;

                        $in_param["kyc_id"]= $kyc;

                        $in_param["category"]=$category;

                        $in_param["district"]= $district;

                        $in_param["mandal"]= $mandal;

                        $in_param["village"]= $village;

                        $in_param["adhaar_no"]= $adhaar_no;

                        $in_param["adhaar_file"]= $adhaar_file;

                        $in_param["pan_no"]= $pan_no;

                        $in_param["pan_file"]= $pan_file;

                        $in_param["education"]= $education;

                        $in_param["employment"]= $employment;

                        $in_param["institution"]= $institution;

                        $in_param["pwd"]= $pwd;

                        $in_param["otp"]= $otp;

                        $in_param["created_at"]= $created_at;

                        $in_param["updated_at"]= $updated_at;

                        $in_param["status"]= $status;

                        $in_param["is_verify"]= $is_verify;

                        $in_param["token"]= $token;

                        $in_param["userPic"]= $userPic;

                        $in_param["dataType"]= $dataType;

                        $in_param["otherInstitute"]= $otherInstitute;

                        $in_param["expFileName"]= $fileName;

                        $this->export_data->insert_data('users',$in_param);

                    }

                }

            }

            

            $file_sts["fileName"]= $fileName;

            $this->export_data->insert_data('fileexportlist',$file_sts);

            $this->session->set_flashdata("msg_info","Successfull Uploaded data");

            redirect(base_url("master_export_user"),"refresh");

        }

        else

        {

            $this->session->set_flashdata("msg_info","Select Excell File");

            redirect(base_url("master_export_user"),"refresh");

        }

	}

	 

 

}



?>