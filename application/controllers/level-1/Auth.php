<?php defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('mailer');
        $this->load->model('lvl_model');
        $this->load->library('session');
    }

    //--------------------------------------------------------------
    public function index()
    {

        if (!empty($this->session->userdata('l1_id'))) {
            redirect(base_url('lvl_dashboard'));
        }
        $this->form_validation->set_rules('email', 'Login email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() === true) {
            $user = $this->lvl_model->login($this->input->post('email'), $this->input->post('password'), '1');
            if (!empty($user)) {

                $response = array('status' => 'success', 'message' => 'login successful');
                $this->session->set_userdata('l1_id', $user->id);
            } else {
                $response = array('status' => 'false', 'message' => 'Incorrect Email Or Password');
            }
            echo json_encode($response);
        } else {
            $this->load->view('L1/signin');
        }
    }



    //-----------------------------------------------------------------------
    public function logout()
    {
        $this->session->sess_destroy();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        redirect(base_url('l1_signin'), 'refresh');
    }




    public function assign_query_to_level2()
    {
        $twentyFourHoursAgo = date('Y-m-d H:i:s', strtotime('-24 hours'));

        $query = $this->db->query("SELECT * FROM l1_grievance WHERE created_at <= '$twentyFourHoursAgo' AND status='Open'");

        $results = $query->result();

        foreach ($results as $result) {
            $createdAt = $result->created_at;
            $id = $result->id;
            $grievance_id = $result->grievance_id;

            $this->db->update('grievance', ['status' => 'Reassign to L2'], ['id' => $id]);
            $this->db->update('l1_grievance', ['status' => 'Reassign to L2'], ['id' => $id]);

            $grievance = $this->db->query("SELECT subject, query_type, user_id, status, content, file,priority FROM grievance WHERE grievance_id = '$grievance_id'")->row();
            $level2 = $this->db->query("SELECT name, email FROM ci_users WHERE id = '2'")->row();
            $email = $level2->email;

            $msg = "Dear $email,\n\nA grievance with the ticket number $grievance_id has been assigned to you. Please log in to your dashboard and resolve the grievance as soon as possible.\n\nBest regards,\nWEHUB";
            $this->send_mail($email, $msg);

            $data = [
                'grievance_id' => $result->grievance_id,
                'subject' => $result->subject,
                'user_id' => $result->user_id,
                'query_type' => $result->query_type,
                'content' => $result->content,
                'created_at' => $createdAt,
                'updated_at' => date("Y-m-d H:i:s"),
                'trans_date' => date("Y-m-d H:i:s"),
                'admin_id' => '1',
                'priority' => $result->priority,
                'file' => $result->file,
                'status' => 'Open'
            ];

            $this->db->insert('l2_grievance', $data);
        }
    }


    public function assign_query_to_level3()
    {
        $twentyFourHoursAgo = date('Y-m-d H:i:s', strtotime('-24 hours'));

        $query = $this->db->query("SELECT * FROM l2_grievance WHERE trans_date <= '$twentyFourHoursAgo' AND status='Open'");

        $results = $query->result();

        foreach ($results as $result) {
            $id           = $result->id;
            $grievance_id = $result->grievance_id;

            $this->db->update('grievance', ['status' => 'Reassign to L3'], ['id' => $id]);
            $this->db->update('l2_grievance', ['status' => 'Reassign to L3'], ['id' => $id]);

            $grievance = $this->db->query("SELECT subject, query_type, user_id, status, content,priority file FROM grievance WHERE grievance_id = '$grievance_id'")->row();
            $level3    = $this->db->query("SELECT name, email FROM ci_users WHERE id = '3'")->row();
            $email     = $level3->email;

            $msg = "Dear $email,\n\nA grievance with the ticket number $grievance_id has been assigned to you. Please log in to your dashboard and resolve the grievance as soon as possible.\n\nBest regards,\nWEHUB";
            $this->send_mail($email, $msg);

            $data = [
                'grievance_id' => $result->grievance_id,
                'subject' => $result->subject,
                'user_id' => $result->user_id,
                'query_type' => $result->query_type,
                'content' => $result->content,
                'created_at' => $result->created_at,
                'updated_at' => date("Y-m-d H:i:s"),
                'trans_date' => date("Y-m-d H:i:s"),
                'admin_id' => '1',
                'priority' => $result->priority,
                'file' => $result->file,
                'status' => 'Open'
            ];

            $this->db->insert('l3_grievance', $data);
        }
    }



    public function send_mail($email, $msg)
    {
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => '_mainaccount@cmschamps.com',
            'smtp_pass' => 'D$.~&_$uDaPX',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('_mainaccount@cmschamps.com', 'Vijay');
        $this->email->to($email);
        $this->email->subject('Grievance assigned');

        $this->email->message($msg);

        return $this->email->send();
    }
}
