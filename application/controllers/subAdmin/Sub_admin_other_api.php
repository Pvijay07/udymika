<?php
class Sub_admin_other_api extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('subAdmin/SubAdminApi_model', 'subAdmin_api');
        $this->load->model('Crud_model', 'crud_model'); 
    }

    public function admin_user_assign_list()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $user_info = $this->subAdmin_api->user_list_assign_admin($postdata->admin_id,'2');
            //print_r($this->db->last_query());
            if($user_info)
            {
                $res['datas'] = $user_info;
                $res['response'] = '1';
                $res['message'] = 'Users assigned list'; 
            } 
            else 
            {
                $res['response'] = '0';
                $res['message'] = 'No user assigned.';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
   

    public function admin_user_verify_list()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $admin_id = $postdata->admin_id;
            $user_info = $this->subAdmin_api->user_list_assign_admin($admin_id,'3');
            if($user_info)
            {
                $res['datas'] = $user_info;
                $res['response'] = '1';
                $res['message'] = 'Users verify list'; 
                $res['imgUrl'] = base_url(); 
            } 
            else 
            {
                $res['response'] = '0';
                $res['message'] = 'No user assigned.';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}

    public function admin_assigned_user_details()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $admin_id = $postdata->admin_id;
            $user_id = $postdata->user_id;
            $app_id = $postdata->certificate_id;
            if(!empty($postdata->user_id))
            {
                $user_info = $this->subAdmin_api->admin_assigned_user_detail($user_id);
                if($user_info)
                {
                    $res['check_type'] = $this->subAdmin_api->check_list();
                    $res['buss_info'] = $this->subAdmin_api->get_user_business($user_id);
                    $res['checklist'] = $this->subAdmin_api->get_user_check_list($user_id,$app_id);
                    //print_r($this->db->last_query());
                    $res['user_info'] = $user_info;
                    $res['alloted_checklist'] = $this->subAdmin_api->alloted_check_list($user_id,$app_id);
                    $res['response'] = '1';
                    $res['message'] = 'Users details'; 
                } 
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'No user assigned.';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid user selection.';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
     
    public function admin_checklist()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $checklist_id = $postdata->checklist_id;
            if(!empty($postdata->checklist_id))
            {
                $res['checklist'] = $this->subAdmin_api->get_check_list_type($checklist_id);
                $res['response'] = '1';
                $res['message'] = 'checklist.';
                $res['queType'] = '1 = radio, 2= text, 3 = image, 4 = video, 5 = remarks';
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid user selection.';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function user_application_verify_details()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->user_id) && (!empty(!empty($postdata->certificate_id))))
            {
                $res['check_type'] = $this->subAdmin_api->check_list();
                $res['user_info'] = $this->subAdmin_api->admin_assigned_user_detail($user_id);
                $res['buss_info'] = $this->subAdmin_api->get_user_business($user_id);
                $res['checklist'] = $this->subAdmin_api->get_user_check_list($user_id,$certificate_id);
                $res['response'] = '1';
                $res['message'] = 'Verify application details.';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid user or dapplication id';
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
 
    public function admin_app_dashboard()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $admin_id = $postdata->admin_id;
                $res['recieve'] = $this->subAdmin_api->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'2']);
                $res['verify'] = $this->subAdmin_api->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'3']);
                $res['issued'] = $this->subAdmin_api->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'5']);
                $res['reject'] = $this->subAdmin_api->get_application_count("option3",["subAdmin"=>$admin_id,"certficationStatus"=>'6']);
                $res['griv_resolve'] = '0';
                $res['response'] = '1';
                $res['message'] = 'Dashboard details';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}


    public function admin_verify_application_app()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id) && (!empty($postdata->certificate_id)) && (!empty($postdata->user_id)))
            {
                $fileDocs = $postdata->docFile;
                $docExt = $postdata->doc_ext;
                $resFile = base64_decode($fileDocs); 
                $dates = 'docs_'.date('YmdHis'); 
                $docPaths = 'uploads/document/'.$dates.'.'.$docExt;
                if($resFile != false) 
                {
                    $docuFile = $docPaths;
                    file_put_contents($docuFile,$resFile);
                } else {
                    $docuFile = '';
                }
                $vidDocs = $postdata->videoFile;
                $vidExt = $postdata->vid_ext;
                $vidFile = base64_decode($vidDocs); 
                $dates = 'video_'.date('YmdHis'); 
                $vidPaths = 'uploads/document/'.$dates.'.'.$vidExt;
                if($vidFile != false) 
                {
                    $fileVideo = $vidPaths;
                    file_put_contents($fileVideo,$vidFile);
                } else {
                    $fileVideo = '';
                }
                $question_id = $postdata->question_id;
                $verify_remarks = $postdata->verify_remarks;
                //$application_id = $postdata->certificate_id;
                //$user_id = $postdata->user_id;
                //$admin_id = $postdata->admin_id;
                if($question_id)
                {
                    foreach($question_id as $key=>$ques)
                    {
                        $queDetails = $this->db->query("SELECT queType,check_list_id FROM checklist_question_tbl WHERE q_id = '$ques'")->row();
                        $queType = $queDetails->queType;
                        if($queType == 1)
                        {
                            if($ques == '1')
                            {
                                $textAns = $postdata->process_checklist_1;
                            }
                            elseif($ques == '2')
                            {
                                $textAns = $postdata->process_checklist_2;
                            }
                            elseif($ques == '3')
                            {
                                $textAns = $postdata->process_checklist_3;
                            }
                            elseif($ques == '5')
                            {
                                $textAns = $postdata->process_checklist_5;
                            }
                            elseif($ques == '6')
                            {
                                $textAns = $postdata->process_checklist_6;
                            }
                            elseif($ques == '7')
                            {
                                $textAns = $postdata->process_checklist_7;
                            }
                            elseif($ques == '8')
                            {
                                $textAns = $postdata->process_checklist_8;
                            }
                            elseif($ques == '9')
                            {
                                $textAns = $postdata->process_checklist_9;
                            }
                            elseif($ques == '11')
                            {
                                $textAns = $postdata->process_checklist_11;
                            }
                            elseif($ques == '12')
                            {
                                $textAns = $postdata->process_checklist_12;
                            }
                            elseif($ques == '13')
                            {
                                $textAns = $postdata->process_checklist_13;
                            }
                            elseif($ques == '14')
                            {
                                $textAns = $postdata->process_checklist_14;
                            }
                            elseif($ques == '15')
                            {
                                $textAns = $postdata->process_checklist_15;
                            }
                            elseif($ques == '16')
                            {
                                $textAns = $postdata->process_checklist_16;
                            }
                            elseif($ques == '17')
                            {
                                $textAns = $postdata->process_checklist_17;
                            }
                            elseif($ques == '18')
                            {
                                $textAns = $postdata->process_checklist_18;
                            }
                            elseif($ques == '19')
                            {
                                $textAns = $postdata->process_checklist_19;
                            }
                            elseif($ques == '20')
                            {
                                $textAns = $postdata->process_checklist_20;
                            }
                            elseif($ques == '21')
                            {
                                $textAns = $postdata->process_checklist_21;
                            }
                            elseif($ques == '22')
                            {
                                $textAns = $postdata->process_checklist_22;
                            }
                            elseif($ques == '23')
                            {
                                $textAns = $postdata->process_checklist_23;
                            }
                        }
                        elseif($queType == 2)
                        {
                            if($ques == '4')
                            {
                                $textAns = $postdata->process_checklist_4;
                            }
                            elseif($ques == '10')
                            {
                                $textAns = $postdata->process_checklist_10;
                            }
                        }
                        elseif($queType == 3)
                        {
                            if($ques == '24')
                            {
                                $textAns = $docuFile;
                            }
                            elseif($ques == '27')
                            {
                                $textAns = $docuFile;
                            }
                        }
                        elseif($queType == 4)
                        {
                            if($ques == '25')
                            {
                                $textAns = $fileVideo;
                            }
                            elseif($ques == '28')
                            {
                                $textAns = $fileVideo;
                            }
                        }
                        elseif($queType == 5)
                        {
                            if($ques == '26')
                            {
                                $textAns = $verify_remarks;
                            }
                            elseif($ques == '29')
                            {
                                $textAns = $verify_remarks;
                            }
                        }

                        $verifyList = array(
                            'app_id' =>  $postdata->certificate_id,
                            'user_id' =>  $postdata->user_id,
                            'checklist_id' =>  $postdata->checklist_id,
                            'ques_id' =>  $ques,
                            'ques_ans' =>  $textAns,
                            'verify_at' =>  date('Y-m-d'),
                            'verify_by' => '2',
                            'verify_admin_id' => $postdata->admin_id
                        );
                        $this->subAdmin_api->insert_data('admin_verify_tbl',$verifyList);
                        //print_r($this->db->last_query());
                    }
                }
                if(!empty($docuFile))
                {
                    $fileArray = array(
                        'name' => 'Application Verify docs',
                        'file_name' => $docuFile,
                        'user_id' => $postdata->user_id,
                        'certficate_id' => $postdata->certificate_id,
                        'created_at' => date('Y-m-d h:i:s a'),
                        'usedFor'=>'certificate_verify'
                    );
                    $this->subAdmin_api->insert_data('documents',$fileArray);
                }
                if(!empty($fileVideo))
                {
                    $fileArray = array(
                        'name' => 'Application Verify video',
                        'file_name' => $fileVideo,
                        'user_id' => $postdata->user_id,
                        'certficate_id' => $postdata->certificate_id,
                        'created_at' => date('Y-m-d h:i:s a'),
                        'usedFor'=>'certificate_verify'
                    );
                    $this->subAdmin_api->insert_data('documents',$fileArray);
                }
                if(!empty($postdata->verify_remarks))
                {
                    $certDetal = $this->db->query("SELECT certificate_num,certficationStatus FROM option3 WHERE id = '$postdata->certificate_id'")->row_array();
                    $dataSts =  array(
                        'update_by' => '2',
                        'update_user_id' => $postdata->admin_id,
                        'statusManage' => $certDetal['certficationStatus'],
                        'statusType' => 'sub_admin_remark',
                        'statusRemark' => $postdata->verify_remarks,
                        'user_id' => $postdata->user_id,
                        'application_id' => $postdata->certificate_id,
                        'create_at' => date('Y-m-d h:i:s a'),
                        'application_num' => $certDetal['certificate_num'],
                    );
                    if($this->subAdmin_api->insert_data('status_manage_tbl',$dataSts))
                    {
                        $this->subAdmin_api->update_certificate_sts("option3",['certficationStatus'=>'3'],['id' => $postdata->certificate_id]);
                    }
                }

                $res['response'] = '1';
                $res['message'] = 'Application successfully verify';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid requests';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}

    public function admin_monthly_application_process()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $admin_id = $postdata->admin_id;
                $res['monthlyData'] = $this->subAdmin_api->get_monthly_application($postdata->admin_id,$postdata->month);
                $res['response'] = '1';
                $res['message'] = 'Dashboard monthly details';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_sector_wise_application()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $admin_id = $postdata->admin_id;
                $month = $postdata->month;
                $res['sectorData'] = $this->subAdmin_api->get_sector_wise_application($postdata->admin_id,$postdata->month);
                $res['response'] = '1';
                $res['message'] = 'Dashboard sector wise details';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function sector_wise_application()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $admin_id = $postdata->admin_id;
                $month = $postdata->month;
                $sector_list = ["Agri-Tech", "Agriculture", "Automobiles & EV", "BFSI (Banking, Financial Service & Insurance)", "Consumer-Tech", "Construction-Tech", "Data Science", "Deep-Tech (AI/ML/NLP)", "Edu-Tech", "E-Commerce", "Q-Commerce","FMCG", "Food Processing", "Health-Tech", "Space-Tech", "Logistics & Supply Chain", "Pharmaceuticals & API","Textiles & Handlooms", "Handicrafts", "Horticulture", "SaaS", "UAV/ Drones/ VTOL", "Others"];
                  
                
                $secCount = array();
                foreach($sector_list as $key=>$sector)
                {
                    $secCount[] = $this->db->query("SELECT COUNT(option3.sector) as totalSector FROM enterprise LEFT JOIN option3 ON enterprise.id = option3.enterprise_id WHERE option3.sector = '$sector' AND option3.subAdmin = '$admin_id' AND option3.certficationStatus = '5' AND enterprise.tbl_name ='option3'")->row_array()['totalSector'];
                    //print_r($this->db->last_query());
                }
                 
                $res['sector_list'] = $sector_list;
                $res['values_list'] = $secCount;
                $res['response'] = '1';
                $res['message'] = 'Dashboard sector wise details';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_application_status_track()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->user_id))
            {
                $res['sectorData'] = $this->subAdmin_api->get_application_sts($postdata->user_id,$postdata->certificate_id);
                $res['response'] = '1';
                $res['message'] = 'Application Status track manage';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_kyc_status_track()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->user_id))
            {
                $res['sectorData'] = $this->subAdmin_api->get_kyc_sts($postdata->user_id);
                $res['response'] = '1';
                $res['message'] = 'Application Status track manage';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_status_update_app()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->user_id))
            {
                $fileImg = $postdata->file;
                $file_ext = $postdata->file_ext;
                $adhar = base64_decode($fileImg); 
                $date = 'aadhar_file_'.date('YmdHis'); 
                $adhrPath = 'uploads/document/'.$date.'.'.$file_ext;
                if($adhar != false) {
                    $filePath = $adhrPath;
                    file_put_contents($aadharPath,$adhar);
                } else {
                    $filePath = '';
                }
                
                $user_id = $postdata->user_id;
                $certificate_status = $postdata->certificate_status;
                $cert_id = $postdata->cert_id;
                $remarks = $postdata->remarks;
                $certificate_num = $this->db->query("SELECT certificate_num FROM option3 WHERE id = '$cert_id'")->row_array()['certificate_num'] ;
                $dataSts =  array(
    				'update_by' => '2',
    				'update_user_id' => $postdata->admin_id,
    				'statusManage' => $postdata->certificate_status,
    				'statusType' => 'Application Verify',
    				'statusRemark' => $postdata->remarks,
    				'user_id' => $postdata->user_id,
    				'application_id' => $postdata->cert_id,
    				'create_at' => date('Y-m-d h:i:s a'),
    				'application_num' => $certificate_num,
    			);
    			if($this->subAdmin_api->insert_data('status_manage_tbl',$dataSts))
    			{

                    $user_info = $this->db->query("select name,phone from users where id = '$postdata->user_id'")->row();
                    if($postdata->certificate_status == 'Closed'){
                        $sms = "Dear $user_info->name, Your grievance with the ticket number$certificate_num is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                        $sendSms = get_sms($user_info->phone,$sms,'1507166418766838662');
                    }

                    if($postdata->certificate_status == 'Review'){
                        $sms = "Dear $user_info->name, Your grievance with the ticket number $certificate_num is progress. Please login into your dashboard for the comments from our executive. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                        $sendSms = get_sms($user_info->phone,$sms,'1507166418759787173');
                    }

    				$this->subAdmin_api->update_certificate_sts("option3",['certficationStatus'=>$certificate_status],['id' => $cert_id]);
    				$fileArray = array(
    					'name' => 'Application Schedule',
    					'file_name' => $filePath,
    					'user_id' => $user_id,
    					'certficate_id' => $cert_id,
    					'created_at' => date('Y-m-d h:i:s a'),
    					'usedFor'=>'certificate_verify'
    				);
    				$this->subAdmin_api->insert_data('documents',$fileArray);
    			}
                $res['response'] = '1';
                $res['message'] = 'Application Status updated';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
    public function admin_app_count_sector()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $res['sectorData'] = $this->subAdmin_api->sector_wise_data_count($postdata->admin_id,$postdata->month);
                //$res['sectorList'] = $this->subAdmin_api->sector_wise_app_list($postdata->admin_id,$postdata->month,$postdata->sector_name);
                //print_r($this->db->last_query());
                $res['response'] = '1';
                $res['message'] = 'Sector wise application data';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
	
    public function admin_app_count_district()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            if(!empty($postdata->admin_id))
            {
                $array = array();
                $district_name = $this->db->query("SELECT id,name from districts GROUP BY id")->result_array();//$this->subAdmin_api->district_wise_app_counts($postdata->admin_id,$postdata->month);
                foreach($district_name as $dist)
                {
                    $array[] = $dist['name'];
                }
                $res['district_name'] = $array;

                $arraCount = array();
                $district_vale = $this->db->query("SELECT id,name from districts GROUP BY id")->result_array();//$this->subAdmin_api->district_wise_app_value_counts($postdata->admin_id,$postdata->month);
                foreach($district_vale as $val)
                {
                    //$arraCount[] = $val['totCount'];
                    $arraCount[] = $this->db->query("SELECT COUNT(users.district) as district, enterprise.user_id FROM enterprise LEFT JOIN option3 ON option3.enterprise_id = enterprise.id LEFT JOIN users ON enterprise.user_id = users.id WHERE users.district  = '".$val['id']."' AND option3.certficationStatus = '5' AND subAdmin = '$postdata->admin_id' AND enterprise.tbl_name ='option3'")->row_array()['district'];
                }
                $res['district_vale'] = $arraCount;
                $res['response'] = '1';
                $res['message'] = 'District wise application data';  
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid id';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
	
	public function admin_verify_answer_datas()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $admin_id = $postdata->admin_id;
            $user_id = $postdata->user_id;
            $app_id = $postdata->certificate_id;
            if(!empty($postdata->user_id))
            {
                $res['checklist'] = $this->subAdmin_api->get_verify_check_list($user_id,$app_id,$admin_id);
                $res['buss_info'] = $this->subAdmin_api->get_user_business($user_id);
                //print_r($this->db->last_query());
                $res['response'] = '1';
                $res['message'] = 'Verify details'; 
                $res['queType'] = '1 = radio, 2= text, 3 = image, 4 = video, 5 = remarks'; 
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Certificate not approve by the admin.';
            } 
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters.';
		}
        echo json_encode($res);
	}
	
 
    

 
}