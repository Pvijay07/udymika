<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	public function super_admin_login($email,$password){
		return $this->db->get_where('master_login_tbl',array('admin_email'=>$email,'admin_password'=>md5($password),'admin_type'=>'1'))->row();
	}

}

?>