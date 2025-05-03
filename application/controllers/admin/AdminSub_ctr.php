<?php defined('BASEPATH') OR exit('No direct script access allowed');



class AdminSub_ctr extends My_Controller {



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

		$this->load->model('admin/AdminSubModal', 'subadmin_modal');

    }



 

    public function sub_admin_listing()

	{
		$data['title'] = 'Sub Admin List';

		$params['limit'] = RECORDS_PER_PAGE;

        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;

        $config = $this->config->item('pagination');

        $config['base_url'] = site_url('master_subadmin?');

    	$config['total_rows'] = $this->subadmin_modal->get_all_subadmin_count();

		$config['reuse_query_string'] = TRUE;

        $this->pagination->initialize($config);

        $data['subadmin'] = $this->subadmin_modal->get_all_subadmin($params);

		$this->load->view('admin/subAdmin/index', $data);	

	}	

    public function sub_admin_details($user_id)

	{

		$data['title'] = 'Sub Admin Details';

		$data['admin'] = $this->subadmin_modal->get_subadmin_details($user_id);

		$this->load->view('admin/subAdmin/details', $data);	

	}

	

	public function create_new_sub_admin()

	{

		$data['title'] = 'Sub Admin create';

		$data['district'] = $this->subadmin_modal->get_district();

		$this->form_validation->set_rules('full_name', 'full_name', 'required');

		$this->form_validation->set_rules('phone_number', 'phone number', 'trim|required|is_unique[master_login_tbl.admin_contact]');

		$this->form_validation->set_rules('district', 'district', 'trim|required');

		$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[master_login_tbl.admin_email]');

		$this->form_validation->set_rules('password', 'password', 'trim|required');

		$this->form_validation->set_rules('confirm_password', 'confirm password', 'trim|required');



        if($this->form_validation->run())

        {

			if (!empty($_FILES['aadhar_card']['name'])) {

				$aadhar_card = upload_file('aadhar_card','adminDoc/'.date('d-m-Y'));

			}

			else{ 

				$aadhar_card = ''; 

			}

			if($this->input->post('password') == $this->input->post('confirm_password'))

			{

				$datas = array(

					'admin_type' => '2',

					'admin_status' => '1',

					'admin_name' => $this->input->post('full_name'),

					'admin_email' => $this->input->post('email'),

					'admin_password' => md5($this->input->post('password')),

					'admin_contact' => $this->input->post('phone_number'),

					'admin_address' => '',

					'aadhar_number' => $this->input->post('aadhar_no'),

					'aadhar_file' => $aadhar_card,

					'admin_district' => $this->input->post('district')

				);

				$admin = $this->subadmin_modal->insert('master_login_tbl',$datas);

				if($admin)

				{

					$this->session->set_flashdata('msg','Sub admin created successfully.');

					redirect(base_url('master_subadmin'));

				}

				else

				{

					$this->session->set_flashdata('msg','Failed to create admin.');

					redirect(base_url('master_subadmin'));

				}

			}

			else

			{

				$this->session->set_flashdata('msg','Both the password not match.');

				redirect(base_url('master_subadmin'));

			}

        }

        else

        {

			$this->load->view('admin/subAdmin/index',$data);

        }

	}

	public function sub_admin_deleted()

	{

		if($this->input->post('user_id'))

		{

			$admin = $this->subadmin_modal->delete('master_login_tbl',['admin_id' => $this->input->post('user_id')]);

			if($admin)

			{

				$res['response'] = '1';

				$res['message'] = 'Sub admin deleted successfully.';

			}

			else

			{

				$res['response'] = '0';

				$res['message'] = 'Failed to delete Sub admin.';

			}

		}

		else

		{

			$res['response'] = '0';

			$res['message'] = 'Invalid parameter.';

		}

		echo json_encode($res);

	}

	public function get_sub_admin_details()

	{

		if(!empty($this->input->post('id')))

		{

			$admin = $this->subadmin_modal->get_sub_admin($this->input->post('id'));

			if($admin)

			{

				$res['response'] = '1';

				$res['message'] = 'Sub admin details.';

				$res['datas'] = $admin;

			}

			else

			{

				$res['response'] = '0';

				$res['message'] = 'Failed to fetch details Sub admin.';

			}

		}

		else

		{

			$res['response'] = '0';

			$res['message'] = 'Invalid parameter.';

		}

		echo json_encode($res);

	}



	public function sub_admin_updated()

	{

		$data['title'] = 'Sub Admin create';

		$data['district'] = $this->subadmin_modal->get_district();

		$this->form_validation->set_rules('full_name', 'full_name', 'required');

		$this->form_validation->set_rules('admin_id', 'admin_id', 'trim|required');

        if($this->form_validation->run())

        {

			$admin_id = $this->input->post('admin_id');

			if (!empty($_FILES['aadhar_card']['name'])) {

				$aadhar_card = upload_file('aadhar_card','adminDoc/'.date('d-m-Y'));

			}

			else{ 

				$aadhar_card = $this->input->post('admin_profile'); 

			}

			if(!empty($this->input->post('password')))

			{

				if($this->input->post('password') == $this->input->post('confirm_password'))

				{

					$datas = array(

						'admin_name' => $this->input->post('full_name'),

						'admin_email' => $this->input->post('email'),

						'admin_password' => md5($this->input->post('password')),

						'admin_contact' => $this->input->post('phone_number'),

						'aadhar_number' => $this->input->post('aadhar_no'),

						'aadhar_file' => $aadhar_card,

						'admin_district' => $this->input->post('district')

					);

					$admin = $this->subadmin_modal->update('master_login_tbl',$datas,['admin_id'=>$admin_id]);

					if($admin)

					{

						$this->session->set_flashdata('msg','Sub admin created successfully.');

						redirect(base_url('master_subadmin'));

					}

					else

					{

						$this->session->set_flashdata('msg','Failed to create admin.');

						redirect(base_url('master_subadmin'));

					}

				}

				else

				{

					$this->session->set_flashdata('msg','Both the password not match.');

					redirect(base_url('master_subadmin'));

				}

			}

			else

			{

				$datas = array(

					'admin_name' => $this->input->post('full_name'),

					'admin_email' => $this->input->post('email'),

					'admin_contact' => $this->input->post('phone_number'),

					'aadhar_number' => $this->input->post('aadhar_no'),

					'aadhar_file' => $aadhar_card,

					'admin_district' => $this->input->post('district')

				);

				$admin = $this->subadmin_modal->update('master_login_tbl',$datas,['admin_id'=>$admin_id]);

				if($admin)

				{

					$this->session->set_flashdata('msg','Sub admin created successfully.');

					redirect(base_url('master_subadmin'));

				}

				else

				{

					$this->session->set_flashdata('msg','Failed to create admin.');

					redirect(base_url('master_subadmin'));

				}

			}

        }

        else

        {

			redirect(base_url('master_subadmin'));

        }

	}



	public function sub_admin_download()

	{

		$this->load->library('pdf');

		//$sts = $this->input->post('cer_sts');

		$tr = '';

		foreach($this->input->post('admin') as $certificate_id)

		{

			$datas = $this->db->query("SELECT admin_name,admin_email,admin_contact,aadhar_number,districts.name FROM master_login_tbl left join districts on districts.id = master_login_tbl.admin_district WHERE admin_id = '$certificate_id'")->row();

			$tr .= "<tr> <td>$datas->admin_name</td> <td>$datas->admin_email</td> <td>$datas->name</td>  <td>$datas->aadhar_number </td> <td>$datas->admin_contact </td></tr>";

		}

		$data['tblRow'] = $tr;

		$file_name = date('Ymdhis').".pdf";

        $html = $this->load->view('admin/subAdmin/download', $data, true);

        $this->pdf->createPDF($html, $file_name, true);

	}

}



?>