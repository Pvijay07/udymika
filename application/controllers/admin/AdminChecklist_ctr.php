<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminChecklist_ctr extends My_Controller {

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
					break;
				}
			}
        }
		if($this->session->userdata('admin_type') != '1')
		{
			redirect(base_url('master_logout'));
		}
		$this->load->model('admin/AdminChecklistModal', 'checklist_modal');
    }

 
    public function check_listing()
	{
		$data['title'] = 'Check List';
		$params['limit'] = RECORDS_PER_PAGE;
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('master_checklist?');
    	$config['total_rows'] = $this->checklist_modal->get_all_checklist_count();
		$config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['kyc'] = $this->checklist_modal->get_all_checklist($params);
		//print_r($this->db->last_query());
		$this->load->view('admin/checklist/checklist', $data);	
	}	
    public function checklisting_details($user_id)
	{
		$data['title'] = 'Checklist Details';
		$data['user_info'] = $this->checklist_modal->get_user_details($user_id);
		$data['docs_info'] = $this->checklist_modal->get_user_certificate($user_id);
		$data['grievance'] = $this->checklist_modal->get_user_grievance($user_id);
		$this->load->view('admin/checklist/checklist_details', $data);	
	}	
    public function get_checklist_question()
	{
		if(!empty($this->input->post('checklist')))
		{
			$checklist = $this->checklist_modal->get_checklist_ques($this->input->post('checklist'));
			if(!empty($checklist))
			{
				$datas = ''; $k= 1;
				foreach ($checklist as $chks) {
					$ques = $chks['checklist_que'];
					$q_id = $chks['q_id'];
					 
					 $datas .= "
					 	<div class='kyc-form-cntrl'>
                            <label>".$k++.". $ques</label>";
							if($chks['queType'] == '1'){
								
                            $datas .= "<div class='kyc-radio'>
                                <div>
                                    <input type='radio' name='pwd' value='Yes' id='physicalUnit_$k' onclick='getYesFunction(1,$q_id)' />
                                    <label for='physicalUnit_$k'>Yes</label> 
                                </div>
								<div id='hiden_div_$q_id' style='display:none;margin: 10px 5px 10px 50px;'>";

								$options = $this->db->query("SELECT o_id,question_id,option_name,option_value,input_type FROM checklist_que_option_tbl WHERE question_id = '$q_id'")->result_array();
								if(!empty($options)){
									foreach ($options as $value) {
									if($value['input_type'] == '1'){
										$o_id = $value['o_id'];
										$lbel = $value['option_name'];
										$val = $value['option_value'];
										$datas .= "<div class='kyc-radio'>
												<div>
													<input type='radio' name='optionYes' value='$val' id='otherOption_$o_id' />
													<label for='otherOption_$o_id'>$val</label> 
												</div><br>
											</div>";
									}
									else if($value['input_type'] == '3'){
										$o_id = $value['o_id'];
										$lbel = $value['option_name'];
										$val = $value['option_value'];
										$datas .= "<div class='kyc-form'>
												<div>
													<label>$lbel</label> 
													<input type='text' name='optionText' id='optionText_$o_id' style='width: 100%;'/>
												</div><br>
											</div>";
									}
								} }
								$datas .= "</div> 
                                <div>
                                    <input type='radio' name='pwd' value='No' id='physicalUnitNo_$k' onclick='getYesFunction(2,$q_id)'/>
                                    <label for='physicalUnitNo_$k'>No</label>
                                </div>
                            </div>";
							}else if($chks['queType'] == '2'){
								$datas .= "<div class='kyc-form'>
                                <div>
                                    <input type='text' name='inputText' value='' id='inputText' />
                                </div>
                                
                            </div>";
							} else if($chks['queType'] == '3' || $chks['queType'] == '4'){
								$datas .= "<div class='kyc-form'>
                                <div>
                                    <input type='file' name='imageInput' id='imageInput' />
                                </div>
                                
                            </div>";
							}else if($chks['queType'] == '5'){
								$datas .= "<div class='doc-sub-form'>
                                 <textarea type='text' name='remarks' id='remarks' ></textarea>
                            </div>";
							}
							$datas .= "</div>";
				}
				$res['datas'] = $datas;
				$res['response'] = '1';
				$res['message'] = 'Questions list avialable';
			}
			else
			{
				$res['response'] = '0';
				$res['message'] = 'Questions list not avialable';
			}
		}
		else
		{
			$res['response'] = '0';
			$res['message'] = 'Questions list not avialable';
		}
		echo json_encode($res);
	}	
}

?>