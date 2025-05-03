<?php

require APPPATH . '/libraries/REST_Controller.php';

class User_grievanace_api extends CI_Controller

{

    public function __construct(){

        header('Access-Control-Allow-Origin: *');

        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {

            die();

        }

        parent::__construct();

        $this->load->model('Crud_model', 'crud_model'); 

    }



    public function add_new_grievanace()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

            $usrDetails = $this->crud_model->select_row("users", ["id" => $postdata->user_id]);

			$user_id = $postdata->user_id;

			$this->form_validation->set_rules($postdata->query_type, 'query type', 'required');

			$this->form_validation->set_rules($postdata->subject, 'subject', 'required');

			$this->form_validation->set_rules($postdata->content, 'details', 'required');

			if ($this->form_validation->run()) 

            {

				$data = array(

					'errors' => validation_errors()

				);

				$res['response'] = '0';

                $res['message'] = 'Enter all required feilds.';

			} 

            else 

            {

                $grievancesFile = $postdata->file;

                $file_ext = $postdata->file_ext;

                $grievancFl = base64_decode($grievancesFile); 

                $date = 'grievanac_file_'.date('YmdHis'); 

                $grievancePath = 'uploads/grievances/'.$date.'.'.$file_ext;

                if($grievancFl != false) {

                    $grievanPath = $grievancePath;

                    file_put_contents($grievanPath,$grievancFl);

                }

                else {

                    $grievanPath = '';

                }

                $ticketId= $this->grievance_code_generate();

				$data = array(

					'grievance_id' => $ticketId,

					'subject' => $postdata->subject,

					'query_type' => $postdata->query_type,

					'file' => $grievanPath,

					'content' => $postdata->content,

					'created_at' => date("Y-m-d H:i:s"),

					'updated_at' => date("Y-m-d H:i:s"),

					'user_id' => $postdata->user_id,

					'user_type' => "User",

					'status' => "Open"

				);

				$data = $this->security->xss_clean($data);

				$result = $this->crud_model->insert("grievance", $data);
				$result1 = $this->crud_model->insert("l1_grievance", $data);

				if($result && $result1)

                {

                    $dates = date('Y-m-d');

                    $times = date('h:i:s a');

                    $sms = "Dear $usrDetails->name, Your grievance with the ticket number $ticketId is successfully raised on Date $dates at Time $times. Our team will get in touch with you shortly. Please login into your dashboard for more details. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";

                    $sendSms = get_sms($usrDetails->phone,$sms,'1507166418754565897');

                    $res['response'] = '1';

                    $res['message'] = 'Data added successfully!';

				}

			}

		}

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Enter valid details.';

        }

        echo json_encode($res);

	}



    public function grievanaces_listing()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

            

            $selGreivance = $this->crud_model->select("grievance", ["user_id"=>$postdata->user_id,"user_type"=>"User"], "id ASC");

            if($selGreivance)

            {

                $res['response'] = '1';

                $res['message'] = 'List';

                $res['greivances'] = $selGreivance;

                $res['imgUrl'] = base_url();

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Grievanaces not found';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid details.';

        }

        echo json_encode($res);

    }



    public function grievance_code_generate()

    {

        $code = rand('100000','999999');

        $finalNum = 'GUDY'.$code;

        if($this->crud_model->check_duplicate('grievance',['grievance_id'=>$finalNum]))

        {

            $grievance = $this->grievance_code_generate();

        }

        else

        {

            $grievance = $finalNum;

        }

        return $grievance;

    }



    public function new_chat_create()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$this->form_validation->set_rules($postdata->greivances_id, 'greivance id', 'required');

			$this->form_validation->set_rules($postdata->user_id, 'User', 'required');

			$this->form_validation->set_rules($postdata->content, 'details', 'required');

			if ($this->form_validation->run()) 

            {

				$data = array(

					'errors' => validation_errors()

				);

				$res['response'] = '0';

                $res['message'] = 'Enter all required feilds.';

			} 

            else 

            {

				$data = array(

					'greivances_id' => $postdata->greivances_id,

                    'user_id' => $postdata->user_id,

					'user_type' => "user",

					'contents' => $postdata->content,

					'added_at' => date("Y-m-d"),

					'added_time' => date("H:i:s")

				);

				$data = $this->security->xss_clean($data);

				$result = $this->crud_model->insert("greivances_chat_tbl", $data);

				if($result)

                {

                    $res['response'] = '1';

                    $res['message'] = 'Data added successfully!';

				}

			}

		}

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Enter valid details.';

        }

        echo json_encode($res);

    }



    public function chat_detil_by_grievance()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

			$greivances_id = $postdata->greivances_id;

            

            $selGreivance = $this->crud_model->select("greivances_chat_tbl", ["greivances_id"=>$postdata->greivances_id], "g_id ASC");

            if($selGreivance)

            {

                $res['response'] = '1';

                $res['message'] = 'List';

                $res['chatting'] = $selGreivance;

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Chat not found';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid details.';

        }

        echo json_encode($res);

    }



    public function add_new_documents()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

			$this->form_validation->set_rules($postdata->user_id, 'User Id', 'required');

			if ($this->form_validation->run()) 

            {

				$data = array(

					'errors' => validation_errors()

				);

				$res['response'] = '0';

                $res['message'] = 'Enter all required feilds.';

			} 

            else 

            {

                $docsFile = $postdata->doc_file;

                $doc_ext = $postdata->doc_ext;

                $docFile = base64_decode($docsFile); 

                $date = 'docs_file_'.date('YmdHis'); 

                $docsPath = 'uploads/document/'.$date.'.'.$doc_ext;

                if($docFile != false) {

                    $docPath = $docsPath;

                    file_put_contents($docPath,$docFile);

                }

                else {

                    $docPath = '';

                }

				$data = array(

					'name' => $postdata->doc_name,

					'file_name' => $docsPath,

                    'user_id' => $postdata->user_id,

                    'certficate_id' => $postdata->certficate_id,

					'created_at' => date("Y-m-d H:i:s")

				);

				$data = $this->security->xss_clean($data);

				$result = $this->crud_model->insert("documents", $data);

				if($result)

                {

                    $res['response'] = '1';

                    $res['message'] = 'Data added successfully!';

				}

			}

		}

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Enter valid details.';

        }

        echo json_encode($res);

	}



    public function document_list_by_users()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

            $docsList = $this->crud_model->select("documents", ["user_id"=>$postdata->user_id], "id ASC");

            if($docsList)

            {

                $res['response'] = '1';

                $res['message'] = 'List';

                $res['docs'] = $docsList;

                $res['kyc_docs'] = $this->db->query("select users.adhaar_file,users.pan_file from users where id = '$postdata->user_id'")->result_array();

                $res['fileUrl'] = base_url();

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Chat not found';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid details.';

        }

        echo json_encode($res);

    }





    public function get_meeting_list()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

            $metList = $this->crud_model->select("schedule_meeting_tbl", ["user_id"=>$postdata->user_id], "sm_id DESC");

            if($metList)

            {

                $res['response'] = '1';

                $res['message'] = 'Meetig Schedule List';

                $res['meeting'] = $metList;

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Chat not found';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid details.';

        }

        echo json_encode($res);

    }



    public function get_dashboar_counts()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

             if($user_id)

            {

                $res['response'] = '1';

                $res['message'] = 'Dashboard counts';

                $res["grievance_raised"] = $this->crud_model->get_data_count("grievance",["user_id"=>$postdata->user_id,"user_type"=>"User","status"=>"Raised"]);

                $res["grievance_review"] = $this->crud_model->get_data_count("grievance",["user_id"=>$postdata->user_id,"user_type"=>"User","status"=>"Review"]);

                $res["grievance_close"] = $this->crud_model->get_data_count("grievance",["user_id"=>$postdata->user_id,"user_type"=>"User","status"=>"Closed"]);

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Data is empty';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid request.';

        }

        echo json_encode($res);

    }



    public function get_dashboar_account_status()

    {

        $postdata = json_decode( file_get_contents('php://input') );

		if($postdata)

        {

			$user_id = $postdata->user_id;

            if($user_id)

            {

                $sts = array('1'=>'Draf','2'=>'KYC Submited','3'=>'KYC Verification','4'=>'Rejected','5'=>'Hold');

                $res['response'] = '1';

                $res['message'] = 'My account status';

                $res["user_status"] = $this->db->query("select status from users where id = '$postdata->user_id'")->row_array()['status'];

                $res["certification_status"] = $this->db->query("SELECT option3.certficationStatus FROM `option3` LEFT JOIN enterprise ON option3.enterprise_id = enterprise.id WHERE enterprise.user_id = '$postdata->user_id'")->row_array()['certficationStatus'];

                $res["account_status"] = $sts;

                $res["certificate_status"] = array("1"=> "submited","2"=>"process","3"=>"verified","4" =>"interview schedule","5"=>"approve","6"=>"reject","7"=>"on hold");

                $res["option1"] = $this->db->query("SELECT COUNT(user_id) as totRec FROM enterprise LEFT JOIN option1 ON option1.enterprise_id = enterprise.user_id WHERE enterprise.user_id ='$postdata->user_id' AND enterprise.tbl_name = 'option1'")->row_array();

                $res["option2"] = $this->db->query("SELECT COUNT(user_id) as totRec FROM enterprise LEFT JOIN option2 ON option2.enterprise_id = enterprise.user_id WHERE enterprise.user_id ='$postdata->user_id' AND enterprise.tbl_name = 'option2'")->row_array();

                $res["option3"] = $this->db->query("SELECT COUNT(user_id) as totRec FROM enterprise LEFT JOIN option3 ON option3.enterprise_id = enterprise.user_id WHERE enterprise.user_id ='$postdata->user_id' AND enterprise.tbl_name = 'option3'")->row_array();

            }

            else

            {

                $res['response'] = '0';

                $res['message'] = 'Data is empty';

            }

        }

        else

        {

            $res['response'] = '0';

            $res['message'] = 'Invalid request.';

        }

        echo json_encode($res);

    }







 

}