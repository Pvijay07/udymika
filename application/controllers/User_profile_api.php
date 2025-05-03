<?php
require APPPATH . '/libraries/REST_Controller.php';
class User_profile_api extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('admin/User_model', 'user_model');
        $this->load->model('Crud_model', 'crud_model'); 
    }

    
    public function user_profile_details()
    {
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->user_id, 'invalid id', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {   
                $result =  $this->crud_model->select_row("users", ["id" => $postdata->user_id]);
                if($result)
                {
                    $res['profile'] = $result;
                    $res['pancard'] = base_url().$result->pan_file;
                    $res['aadharcard'] = base_url().$result->adhaar_file;
                    $res['district'] = $this->crud_model->select_all("districts", "name ASC");
                    $res['category'] = array("OC","OBC","BC-A/B/C/D","SC","ST","Prefer not to Say");
                    $res['education'] = array("Post-Graduation &amp; Above","Graduation","Intermediate / 12th pass","Matriculation/10th pass","10th &amp; Below","No Schooling");
                    $res['employee'] = array("Part-time Employee","Seasonal Employee","Full time Employee","I am an Entrepreneur/ Business Woman","Unemployed","Others");
                    $res['institution'] = array("SHG, SERP","SHG, MEPMA","Incubation Centres","Others");
                    $res['response'] = '1';
                    $res['message'] = 'profile details.';
                    $res['applStatus'] = $this->db->query("SELECT statusManage,statusType,statusRemark FROM status_manage_tbl WHERE user_id = '$postdata->user_id'")->result_array();
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to access profile.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Invalid parameters enter valid details.';
		}
        echo json_encode($res);
    }
    public function get_mandal_list()
    {
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->district_id, 'district', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {   
                $result =  $this->db->query("select * from mandals where district_id = $postdata->district_id")->result_array();
                if($result)
                {
                    $res['profile'] = $result;
                    $res['response'] = '1';
                    $res['message'] = 'Manadal list.';
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to mandal list.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Select destrict.';
		}
        echo json_encode($res);
    }
    public function get_gram_panchayat_list()
    {
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $this->form_validation->set_rules($postdata->mandal_id, 'mandal', 'trim|required');
            if ($this->form_validation->run()) 
            {
                $data = array(
                    'errors' => validation_errors()
                );
                $res['response'] = '0';
                $res['message'] = 'All fields are requireds.';
            }
            else 
            {   
                $result =  $this->db->query("select * from villages where mandal_id = $postdata->mandal_id")->result_array();
                if($result)
                {
                    $res['profile'] = $result;
                    $res['response'] = '1';
                    $res['message'] = 'gram panchayat list.';
                }
                else
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to gram panchayat list.';
                }
            }
		} 
        else 
        {
            $res['response'] = '0';
            $res['message'] = 'Select mandal.';
		}
        echo json_encode($res);
    }
    public function get_district_list()
    {    
        $district = $this->crud_model->select_all("districts", "name ASC"); 
        if($district)
        {
            $res['district'] = $district;
            $res['response'] = '1';
            $res['message'] = 'district list.';
        }
        else
        {
            $res['response'] = '0';
            $res['message'] = 'district not found.';
        }
        echo json_encode($res);
    }

    public function update_kyc(){
        
        $postdata = json_decode( file_get_contents('php://input') );
		if($postdata){
			$user_id = $postdata->user_id;
			$name = $postdata->name;
			$name = $postdata->email;
			$name = $postdata->phone;
			$this->form_validation->set_rules($postdata->name, 'Name', 'trim|required');
			$this->form_validation->set_rules($postdata->email, 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules($postdata->phone, 'Mobile No.', 'trim|required');
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
                $adharImg = $postdata->adhaar_file;
                $adhaar_ext = $postdata->adhaar_ext;
                $adhar = base64_decode($adharImg); 
                $date = 'aadhar_file_'.date('YmdHis'); 
                $adhrPath = 'uploads/document/'.$date.'.'.$adhaar_ext;
                if($adhar != false) 
                {
                    $aadharPath = $adhrPath;
                    file_put_contents($aadharPath,$adhar);
                }
                else
                {
                    $aadharPath = '';
                }
                
                $panImg = $postdata->pan_file;
                $pan_ext = $postdata->pan_ext;
                $pan = base64_decode($panImg); 
                $dates = 'pan_file_'.date('YmdHis'); 
                $panPaths = 'uploads/document/'.$dates.'.'.$pan_ext;

                
                if($pan != false) 
                {
                    $panPath = $panPaths;
                    file_put_contents($panPaths,$pan);
                }
                else
                {
                    $panPath = '';
                }

				$data = array(
					'name' => $postdata->name,
					'email' => $postdata->email,
					'phone' => $postdata->phone,
					'dob' => $postdata->dob,
					'category' => $postdata->category,
					'district' => $postdata->district,
					'mandal' => $postdata->mandal,
					'village' => $postdata->village,
					'adhaar_no' => $postdata->aadhar_no,
					'adhaar_file' => $aadharPath?$aadharPath:'',
					'pan_no' => $postdata->pan_no,
					'pan_file' => $panPath?$panPath:'',
					'education' => $postdata->education,
					'employment' => $postdata->employment,
					'institution' => $postdata->institution,
					'pwd' => $postdata->pwd,
					'updated_at' => date("Y-m-d H:i:s"),
					'status' => "2"
				);
				$data = $this->security->xss_clean($data);
				$result = $this->crud_model->update('users', $data, ["id" => $user_id]);
				if($result)
                {
                    $res['response'] = '1';
                    $res['message'] = 'Your KYC has been completed successfully!';
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

    public function enterprise_have_an_idea()
    {
        $postdata = json_decode( file_get_contents('php://input') );
		if($postdata)
        {
			$user_id = $postdata->user_id;
            $dpr_docs = $postdata->dpr_file;
            $file_ext = $postdata->file_ext;
            $drpFile = base64_decode($dpr_docs); 
            $dates = 'dpr_file_'.date('YmdHis'); 
            $drpPaths = 'uploads/enterprise/'.$dates.'.'.$file_ext;
            if($drpFile != false) 
            {
                $drpPath = $drpPaths;
                file_put_contents($drpPath,$drpFile);
            }
            else
            {
                $drpPath = '';
            }

            $data = array(
                "user_id" => $user_id,
                "tbl_name" => "option2",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
                "appType" => '1'
            );
            $insert = $this->crud_model->insert("enterprise", $data);
            if($insert)
            {
                $data1 = array(
                    "enterprise_id" => $insert,
                    "business" => $postdata->business,
                    "sector" => $postdata->sector,
                    "category" => $postdata->category,
                    "category_other" => $postdata->category_other,
                    "support" => $postdata->support,
                    "support_other" => $postdata->support_other,
                    "dpr" => $postdata->dpr,
                    "drp_file" => $drpPath
                );
                if($this->crud_model->insert("option2", $data1))
                {
                    $this->crud_model->update('users', ['status' => "3"], ["id" => $user_id]);
                    $res['response'] = '1';
                    $res['message'] = 'Data updated successfully!';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Failed to update.';
            }
        }
        else
        {
            $res['response'] = '0';
            $res['message'] = 'Enter valid details.';
        }
        echo json_encode($res);
    }


    public function enterprise_develop_an_idea()
    {
        $postdata = json_decode( file_get_contents('php://input') );
		if($postdata)
        {
            $usrDetails = $this->crud_model->select_row("users", ["id" => $postdata->user_id]);
			$user_id = $postdata->user_id;
            $dpr_docs = $postdata->resume;
            $file_ext = $postdata->file_ext;
            $resFile = base64_decode($dpr_docs); 
            $dates = 'res_file_'.date('YmdHis'); 
            $resPaths = 'uploads/enterprise/'.$dates.'.'.$file_ext;
            if($resFile != false) 
            {
                $resumes = $resPaths;
                file_put_contents($resumes,$resFile);
            }
            else
            {
                $resumes = '';
            }

            $data = array(
                "user_id" => $user_id,
                "tbl_name" => "option1",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
                "appType" => '1'
            );
            $insert = $this->crud_model->insert("enterprise", $data);
            if($insert)
            {
                $data1 = array(
                    "enterprise_id" => $insert,
                    "we_hub" => $postdata->we_hub,
                    "is_resume" => $postdata->is_resume,
                    "resume" => $resumes,
                    "training" => $postdata->training,
                    "training_other" => $postdata->training_other
                );
                if($this->crud_model->insert("option1", $data1))
                {
                    $sms = "Dear $usrDetails->name, Application is FirstPart complete. Please fill your enterprise information and apply for Certificate In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
                    $sendSms = get_sms($postdata->phone,$sms,'1507166418691781576');

                    $this->crud_model->update('users', ['status' => "3"], ["id" => $user_id]);
                    $res['response'] = '1';
                    $res['message'] = 'Data updated successfully!';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Failed to update.';
            }
        }
        else
        {
            $res['response'] = '0';
            $res['message'] = 'Enter valid details.';
        }
        echo json_encode($res);
    }
    public function enterprise_have_existing_business()
    {
        $postdata = json_decode( file_get_contents('php://input') );
		if($postdata)
        {
			$user_id = $postdata->user_id;
            $usrDetails = $this->crud_model->select_row("users", ["id" => $postdata->user_id]);
            $soloFile = $postdata->solo_file;
            $soloFileExt = $postdata->solo_file_ext;
            $slFile = base64_decode($soloFile); 
            $dates = 'solo_file_'.date('YmdHis'); 
            $soloPath = 'uploads/enterprise/'.$dates.'.'.$soloFileExt;
            if($slFile != false) {
                $solo_file = $soloPath;
                file_put_contents($solo_file,$slFile);
            }
            else {
                $solo_file = '';
            }


            $partnershipFile = $postdata->partnership_file;
            $partnershipFileExt = $postdata->partnership_file_ext;
            $psFile = base64_decode($partnershipFile); 
            $dates = 'part_file_'.date('YmdHis'); 
            $psPath = 'uploads/enterprise/'.$dates.'.'.$partnershipFileExt;
            if($psFile != false) {
                $partnership_file = $psPath;
                file_put_contents($partnership_file,$psFile);
            }
            else {
                $partnership_file = '';
            }


            $companyFile = $postdata->company_file;
            $companyFileExt = $postdata->company_file_ext;
            $compFile = base64_decode($companyFile); 
            $dates = 'comp_file_'.date('YmdHis'); 
            $compPath = 'uploads/enterprise/'.$dates.'.'.$companyFileExt;
            if($compFile != false) {
                $company_file = $compPath;
                file_put_contents($company_file,$compFile);
            }
            else {
                $company_file = '';
            }

            $pvtFile = $postdata->pvt_file;
            $pvtFileExt = $postdata->pvt_file_ext;
            $pvFile = base64_decode($pvtFile); 
            $dates = 'pvt_file_'.date('YmdHis'); 
            $pvtPath = 'uploads/enterprise/'.$dates.'.'.$pvtFileExt;
            if($pvFile != false) {
                $pvt_file = $pvtPath;
                file_put_contents($pvt_file,$pvFile);
            }
            else {
                $pvt_file = '';
            }

            $llpFile = $postdata->llp_file;
            $llpFileExt = $postdata->llp_file_ext;
            $lpFile = base64_decode($llpFile); 
            $dates = 'llp_file_'.date('YmdHis'); 
            $llpPath = 'uploads/enterprise/'.$dates.'.'.$llpFileExt;
            if($lpFile != false) {
                $llp_file = $llpPath;
                file_put_contents($llp_file,$lpFile);
            }
            else {
                $llp_file = '';
            }

            $udyamFile = $postdata->udyam_file;
            $udyamFileExt = $postdata->udyam_file_ext;
            $udyFile = base64_decode($udyamFile); 
            $dates = 'udyam_file_'.date('YmdHis'); 
            $udyPath = 'uploads/enterprise/'.$dates.'.'.$udyamFileExt;
            if($udyFile != false) {
                $udyam_file = $udyPath;
                file_put_contents($udyam_file,$udyFile);
            }
            else {
                $udyam_file = '';
            }


            $gstFile = $postdata->gst_file;
            $gstFileExt = $postdata->gst_file_ext;
            $gtFile = base64_decode($gstFile); 
            $dates = 'gst_file_'.date('YmdHis'); 
            $gstPath = 'uploads/enterprise/'.$dates.'.'.$gstFileExt;
            if($gtFile != false) {
                $gst_file = $gstPath;
                file_put_contents($gst_file,$gtFile);
            }
            else {
                $gst_file = '';
            }

            $pnFiles = $postdata->pan_file;
            $pnFilesExt = $postdata->pan_file_ext;
            $panFile = base64_decode($pnFiles); 
            $dates = 'pan_file_'.date('YmdHis'); 
            $panPath = 'uploads/enterprise/'.$dates.'.'.$pnFilesExt;
            if($panFile != false) {
                $pan_file = $panPath;
                file_put_contents($pan_file,$panFile);
            }
            else {
                $pan_file = '';
            }


            $auditedFile = $postdata->audited_file;
            $auditedFileExt = $postdata->audited_file_ext;
            $auditFile = base64_decode($auditedFile); 
            $dates = 'audit_file_'.date('YmdHis'); 
            $auditPath = 'uploads/enterprise/'.$dates.'.'.$auditedFileExt;
            if($auditFile != false) {
                $audited_file = $auditPath;
                file_put_contents($audited_file,$auditFile);
            }
            else {
                $audited_file = '';
            }


            $dpitFile = $postdata->dpit_file;
            $dpitFileExt = $postdata->dpit_file_ext;
            $dpttFile = base64_decode($dpitFile); 
            $dates = 'dpit_file_'.date('YmdHis'); 
            $dpitPath = 'uploads/enterprise/'.$dates.'.'.$dpitFileExt;
            if($dpttFile != false) {
                $dpit_file = $dpitPath;
                file_put_contents($dpit_file,$dpttFile);
            }
            else {
                $dpit_file = '';
            }
            

            $data = array(
                "user_id" => $user_id,
                "tbl_name" => "option3",
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
                "appType" => '1'
            );
            $insert = $this->crud_model->insert("enterprise", $data);
            if($insert)
            {
                $app_num = 'UDY'.rand('1000000','9999999');
                $data1 = array(
                    "enterprise_id" => $insert,
                    "business" => $postdata->idea,
                    "sector" => $postdata->sector2,
                    "business_operation" => $postdata->operation,
                    "category" => $postdata->fit,
                    "category_text" => $postdata->fit_other,
                    "working_capital" => $postdata->investment,
                    "investment_type" => $postdata->investment_type,
                    "monthly_revenue" => $postdata->revenue,
                    "annual_turnover" => $postdata->turnover,
                    "employee" => $postdata->empcount,
                    "no_emp" => $postdata->no_emp,
                    "business_register" => $postdata->regvrfy,
                    "legal_status" => $postdata->legal_status,
                    "solo_file" => $solo_file,
                    "partnership_file" => $partnership_file,
                    "company_file" => $company_file,
                    "pvt_file" => $pvt_file,
                    "llp_file" => $llp_file,
                    "dpiit" => $postdata->dpit,
                    "dpiit_file" => $dpit_file,
                    "udyam" => $postdata->udyam,
                    "udyam_file" => $udyam_file,
                    "ext_investment" => $postdata->ext_investment,
                    "gst_file" => $gst_file,
                    "pan_file" => $pan_file,
                    "audited_file" => $audited_file,
                    "enterprise" => $postdata->enterprise,
                    "kind_support" => $postdata->support_kind,
                    "certificate_num" => $app_num,
                    "applyMonth"=>date('Y-m'),
                    "applyDate"=>date('Y-m-d h:i:s a'),
                    "updateTime"=>date('Y-m-d h:i:s a')
                );
                if($this->crud_model->insert("option3", $data1))
                {
                    $sms = "Dear $usrDetails->name, Your Enterprise Application is successfully submitted for Certification. We will review and update you on the status here shortly. You can also view it on your dashboard, Login: www.udyamika.telangana.gov.in WEHUB";
                    $sendSms = get_sms($postdata->phone,$sms,'1507166418714661685');
                    $this->crud_model->update('users', ['status' => "3"], ["id" => $user_id]);
                    $res['response'] = '1';
                    $res['message'] = 'Data updated successfully!';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Failed to update.';
            }
        }
        else
        {
            $res['response'] = '0';
            $res['message'] = 'Enter valid details.';
        }
        echo json_encode($res);
    }

    public function user_profile_pic_update()
	{
        $postdata = json_decode( file_get_contents('php://input') ); 
        if(!empty($postdata))
        {
            $user_id = $postdata->user_id;
            if(!empty($postdata->user_id))
            {
                $pictures = $postdata->picture;
                $pic_ext = $postdata->pic_ext;
                $resFile = base64_decode($pictures); 
                $dates = 'profile_'.date('YmdHis'); 
                $resPaths = 'uploads/profile/'.$dates.'.'.$pic_ext;
                if($resFile != false) 
                {
                    $picPfl = $resPaths;
                    file_put_contents($picPfl,$resFile);
                } else {
                    $picPfl = '';
                }

                $user_info = $this->crud_model->update("users", ['userPic' => $picPfl], ["id" => $postdata->user_id]);
                if($user_info)
                {
                    $res['datas'] = $this->crud_model->select_row("users", ["id" => $postdata->user_id]);
                    $res['response'] = '1';
                    $res['message'] = 'Profile picture updatedsuccessfully'; 
                    $res['picUrl'] = base_url(); 
                } 
                else 
                {
                    $res['response'] = '0';
                    $res['message'] = 'Failed to update profile.';
                }
            }
            else
            {
                $res['response'] = '0';
                $res['message'] = 'Invalid selection.';
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