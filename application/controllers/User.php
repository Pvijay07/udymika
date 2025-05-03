<?php defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		user_auth();
		$this->load->model('crud_model', 'crud_model');
		$this->load->model('lvl_model', 'lvl_model');
		$this->load->helper('text');
	}


	public function index()
	{

		$data['title'] = 'KYC Form';
		$data["disticts"] = $this->crud_model->select_all("districts", "name ASC");
		// var_dump($data['open']);
		$data["user_info"] = $this->crud_model->select_row("users", ["id" => $this->session->userdata("user_id")]);
		$this->load->view('kyc-form', $data);
	}


	public function dashboard()
	{

		$user_id = $this->session->userdata("user_id");
		$data['title'] = 'Dashboard';
		//$data["disticts"] = $this->crud_model->select_all("districts");
		$data["grievance_raised"] = $this->crud_model->get_count("grievance", ["user_id" => $this->session->userdata("user_id"), "user_type" => "User"]);
		$data["grievance_review"] = $this->crud_model->get_count("grievance", ["user_id" => $this->session->userdata("user_id"), "user_type" => "User", "status" => "Review"]);
		$data["grievance_close"] = $this->crud_model->get_count("grievance", ["user_id" => $this->session->userdata("user_id"), "user_type" => "User", "status" => "Closed"]);
		$data["user_info"] = $this->crud_model->select_row("users", ["id" => $this->session->userdata("user_id")]);
		$data["app_info"]  = $this->db->query("SELECT certificate_num,certficationStatus FROM option3 LEFT JOIN enterprise ON option3.enterprise_id = enterprise.id WHERE user_id = '$user_id'")->row_array();
		$this->load->view('user-dashboard', $data);
	}




	public function kyc()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->session->userdata("user_id");
			// if ($this->input->post('submit')) {
				$this->form_validation->set_rules('name', 'Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
				$this->form_validation->set_rules('phone', 'Mobile No.', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data = array(
						'errors' => validation_errors()
					);
					$this->session->set_flashdata('errors', $data['errors']);
					redirect(base_url("user"), 'refresh');
				} else {

					if (!empty($_FILES['aadhar_card']['name'])) {
						$aadhar_card = upload_file('aadhar_card', 'document/' . date('d-m-Y'));
					} else {
						$aadhar_card = $this->input->post('old_aadhar');
					}


					if (!empty($_FILES['pan_card']['name'])) {
						$pan_card = upload_file('pan_card', 'document/' . date('d-m-Y'));
					} else {
						$pan_card = $this->input->post('old_pan');
					}
					$data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post("email"),
						'phone' => $this->input->post("phone"),
						'dob' => $this->input->post("dob"),
						'category' => $this->input->post("category"),
						'district' => $this->input->post("district"),
						'mandal' => $this->input->post("mandal"),
						'village' => $this->input->post("gram_panchayath"),
						'adhaar_no' => $this->input->post("aadhar_no"),
						'adhaar_file' => $aadhar_card,
						'pan_no' => $this->input->post("pan_no"),
						'pan_file' => $pan_card,
						'education' => $this->input->post("education"),
						'employment' => $this->input->post("employment"),
						'institution' => $this->input->post("institution"),
						'pwd' => $this->input->post("pwd"),
						'updated_at' => date("Y-m-d H:i:s"),
						'status' => "2",
						'dataType' => "1",
						'otherInstitute' => $this->input->post("otherInstitutes")
					);


					$data = $this->security->xss_clean($data);
					$result = $this->crud_model->update('users', $data, ["id" => $id]);

					if ($result) {
						$sendDate = date("Y-m-d");
						$sendTime = date("H:i:s");
						$userName = $this->input->post('name');
						$sms = "Dear $userName, Your KYC is successfully saved on Date-$sendDate at $sendTime WEHUB";
						$sendSms = get_sms($phone, $sms, '1507166418666482368');

						$sms1 = "Dear $userName, Your KYC is successfully submitted. We will review and update you on the status shortly. You can also view it on your dashboard WEHUB";
						get_sms($phone, $sms1, '1507166418671476208');

						$this->session->unset_userdata('user_name');
						$this->session->set_userdata('user_name', $this->input->post('name'));

						$response['success'] = true;
						$response['message'] = 'KYC data has been successfully processed.';
					} else {
						$response['success'] = false;
						$response['message'] = 'Error processing KYC data.';
					}
				}
			// }
		}
		if ($this->input->post('draft')) {

			$id = $this->session->userdata("user_id");

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('phone', 'Mobile No.', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url("user"), 'refresh');
			} else {
				if (!empty($_FILES['aadhar_card']['name'])) {
					$aadhar_card = upload_file('aadhar_card', 'document/' . date('d-m-Y'));
				} else {
					$aadhar_card = '';
				}


				if (!empty($_FILES['pan_card']['name'])) {
					$pan_card = upload_file('pan_card', 'document/' . date('d-m-Y'));
				} else {
					$pan_card = '';
				}

				$data = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post("email"),
					'phone' => $this->input->post("phone"),
					'dob' => $this->input->post("dob"),
					'category' => $this->input->post("category"),
					'district' => $this->input->post("district"),
					'mandal' => $this->input->post("mandal"),
					'village' => $this->input->post("gram_panchayath"),
					'adhaar_no' => $this->input->post("aadhar_no"),
					'adhaar_file' => $aadhar_card,
					'pan_no' => $this->input->post("pan_no"),
					'pan_file' => $pan_card,
					'education' => $this->input->post("education"),
					'employment' => $this->input->post("employment"),
					'institution' => $this->input->post("institution"),
					'pwd' => $this->input->post("pwd"),
					'updated_at' => date("Y-m-d H:i:s"),
					'status' => "1",
					'dataType' => "0",
					'otherInstitute' => $this->input->post("otherInstitutes")
				);


				$data = $this->security->xss_clean($data);
				$result = $this->crud_model->update('users', $data, ["id" => $id]);

				if ($result) {
					$this->session->unset_userdata('user_name');
					$this->session->set_userdata('user_name', $this->input->post('name'));
					$response['success'] = true;
					$response['message'] = 'KYC draft data has been successfully processed.';
				} else {
					$response['success'] = false;
					$response['message'] = 'Error processing KYC data.';
				}
			}
		}
		echo json_encode($response);
	}

	public function success()
	{
		$data['title'] = 'KYC Completed Successfully | Udyamika';
		$this->load->view('kyc-success', $data);
	}

	public function grievance()
	{
		$data['title'] = 'Grievance - Udyamika';
		if (!empty($this->input->get('filterBy'))) {
			$this->input->get('filterBy');
			$cond["user_id"] = $this->session->userdata("user_id");
			$cond["user_type"] = "User";
			$cond["query_type"] = $this->input->get('filterBy');
		} else {
			$cond["user_id"] = $this->session->userdata("user_id");
			$cond["user_type"] = "User";
		}
		$data["grievanaces"] = $this->crud_model->select("grievance", $cond, "id DESC");
		//print_r($this->db->last_query());
		$this->load->view('user-grievence', $data);
	}



	public function upload()
	{
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('document_name', 'Document Name', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				echo "no";
				exit;
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url("user/dashboard"), 'refresh');
			} else {

				if (!empty($_FILES['document']['name'])) {
					$path = upload_file('document', 'document/' . date('d-m-Y'));
				} else {
					$path = '';
				}
				$user_id = $this->session->userdata("user_id");
				$cert_id  = $this->db->query("SELECT enterprise_id,option3.id FROM option3 LEFT JOIN enterprise ON option3.enterprise_id = enterprise.id WHERE user_id = '$user_id' and (certficationStatus != '5' or certficationStatus != '6' or certficationStatus != '7')")->row_array();
				$data = array(
					"name" => $this->input->post("document_name"),
					"file_name" => $path,
					"user_id" => $this->session->userdata("user_id"),
					"certficate_id" => $cert_id['id'],
					"created_at" => date("Y-m-d H:i:s")
				);

				$insert = $this->crud_model->insert("documents", $data);
				//print_r($this->db->last_query());
				if ($insert) {
					$this->session->set_flashdata('success', 'Your Document Uploaded Successfully.');
					redirect(base_url('user/documents'));
				} else {
					$this->session->set_flashdata('fail', 'There was Problem');
					redirect(base_url('user/documents'));
				}
			}
		}
	}


	public function profile_picture_updates()
{
    if ($this->input->post('submit')) {
        if (!empty($_FILES['profilePic']['name'])) {
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $file_extension = pathinfo($_FILES['profilePic']['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                $this->session->set_flashdata('fail', 'Invalid file format. Only JPG, JPEG, PNG files are allowed.');
                redirect(base_url('user/'));
            }

            $max_file_size = 5 * 1024 * 1024;
            $file_size = $_FILES['profilePic']['size'];

            if ($file_size > $max_file_size) {
                $this->session->set_flashdata('fail', 'File size exceeds the limit. Maximum file size allowed is 5 MB.');
                redirect(base_url('user/'));
            }

            $path = upload_file('profilePic', 'profile/' . date('d-m-Y'));

            $user_id = $this->session->userdata("user_id");
            $data = array("userPic" => $path, "updated_at" => date("Y-m-d H:i:s"));

            $insert = $this->crud_model->update("users", $data, ['id' => $user_id]);

            if ($insert) {
                $this->session->set_flashdata('success', 'Your Profile picture Uploaded Successfully.');
                redirect(base_url('user/'));
            } else {
                $this->session->set_flashdata('fail', 'Failed to update, please try again.');
                redirect(base_url('user/profile_picture'));
            }
        } else {
            $this->session->set_flashdata('fail', 'Please upload a profile picture.');
            redirect(base_url('user/profile_picture'));
        }
    }
}

	

	public function enterprise()
	{

		$id = $this->session->userdata("user_id");
		$user_info = $this->crud_model->select_row('users', ['id' => $id]);
		if ($this->input->post('submit')) {

			$this->form_validation->set_rules('tab', 'Identify ', 'trim|required');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url("user/enterprise"), 'refresh');
			} else {

				$option3_count = $this->crud_model->check_duplicate("enterprise", ["user_id" => $id, "tbl_name" => "option3"]);
				if ($option3_count != 0) {

					$check = $this->crud_model->select_row("enterprise", ["user_id" => $id, "tbl_name" => "option3"]);
					$this->crud_model->delete("option3", ["enterprise_id" => $check->id]);
					$this->crud_model->delete("enterprise", ["id" => $check->id]);
				}

				$identity = $this->input->post("tab");

				if ($identity == "I want to develop an idea/start a business") {

					$tbl_name = "option1";

					$any_option = $this->input->post("any_option");

					$we_hub = $this->input->post("we_hub");

					$is_resume = $this->input->post("is_resume");

					if (!empty($_FILES['resume']['name'])) {
						$resume = upload_file('resume', 'enterprise/' . date('d-m-Y'));
					} else {
						$resume = '';
					}



					$training_other = $this->input->post("training_other");
					$training = $this->input->post("training");
				} elseif ($identity == "I have an idea and I have to start") {

					$tbl_name = "option2";

					if (!empty($_FILES['dpr_file']['name'])) {
						$resume = upload_file('dpr_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$resume = '';
					}

					if (!empty($_FILES['dpr_file']['name'])) {
						$dpr_file = upload_file('dpr_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$dpr_file = '';
					}
				} elseif ($identity == "I have an existing business") {

					$tbl_name = "option3";

					if (!empty($_FILES['solo_file']['name'])) {
						$solo_file = upload_file('solo_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$solo_file = $this->input->post("solo_hdn_file");
					}

					if (!empty($_FILES['partnership_file']['name'])) {
						$partnership_file = upload_file('partnership_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$partnership_file = $this->input->post("partnership_hdn_file");
					}

					if (!empty($_FILES['company_file']['name'])) {
						$company_file = upload_file('company_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$company_file = $this->input->post("company_hdn_file");
					}
					if (!empty($_FILES['pvt_file']['name'])) {
						$pvt_file = upload_file('pvt_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$pvt_file = $this->input->post("pvt_hdn_file");
					}

					if (!empty($_FILES['llp_file']['name'])) {
						$llp_file = upload_file('llp_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$llp_file = $this->input->post("llp_hdn_file");
					}

					if (!empty($_FILES['dpit_file']['name'])) {
						$llp_file = upload_file('dpit_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$llp_file = $this->input->post("dpit_hdn_file");
					}

					if (!empty($_FILES['udyam_file']['name'])) {
						$udyam_file = upload_file('udyam_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$udyam_file = $this->input->post("udyam_hdn_file");
					}
					if (!empty($_FILES['gst_file']['name'])) {
						$gst_file = upload_file('gst_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$gst_file = $this->input->post("gst_hdn_file");
					}

					if (!empty($_FILES['pan_file']['name'])) {
						$pan_file = upload_file('pan_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$pan_file = '';
					}

					if (!empty($_FILES['audited_file']['name'])) {
						$audited_file = upload_file('audited_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$audited_file = $this->input->post("audited_hdn_file");
					}
				}

				$data = array(
					"user_id" => $id,
					"tbl_name" => $tbl_name,
					"created_at" => date("Y-m-d H:i:s"),
					"updated_at" => date("Y-m-d H:i:s"),
					"appType" => '1'
				);
				if (!$this->crud_model->check_data_exist("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name])) {
					$insert = $this->crud_model->insert("enterprise", $data);
				} else {
					$this->crud_model->update_row_data("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name], ["updated_at" => date("Y-m-d H:i:s"), "appType" => '1']);
					$insert = $this->crud_model->get_single_data_object("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name], 'id');
				}


				if ($tbl_name == "option1") {

					$data1 = array(
						"enterprise_id" => $insert,
						"we_hub" => $we_hub,
						"is_resume" => $is_resume,
						"resume" => $resume,
						"training" => $training,
						"training_other" => $training_other
					);
					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$this->crud_model->insert($tbl_name, $data1);
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}
				} else if ($tbl_name == "option2") {

					$data1 = array(
						"enterprise_id" => $insert,
						"business" => $this->input->post("business"),
						"sector" => $this->input->post("sector"),
						"category" => $this->input->post("category"),
						"category_other" => $this->input->post("category_other"),
						"support" => '',
						"support_other" => $this->input->post("support_other"),
						"dpr" => $this->input->post("dpr"),
						"drp_file" => $dpr_file
					);
					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$this->crud_model->insert($tbl_name, $data1);
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}

					$supportOptTwo = $this->input->post('supportOptTwo');
					if (!empty(count($supportOptTwo) > 0)) {
						foreach ($supportOptTwo as $spt) {
							$supOtrTwo['cert_id'] = $insert;
							$supOtrTwo['supportName'] = $spt;
							$supOtrTwo['updateAt'] = date('Y-m-d h:i:s A');
							if ($this->crud_model->check_data_exist('support_option_two', ['cert_id' => $insert, 'supportName' => $spt])) {
								$this->crud_model->delete('support_option_two', ['cert_id' => $insert]);
							} else {
								$this->crud_model->insert('support_option_two', $supOtrTwo);
							}
						}
					}
				} else if ($tbl_name == "option3") {

					$app_num = 'UDY' . rand('1000000', '9999999');
					$data1 = array(
						"enterprise_id" => $insert,
						"business" => $this->input->post("idea"),
						"sector" => $this->input->post("sector2"),
						"business_operation" => $this->input->post("operation"),
						"category" => $this->input->post("fit"),
						"category_text" => $this->input->post("fit_other"),
						"working_capital" => $this->input->post("investment"),
						"investment_type" => '',
						"monthly_revenue" => $this->input->post("revenue"),
						"annual_turnover" => $this->input->post("turnover"),
						"employee" => $this->input->post("empcount"),
						"no_emp" => $this->input->post("no_emp"),
						"business_register" => $this->input->post("regvrfy"),
						"legal_status" => $this->input->post("legal_status"),
						"solo_file" => $solo_file,
						"partnership_file" => $partnership_file,
						"company_file" => $company_file,
						"pvt_file" => $pvt_file,
						"llp_file" => $llp_file,
						"dpiit" => $this->input->post("dpit"),
						"dpiit_file" => $dpit_file,
						"udyam" => $this->input->post("udyam"),
						"udyam_file" => $udyam_file,
						"ext_investment" => $this->input->post("ext_investment"),
						"gst_file" => $gst_file,
						"pan_file" => $pan_file,
						"audited_file" => $audited_file,
						"enterprise" => $this->input->post("enterprise"),
						"kind_support" => '',
						"certificate_num" => $app_num,
						"applyMonth" => date('Y-m'),
						"applyDate" => date('Y-m-d h:i:s a'),
						"updateTime" => date('Y-m-d h:i:s a'),
						"investment_typeOther" => $this->input->post("invTypeOther")
					);

					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$dataSave = $this->crud_model->insert($tbl_name, $data1);

						$investment_type = $this->input->post('investment_type');
						if (!empty(count($investment_type) > 0)) {
							foreach ($investment_type as $team) {
								$invType['cert_id'] = $dataSave;
								$invType['cert_num'] = $app_num;
								$invType['investName'] = $team;
								$invType['createAt'] = date('Y-m-d');
								$invType['updateAt'] = date('Y-m-d h:i:s A');
								if ($this->crud_model->check_data_exist('investment_types', ['cert_id' => $dataSave, 'investName' => $team])) {
									$this->crud_model->delete('investment_types', ['cert_id' => $dataSave]);
								} else {
									$this->crud_model->insert('investment_types', $invType);
								}
							}
						}
						$support_kind = $this->input->post('support_kind');
						if (!empty(count($support_kind) > 0)) {
							foreach ($support_kind as $sprt) {
								$sptType['cert_id'] = $dataSave;
								$sptType['cert_num'] = $app_num;
								$sptType['supportName'] = $sprt;
								$sptType['createAt'] = date('Y-m-d');
								$sptType['updateAt'] = date('Y-m-d h:i:s A');
								if ($this->crud_model->check_data_exist('support_types', ['cert_id' => $dataSave, 'supportName' => $sprt])) {
									$this->crud_model->delete('support_types', ['cert_id' => $dataSave]);
								} else {
									$this->crud_model->insert('support_types', $sptType);
								}
							}
						}
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}
					$sms = "Dear $user_info->name, Your Enterprise Application is successfully submitted for Certification. We will review and update you on the status here shortly. You can also view it on your dashboard, Login: www.udyamika.telangana.gov.in WEHUB";
					$sendSms = get_sms($user_info->phone, $sms, '1507166418714661685');

					$datas =  array(
						'update_by' => '2',
						'update_user_id' => $id,
						'statusManage' => '1',
						'statusType' => 'KYC Verify',
						'statusRemark' => 'certificate submit',
						'user_id' => $id,
						'application_id' => $app_num,
						'create_at' => date('Y-m-d h:i:s a'),
						'application_num' => $app_num,
					);
					$this->crud_model->insert('status_manage_tbl', $datas);
				}

				$this->session->set_flashdata('success', "");
				redirect(base_url('user/enterpriseSuccess'), 'refresh');
			}
		} elseif ($this->input->post('draft')) {
			$this->form_validation->set_rules('tab', 'Identify ', 'trim|required');

			if ($this->form_validation->run() == FALSE) {

				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url("user/enterprise"), 'refresh');
			} else {

				$option3_count = $this->crud_model->check_duplicate("enterprise", ["user_id" => $id, "tbl_name" => "option3"]);
				if ($option3_count != 0) {

					$check = $this->crud_model->select_row("enterprise", ["user_id" => $id, "tbl_name" => "option3"]);
					$this->crud_model->delete("option3", ["enterprise_id" => $check->id]);
					$this->crud_model->delete("enterprise", ["id" => $check->id]);
				}

				$identity = $this->input->post("tab");

				if ($identity == "I want to develop an idea/start a business") {

					$tbl_name = "option1";

					$any_option = $this->input->post("any_option");

					$we_hub = $this->input->post("we_hub");

					$is_resume = $this->input->post("is_resume");

					if (!empty($_FILES['resume']['name'])) {
						$resume = upload_file('resume', 'enterprise/' . date('d-m-Y'));
					} else {
						$resume = '';
					}



					$training_other = $this->input->post("training_other");
					$training = $this->input->post("training");
				} elseif ($identity == "I have an idea and I have to start") {

					$tbl_name = "option2";

					if (!empty($_FILES['dpr_file']['name'])) {
						$resume = upload_file('dpr_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$resume = '';
					}

					if (!empty($_FILES['dpr_file']['name'])) {
						$dpr_file = upload_file('dpr_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$dpr_file = '';
					}
				} elseif ($identity == "I have an existing business") {

					$tbl_name = "option3";

					if (!empty($_FILES['solo_file']['name'])) {
						$solo_file = upload_file('solo_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$solo_file = '';
					}

					if (!empty($_FILES['partnership_file']['name'])) {
						$partnership_file = upload_file('partnership_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$partnership_file = '';
					}

					if (!empty($_FILES['company_file']['name'])) {
						$company_file = upload_file('company_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$company_file = '';
					}
					if (!empty($_FILES['pvt_file']['name'])) {
						$pvt_file = upload_file('pvt_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$pvt_file = '';
					}

					if (!empty($_FILES['llp_file']['name'])) {
						$llp_file = upload_file('llp_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$llp_file = '';
					}

					if (!empty($_FILES['udyam_file']['name'])) {
						$udyam_file = upload_file('udyam_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$udyam_file = '';
					}
					if (!empty($_FILES['gst_file']['name'])) {
						$gst_file = upload_file('gst_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$gst_file = '';
					}

					if (!empty($_FILES['pan_file']['name'])) {
						$pan_file = upload_file('pan_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$pan_file = '';
					}

					if (!empty($_FILES['audited_file']['name'])) {
						$audited_file = upload_file('audited_file', 'enterprise/' . date('d-m-Y'));
					} else {
						$audited_file = '';
					}
				}

				$data = array(
					"user_id" => $id,
					"tbl_name" => $tbl_name,
					"created_at" => date("Y-m-d H:i:s"),
					"updated_at" => date("Y-m-d H:i:s"),
					"appType" => '2'
				);

				if (!$this->crud_model->check_data_exist("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name])) {
					$insert = $this->crud_model->insert("enterprise", $data);
				} else {
					$this->crud_model->update_row_data("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name], ["updated_at" => date("Y-m-d H:i:s")]);
					$insert = $this->crud_model->get_single_data_object("enterprise", ["user_id" => $id, "tbl_name" => $tbl_name], 'id');
				}

				if ($tbl_name == "option1") {

					$data1 = array(
						"enterprise_id" => $insert,
						"we_hub" => $we_hub,
						"is_resume" => $is_resume,
						"resume" => $resume,
						"training" => $training,
						"training_other" => $training_other
					);
					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$this->crud_model->insert($tbl_name, $data1);
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}
				} else if ($tbl_name == "option2") {

					$data1 = array(
						"enterprise_id" => $insert,
						"business" => $this->input->post("business"),
						"sector" => $this->input->post("sector"),
						"category" => $this->input->post("category"),
						"category_other" => $this->input->post("category_other"),
						"support" => '',
						"support_other" => $this->input->post("support_other"),
						"dpr" => $this->input->post("dpr"),
						"drp_file" => $dpr_file
					);
					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$this->crud_model->insert($tbl_name, $data1);
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}
					$supportOptTwo = $this->input->post('supportOptTwo');
					if (!empty(count($supportOptTwo) > 0)) {
						foreach ($supportOptTwo as $spt) {
							$supOtrTwo['cert_id'] = $insert;
							$supOtrTwo['supportName'] = $spt;
							$supOtrTwo['updateAt'] = date('Y-m-d h:i:s A');
							if ($this->crud_model->check_data_exist('support_option_two', ['cert_id' => $insert, 'supportName' => $spt])) {
								$this->crud_model->delete('support_option_two', ['cert_id' => $insert]);
							} else {
								$this->crud_model->insert('support_option_two', $supOtrTwo);
							}
						}
					}
				} else if ($tbl_name == "option3") {

					$app_num = 'UDY' . rand('1000000', '9999999');
					$data1 = array(
						"enterprise_id" => $insert,
						"business" => $this->input->post("idea"),
						"sector" => $this->input->post("sector2"),
						"business_operation" => $this->input->post("operation"),
						"category" => $this->input->post("fit"),
						"category_text" => $this->input->post("fit_other"),
						"working_capital" => $this->input->post("investment"),
						"investment_type" => '',
						"monthly_revenue" => $this->input->post("revenue"),
						"annual_turnover" => $this->input->post("turnover"),
						"employee" => $this->input->post("empcount"),
						"no_emp" => $this->input->post("no_emp"),
						"business_register" => $this->input->post("regvrfy"),
						"legal_status" => $this->input->post("legal_status"),
						"solo_file" => $solo_file,
						"partnership_file" => $partnership_file,
						"company_file" => $company_file,
						"pvt_file" => $pvt_file,
						"llp_file" => $llp_file,
						"dpiit" => $this->input->post("dpit"),
						"dpiit_file" => $dpit_file,
						"udyam" => $this->input->post("udyam"),
						"udyam_file" => $udyam_file,
						"ext_investment" => $this->input->post("ext_investment"),
						"gst_file" => $gst_file,
						"pan_file" => $pan_file,
						"audited_file" => $audited_file,
						"enterprise" => $this->input->post("enterprise"),
						"kind_support" => '',
						"certificate_num" => $app_num,
						"applyMonth" => date('Y-m'),
						"applyDate" => date('Y-m-d h:i:s a'),
						"updateTime" => date('Y-m-d h:i:s a'),
						"investment_typeOther" => $this->input->post("invTypeOther")
					);
					if (!$this->crud_model->check_data_exist($tbl_name, ["enterprise_id" => $insert])) {
						$dataSave = $this->crud_model->insert($tbl_name, $data1);
						$investment_type = $this->input->post('investment_type');
						if (!empty(count($investment_type) > 0)) {
							foreach ($investment_type as $team) {
								$invType['cert_id'] = $dataSave;
								$invType['cert_num'] = $app_num;
								$invType['investName'] = $team;
								$invType['createAt'] = date('Y-m-d');
								$invType['updateAt'] = date('Y-m-d h:i:s A');
								if ($this->crud_model->check_data_exist('investment_types', ['cert_id' => $dataSave, 'investName' => $team])) {
									$this->crud_model->delete('investment_types', ['cert_id' => $dataSave]);
								} else {
									$this->crud_model->insert('investment_types', $invType);
								}
							}
						}
						$support_kind = $this->input->post('support_kind');
						if (!empty(count($support_kind) > 0)) {
							foreach ($support_kind as $sprt) {
								$sptType['cert_id'] = $dataSave;
								$sptType['cert_num'] = $app_num;
								$sptType['supportName'] = $sprt;
								$sptType['createAt'] = date('Y-m-d');
								$sptType['updateAt'] = date('Y-m-d h:i:s A');
								if ($this->crud_model->check_data_exist('support_types', ['cert_id' => $dataSave, 'supportName' => $sprt])) {
									$this->crud_model->delete('support_types', ['cert_id' => $dataSave]);
								} else {
									$this->crud_model->insert('support_types', $sptType);
								}
							}
						}
					} else {
						$this->crud_model->update_row_data($tbl_name, ["enterprise_id" => $insert], $data1);
					}
				}

				$sms = "Dear $user_info->name, Your Enterprise Application successfully saved. Your application is $app_num complete. Please complete the rest of the form login in at www.udyamika.telangana.gov.in WEHUB";
				$sendSms = get_sms($user_info->phone, $sms, '1507166418708633158');

				$this->session->set_flashdata('success', "");
				redirect(base_url('user/enterpriseDraftSuccess'), 'refresh');
			}
		} else {
			$data['title'] = 'My Enterprise - Udyamika';
			$data['sectors'] = ["Agri-Tech", "Agriculture", "Automobiles &amp; EV", "BFSI (Banking, Financial Service &amp; Insurance)", "Consumer-Tech", "Construction-Tech", "Data Science", "Deep-Tech (AI/ML/NLP)", "Edu-Tech", "E-Commerce", "Q-Commerce", "FMCG", "Food Processing", "Health-Tech", "Space-Tech", "Logistics &amp; Supply Chain", "Pharmaceuticals &amp; API", "Textiles & Handlooms", "Handicrafts", "Horticulture", "SaaS", "UAV/ Drones/ VTOL", "Others"];
			$data["option1"] = $this->crud_model->check_duplicate("enterprise", ["user_id" => $id, "tbl_name" => "option1", "appType" => "1"]);
			$data["option2"] = $this->crud_model->check_duplicate("enterprise", ["user_id" => $id, "tbl_name" => "option2", "appType" => "1"]);
			$data["option3"] = $this->crud_model->check_duplicate("enterprise", ["user_id" => $id, "tbl_name" => "option3", "appType" => "1"]);
			$data["userSts"] = $this->db->query("SELECT status FROM users WHERE id = '$id'")->row_array()['status'];

			// if($data["option3"] != 0){

			// 	$data["option3_enterpirse"] = $this->crud_model->select_row("enterprise", ["user_id" => $id, "tbl_name" => "option3"]);
			// 	$data["option3_data"] = $this->crud_model->select_row("option3", ["enterprise_id" => $data["option3_enterpirse"]->id]);
			// 	print_r($this->db->last_query());
			// }

			$data["option1_data"] = $this->db->query("SELECT enterprise.id,enterprise.user_id,option1.* FROM enterprise LEFT JOIN option1 ON enterprise.id = option1.enterprise_id WHERE enterprise.user_id ='$id'  AND enterprise.tbl_name = 'option1'")->row();
			$data["option2_data"] = $this->db->query("SELECT enterprise.id,enterprise.user_id,option2.* FROM enterprise LEFT JOIN option2 ON enterprise.id = option2.enterprise_id WHERE enterprise.user_id ='$id'  AND enterprise.tbl_name = 'option2'")->row();
			$data["option3_data"] = $this->db->query("SELECT enterprise.id,enterprise.user_id,option3.* FROM enterprise LEFT JOIN option3 ON enterprise.id = option3.enterprise_id WHERE enterprise.user_id ='$id'  AND enterprise.tbl_name = 'option3'")->row();

			$this->load->view('user-enterprise', $data);
		}
	}

	public function enterpriseSuccess()
	{
		$data['title'] = 'Success - Udyamika';
		$this->load->view('details-success', $data);
	}
	public function enterpriseDraftSuccess()
	{
		$data['title'] = 'Success - Udyamika';
		$this->load->view('details-success', $data);
	}

	public function documents()
	{
		$data['title'] = 'My Documents - Udyamika';

		$params['limit'] = RECORDS_PER_PAGE;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config = $this->config->item('pagination');
		$config['base_url'] = site_url('user/documents?');
		$config['total_rows'] = $this->crud_model->select_count('documents', ['user_id' => $this->session->userdata("user_id")]);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['documents'] = $this->crud_model->select_pagination('documents', ['user_id' => $this->session->userdata("user_id")], $params);

		//$data["documents"] = $this->crud_model->select("documents", ['user_id' => $this->session->userdata("user_id")]);
		$this->load->view('user-documents', $data);
	}

	public function meeting()
	{
		$data['title'] = 'Meetings - Udyamika';

		$params['limit'] = RECORDS_PER_PAGE;
		$params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
		$config = $this->config->item('pagination');
		$config['base_url'] = site_url('user/meeting_list?');
		$config['total_rows'] = $this->crud_model->select_count('schedule_meeting_tbl', ['user_id' => $this->session->userdata("user_id")]);
		$config['reuse_query_string'] = TRUE;
		$this->pagination->initialize($config);
		$data['meeting'] = $this->crud_model->select_pagination('schedule_meeting_tbl', ['user_id' => $this->session->userdata("user_id")], $params);
		$this->load->view('user-meeting', $data);
	}

	// public function ticket_query(){
	// 	if($this->input->post('submit')){
	// 		$id = $this->session->userdata("user_id");
	// 		if (!empty($this->session->userdata("user_id")))
	// 		{
	// 			if (!empty($_FILES['fileInsert']['name'])) {
	// 				$filePath = upload_file('fileInsert','grievances/'.date('d-m-Y'));
	// 			}
	// 			else{ 
	// 				$filePath = ''; 
	// 			}

	// 			$data = array(
	// 				'greivances_id' => $this->input->post('ticketId'),
	// 				'user_id' => $id,
	// 				'user_type' => 'User',
	// 				'contents' => $this->input->post("queryDetails"),
	// 				'added_at' => date("Y-m-d h:i:s a"),
	// 				'added_time' => date("h:i:s a"),
	// 				'admin_id' => '0',
	// 				'sub_admin' => '0',
	// 				'app_id' => '0',
	// 				'fileUpoads' =>$filePath
	// 			);
	// 			$data = $this->security->xss_clean($data);
	// 			$result = $this->crud_model->insert('greivances_chat_tbl', $data);
	// 			if($result)
	// 			{
	// 				$this->session->set_flashdata('success', 'Query submited successfully!');
	// 				redirect(base_url('user/grievance'));
	// 			}

	// 		} 
	// 		else 
	// 		{
	// 			$this->session->set_flashdata('errors', $data['errors']);
	// 			redirect(base_url("user/grievance"),'refresh');
	// 		}
	// 	}
	// }

	public function get_chat_by_ticket()
	{
		if ($this->input->post('ticket')) {
			$ticket = $this->input->post('ticket');
			$id = $this->session->userdata("user_id");
			$grievence = $this->db->query("select * from greivances_chat_tbl where greivances_id =  '$ticket' order by g_id asc")->result_array();
			$userPic = $this->db->query("select userPic from users where id =  '$id'")->row_array()['userPic'];
			if ($grievence) {
				$this->db->query("UPDATE  greivances_chat_tbl SET chatRead = '1' WHERE user_id = '$id' AND user_type != 'User'");
				$chats = '';
				foreach ($grievence as $rows) {
					if (!empty($rows['fileUpoads'])) {
						$dwnLink = base_url($rows['fileUpoads']);
						$icon = base_url("assets/images/new-download-icon.png");
						$dwnIcon = "<a href='$dwnLink' download><img src='$icon' class='downlChatIcon'></a>";
						$dwnIconAd = "<a href='$dwnLink' download><img src='$icon' class='downlChatIconAd'></a>";
					} else {
						$dwnIcon = '';
						$dwnIconAd = '';
					}


					$img = base_url("assets/images/logo-cht-icon.png");
					if (file_exists($userPic)) {
						$userImg = base_url($userPic);
					} else {
						$userImg = '';
					}
					$userIconStg = '<img src="' . $userImg . '" alt="" />';
					$desc = $rows['contents'];
					$upd = $rows['added_at'];
					$user_type = $rows['user_type'];

					if ($user_type == 'sub_admin' || $user_type == 'admin' || $user_type == 'L1' || $user_type == 'L2' || $user_type == 'L3') {
						$chats .= '<div class="query-cht">
					<div class="cht-img">
						<img src="' . $img . '" alt="" />
					</div>
					<div>
						<p>' . $desc . '</p>
						 
						<strong>Updated on ' . $dwnIconAd . '' . $upd . '</strong>
					</div>
				</div>';
					} else {
						$chats .= '<div class="query-cht query-chts">
					<div class="cht-img">
						 ' . $userIconStg . '
					</div>
					<div>
						<p>' . $desc . '</p>
						 
						<strong>Updated on ' . $upd . '' . $dwnIcon . '</strong>
					</div>
				</div>';
					}
				}
				$res['response'] = '1';
				$res['message'] = 'Chatting list avail.';
				$res['chat'] = $chats;
			} else {
				$res['response'] = '0';
				$res['message'] = 'No Chat.';
			}
		} else {
			$res['response'] = '0';
			$res['message'] = 'Chat not available.';
		}
		echo json_encode($res);
	}

	public function profile_picture()
	{
		$data['title'] = 'Profile picture update - Udyamika';
		$this->load->view('profile_update');
	}


	//-----------------------------------------------------------------------
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}


	//-----------------------------------------------------------
	public function get_sub_query_types()
	{
		$query_type = $this->input->post('Id');
		$sub_query_types = $this->lvl_model->get_sub_query_types('sub_queries', ['query_name' => $query_type]);
		echo json_encode($sub_query_types);
	}



	// public function create_query()
	// {
	// 	$query_type = $this->input->post("query_type");
	// 	$subject = $this->input->post("Sub_query_type");
	// 	$content = $this->input->post("content");
	// 	if (!empty($_FILES['file']['name'])) {
	// 		$allowed_extensions = array('jpg', 'jpeg', 'pdf');
	// 		$file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	// 		if (in_array(strtolower($file_extension), $allowed_extensions)) {
	// 			$file = upload_file('file', 'grievance/' . date('d-m-Y'));
	// 		} else {
	// 			$this->session->set_flashdata('error', 'Only JPG and PDF files are allowed.');
	// 			redirect('user/grievance');
	// 		}
	// 	} else {
	// 		$file = '';
	// 	}



	// 	$gyID = "GUDY" . rand(100000, 999999);
	// 	$data = array(
	// 		"query_type" => $query_type,
	// 		"subject" => $subject ?: '',
	// 		"content" => $content,
	// 		"file" => $file,
	// 		"created_at" => date("Y-m-d H:i:s"),
	// 		"updated_at" => date("Y-m-d H:i:s"),
	// 		"user_id" => $this->session->userdata("user_id"),
	// 		"user_type" => "User",
	// 		"grievance_id" => $gyID,
	// 		"status" => "Open"
	// 	);
	// 	$creationDateTime = new DateTime($data['created_at']);

	// 	$creationHour = (int) $creationDateTime->format('H');

	// 	$thresholdHour = 18; //6 pm

	// 	if ($creationHour >= $thresholdHour) {
	// 		$creationDateTime->modify('+1 day');
	// 		$creationDateTime->setTime(10, 0, 0);
	// 	}
	// 	$adjustedCreatedAt = $creationDateTime->format('Y-m-d H:i:s');
	// 	$data['created_at'] = $adjustedCreatedAt;
	// 	$insert = $this->crud_model->insert("grievance", $data);
	// 	$insert = $this->crud_model->insert("l1_grievance", $data);

	// 	if ($insert) {
	// 		$data1 = array(
	// 			'greivances_id' => $gyID,
	// 			'user_id' => $this->session->userdata("user_id"),
	// 			'user_type' => 'User',
	// 			'contents' => $content,
	// 			'added_at' => date("Y-m-d h:i:s a"),
	// 			'added_time' => date("h:i:s a"),
	// 			'admin_id' => '0',
	// 			'sub_admin' => '0',
	// 			'app_id' => '0',
	// 			'fileUpoads' => $file
	// 		);
	// 		$result = $this->crud_model->insert('greivances_chat_tbl', $data1);
	// 		$senDate = date('Y-m-d');
	// 		$senTime = date('H:i:s');
	// 		$user_info = $this->crud_model->select_row("users", ["id" => $this->session->userdata("user_id")]);
	// 		$sms = "Dear $user_info->name, Your grievance with the ticket number $gyID is successfully raised on Date $senDate at Time $senTime. Our team will get in touch with you shortly. Please login into your dashboard for more details. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
	// 		$sendSms = get_sms($user_info->phone,$sms,'1507166418754565897');

	// 		$this->session->set_flashdata('success', 'Grievance Raised successfully!');
	// 		redirect(base_url('user/grievance'));
	// 	} else {

	// 		$this->session->set_flashdata('error', 'There was Problem');
	// 		redirect(base_url('user/grievance'));
	// 	}
	// }

	public function get_sms()
	{
		$requestParams = array(
			'user' => 'Wehubfoundation',
			'password' => 'Wehub@0308',
			'mobile' => '9491651755',
			'message' => 'Dear mahesh, Your grievance with the ticket number 20351 is successfully closed. Hope our team answers your query. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB',
			'sender' => 'TWEHUB',
			'type' => '3',
			'template_id' => '1507166418766838662'
		);

		$apiUrl = 'https://api.bulksmsgateway.in/sendmessage.php?';
		foreach ($requestParams as $key => $val) {
			$apiUrl .= $key . '=' . urlencode($val) . '&';
		}
		$apiUrl = rtrim($apiUrl, "&");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($ch);
		curl_close($ch);
		//print_r($response);
		return true;
	}


	public function create_query()
	{
		if ($this->input->is_ajax_request()) {
			// Validate file
			if (!empty($_FILES['file']['name'])) {
				$allowed_extensions = array('jpg', 'jpeg', 'pdf');
				$file_extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

				if (!in_array(strtolower($file_extension), $allowed_extensions)) {
					$response = array(
						'status' => 'error',
						'message' => 'Only JPG and PDF files are allowed.'
					);

					echo json_encode($response);
					return;
				}

				$file = upload_file('file', 'grievance/' . date('d-m-Y'));
			} else {
				$file = '';
			}
			$query_type = $this->input->post("query_type");
			$subject = $this->input->post("Sub_query_type");
			$content = $this->input->post("content");
			$gyID = "GUDY" . rand(100000, 999999);
			$data = array(
				"query_type" => $query_type,
				"subject" => $subject ?: '',
				"content" => $content,
				"file" => $file,
				"created_at" => date("Y-m-d H:i:s"),
				"updated_at" => date("Y-m-d H:i:s"),
				"user_id" => $this->session->userdata("user_id"),
				"user_type" => "User",
				"grievance_id" => $gyID,
				"status" => "Open"
			);

			// $query = strtotime($data['created_at']);
			// if (date('H', $query) >= 00 && date('H', $query) < 10) {
			// 	$data['created_date'] = date('Y-m-d 10:00:00', $query);
			// } elseif (date('H', $query) >= 18 || date('H', $query) <=24) {
			// 	$data['created_date'] = date('Y-m-d 10:00:00', strtotime('+1 day', $query));
			// } else {
			// 	$data['created_date'] = date("Y-m-d H:i:s");
			// }

			$creationDateTime = new DateTime($data['created_at']);

			$creationHour = (int) $creationDateTime->format('H');

			$thresholdHour = 18; //6 pm
			$queryTime = 10;
			if ($creationHour >= $thresholdHour) {
				$creationDateTime->modify('+1 day');
				$creationDateTime->setTime(10, 0, 0);
			} else if ($creationHour <= $queryTime) {
				$data['created_at'] = date('Y-m-d 10:00:00');
			}
			$adjustedCreatedAt = $creationDateTime->format('Y-m-d H:i:s');
			$data['created_at'] = $adjustedCreatedAt;
			$insert = $this->crud_model->insert("grievance", $data);
			$insert_l1 = $this->crud_model->insert("l1_grievance", $data);
			if ($insert && $insert_l1) {
				$data1 = array(
					'greivances_id' => $gyID,
					'user_id' => $this->session->userdata("user_id"),
					'user_type' => 'User',
					'contents' => $content,
					'added_at' => date("Y-m-d h:i:s a"),
					'added_time' => date("h:i:s a"),
					'admin_id' => '0',
					'sub_admin' => '0',
					'app_id' => '0',
					'fileUpoads' => $file
				);
				$result = $this->crud_model->insert('greivances_chat_tbl', $data1);
				$senDate = date('Y-m-d');
				$senTime = date('H:i:s');
				$user_info = $this->crud_model->select_row("users", ["id" => $this->session->userdata("user_id")]);
				$sms = "Dear $user_info->name, Your grievance with the ticket number $gyID is successfully raised on Date $senDate at Time $senTime. Our team will get in touch with you shortly. Please login into your dashboard for more details. In case of queries, reach out to udyamika-wehub@telangana.gov.in or 9059264664 WEHUB";
				$sendSms = get_sms($user_info->phone, $sms, '1507166418754565897');
				$response = array(
					'status' => 'success',
					'message' => 'Grievance Raised successfully!'
				);
			} else {
				$response = array(
					'status' => 'error',
					'message' => 'There was a problem'
				);
			}

			// $this->output->set_content_type('application/json');
			echo json_encode($response);
		}
	}
}
