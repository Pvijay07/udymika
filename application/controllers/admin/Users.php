<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends MY_Controller {

	public function __construct(){

		parent::__construct();
		auth_check(); // check login auth
		$this->load->model('admin/user_model', 'user_model');
		$this->load->library('datatable'); // loaded my custom serverside datatable library
	}

	public function index(){

		$data['title'] = 'Users List';
		$data['users'] = $this->user_model->get_all_users();
		$this->load->view('admin/users',$data);
	}
	
	

	//-----------------------------------------------------------
	public function change_status(){   

		$this->user_model->change_status();
	}

	//-----------------------------------------------------------
	public function add(){

		if($this->input->post('submit')){
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('usertype', 'User Type', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[ci_users.email]');
			$this->form_validation->set_rules('mobile', 'Number', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('admin/users/add'),'refresh');
			}
			else{
				
				$data = array(
					'name' => $this->input->post('name'),
					'usertype' => $this->input->post('usertype'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('mobile'),
					'is_active' => $this->input->post('status'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
				if($result){
					$this->session->set_flashdata('success', 'User has been added successfully!');
					redirect(base_url('admin/users/add'));
				}
			}
		}
		else{

			$data['title'] = 'Add User';

			$this->load->view('admin/users-add', $data);
			
		}
		
	}

	//-----------------------------------------------------------
	public function edit($id = 0){

		if($this->input->post('submit')){
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('usertype', 'User Type', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
			$this->form_validation->set_rules('mobile', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'admin/users/user_edit';
				echo 'hi'; exit;
				$this->load->view('admin/includes/_header', $data);
				$this->load->view('admin/users/user_edit', $data);
				$this->load->view('admin/includes/_footer');
			}
			else{
				$data = array(
					'name' => $this->input->post('name'),
					'usertype' => $this->input->post('usertype'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('mobile'),
					'is_active' => $this->input->post('status'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				
				if(!empty($this->input->post('password'))){
					$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				}

				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);
				if($result){
					$this->session->set_flashdata('success', 'User has been updated successfully!');
					redirect(base_url('admin/users/edit/'.$id));
				}
			}
		}
		else{
			$data['title'] = 'Edit User';
			$data['user'] = $this->user_model->get_user_by_id($id);
			
			$this->load->view('admin/users-edit', $data);
		}
	}

	//-----------------------------------------------------------
	public function delete($id = 0)
	{
		
		$this->db->delete('ci_users', array('id' => $id));
		$this->session->set_flashdata('success', 'Use has been deleted successfully!');
		redirect(base_url('admin/users'));
	}

}


	?>