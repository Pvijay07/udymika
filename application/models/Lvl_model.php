<?php defined ( 'BASEPATH' ) or exit( 'No direct script access allowed' );
class Lvl_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct ();
        $this->ogrievenceTable  = 'grievance';
        $this->grievenceTable   = 'l1_grievance';
        $this->l2grievenceTable = 'l2_grievance';
        $this->l3grievenceTable = 'l3_grievance';
        $this->usersTable       = 'users';
        $this->lvlusersTable    = 'ci_users';
    }


    // -------------------level1-----------------------------------------------------------------------------------------------------------------------------------------
    public function get_all_l1()
    {
        return $this->db->count_all ( $this->grievenceTable );
    }
    public function get_all_l2()
    {

        return $this->db->where (
            'status',
            'Reassign to L2'
        )->from ( $this->grievenceTable )->count_all_results ();
    }
    public function get_all_l3()
    {
        return $this->db->where (
            'status',
            'Reassign to L3'
        )->from ( $this->grievenceTable )->count_all_results ();
    }
    public function get_all_grievence_closed( $status )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l1_grievance.user_id = users.id', 'left' );
        $this->db->where ( 'l1_grievance.status', $status );
        $this->db->from ( 'l1_grievance' );
        return $this->db->count_all_results ();
    }
    public function get_all_l1__grievence_count( $status )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l1_grievance.user_id = users.id', 'left' );
        $this->db->where ( 'l1_grievance.status', $status );
        $this->db->from ( 'l1_grievance' );
        return $this->db->count_all_results ();
    }

    public function get_all_2l1__grievence_count( $status )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l1_grievance.user_id = users.id', 'left' );
        $this->db->where_in ( 'l1_grievance.status', $status );
        $this->db->from ( 'l1_grievance' );
        return $this->db->count_all_results ();
    }


    public function get_l1_grievence( $params, $status )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no' );
        $this->db->order_by ( 'l1_grievance.id', 'desc' );
        if ( isset( $params ) && !empty( $params ) ) {
            $this->db->limit ( $params['limit'], $params['offset'] );
        }
        $this->db->where ( 'l1_grievance.status', $status );
        $this->db->join ( 'users', 'l1_grievance.user_id = users.id', 'left' );
        return $this->db->get ( 'l1_grievance' )->result ();
    }

    // -------------------level2-----------------------------------------------------------------------------------------------------------------------------------

    public function get_all()
    {
        return $this->db->count_all ( $this->l2grievenceTable );
    }
    public function get_l1()
    {
        return $this->db->where (
            'status',
            'Reassign to L1'
        )->from ( $this->l2grievenceTable )->count_all_results ();
    }
    public function get_l2()
    {

        return $this->db->where (
            'status',
            'Reassign to L2'
        )->from ( $this->l2grievenceTable )->count_all_results ();
    }


    public function get_l3()
    {
        return $this->db->where (
            'status',
            'Reassign to L3'
        )->from ( $this->l2grievenceTable )->count_all_results ();
    }
    public function get_grievence_count( $status )
    {
        $this->db->select ( 'l2_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l2_grievance.user_id = users.id', 'left' );
        $this->db->where ( 'l2_grievance.status', $status );
        $this->db->from ( 'l2_grievance' );
        return $this->db->count_all_results ();
    }

    public function get_l2_grievence( $params, $status )
    {
        $this->db->select ( 'l2_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no' );
        $this->db->order_by ( 'l2_grievance.id', 'desc' );
        if ( isset( $params ) && !empty( $params ) ) {
            $this->db->limit ( $params['limit'], $params['offset'] );
        }
        $this->db->where ( 'l2_grievance.status', $status );
        $this->db->join ( 'users', 'l2_grievance.user_id = users.id', 'left' );
        return $this->db->get ( 'l2_grievance' )->result ();
    }
    public function get_use_grievance( $user_id, $status, $ticket_id )
    {
        $this->db->select ( 'l2_grievance.*' );
        $this->db->order_by ( 'id', 'asc' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->where ( 'id', $ticket_id );
        // $this->db->where('l1_grievance.status',$status);
        return $this->db->get ( 'l2_grievance' )->result_array ();
    }



    //----------------------------------level3-----------------------------------------------------------------------------------------------------------------------------------------


    public function get_griev_l3()
    {
        return $this->db->count_all ( $this->l3grievenceTable );
    }

    public function get_alll2()
    {
        return $this->db->where (
            'status',
            'Reassign to L2'
        )->from ( $this->l3grievenceTable )->count_all_results ();
    }
    public function get_alll1()
    {
        return $this->db->where (
            'status',
            'Reassign to L1'
        )->from ( $this->l3grievenceTable )->count_all_results ();
    }
    public function get__l3()
    {
        return $this->db->where (
            'status',
            'Reassign to L3'
        )->from ( $this->l3grievenceTable )->count_all_results ();
    }
    public function get_grievence_count_l3( $status )
    {
        $this->db->select ( 'l3_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l3_grievance.user_id = users.id', 'left' );
        $this->db->where ( 'l3_grievance.status', $status );
        $this->db->from ( 'l3_grievance' );
        return $this->db->count_all_results ();
    }
    public function get_grievence_closed_count( $status )
    {
        $this->db->select ( 'l3_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'l3_grievance.user_id = users.id', 'left' );
        $this->db->where ( 'l3_grievance.status', $status );
        $this->db->from ( 'l3_grievance' );
        return $this->db->count_all_results ();
    }
    public function get_l3_grievence( $params, $status )
    {
        $this->db->select ( 'l3_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no' );
        $this->db->order_by ( 'l3_grievance.id', 'desc' );
        if ( isset( $params ) && !empty( $params ) ) {
            $this->db->limit ( $params['limit'], $params['offset'] );
        }
        $this->db->where ( 'l3_grievance.status', $status );
        $this->db->join ( 'users', 'l3_grievance.user_id = users.id', 'left' );
        return $this->db->get ( 'l3_grievance' )->result ();
    }
    public function get_us_grievance( $user_id, $status, $ticket_id )
    {
        $this->db->select ( 'l3_grievance.*' );
        $this->db->order_by ( 'id', 'asc' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->where ( 'id', $ticket_id );
        // $this->db->where('l1_grievance.status',$status);
        return $this->db->get ( 'l3_grievance' )->result_array ();
    }

    // public function get_grievance_by_id( $id )
    // {
    //     $this->db->select ( 'l2_grievance.*' );
    //     $this->db->order_by ( 'id', 'desc' );
    //     $this->db->where ( 'id', $id );
    //     return $this->db->get ( 'l2_grievance' )->row ();
    // }
    //----------------------------------common-----------------------------------------------------------------------------------------------------------------------------------------
    public function login( $email, $password, $id )
    {
        $this->db->where ( 'id', $id );
        $this->db->where ( 'email', $email );

        $this->db->from ( $this->lvlusersTable );
        $query = $this->db->get ();
        $user  = $query->row ();

        if ( $user && password_verify ( $password, $user->password ) ) {
            return $user;
        }
        else {
            return false;
        }
    }
    public function get_sub_query_types( $table, $where )
    {
        $this->db->select ( 'name' );
        $this->db->where ( $where );
        $this->db->from ( $table );
        $query = $this->db->get ();
        return $query->result ();
    }
    public function update_data( $table, $params, $where_params )
    {
        if ( !empty( $where_params ) ) {
            foreach ( $where_params as $w_key => $w_val ) {
                $this->db->where ( trim ( $w_key ), $w_val );
            }
        }
        if ( !empty( $params ) ) {
            foreach ( $params as $s_key => $s_val ) {
                $this->db->set ( trim ( $s_key ), $s_val );
            }
        }
        return $this->db->update ( trim ( $table ) );
    }
    public function insert( $tbl, $data )
    {
        $this->db->insert ( $tbl, $data );
        return true;
    }
    public function get_user_details( $user_id )
    {
        $this->db->select ( 'users.*' );
        $this->db->where ( 'id', $user_id );
        return $this->db->get ( 'users' )->row ();
    }
    public function get_certificate( $user_id )
    {
        $this->db->select ( 'enterprise.user_id' );
        $this->db->select ( 'option3.*' );
        $this->db->where ( 'enterprise.tbl_name', 'option3' );
        $this->db->where ( 'enterprise.user_id', $user_id );
        $this->db->join ( 'option3', 'enterprise.id = option3.enterprise_id', 'left' );
        return $this->db->get ( 'enterprise' )->row ();
    }
    public function get_user_check_list( $user_id, $appid )
    {
        $checklist_type = $this->db->query ( "SELECT checklist FROM certificate_admin_allot WHERE user_id = '$user_id' AND certi_id = '$appid'" )->row ();
        return $this->db->query ( "SELECT q_id,check_list_id,checklist_que,queType FROM checklist_question_tbl WHERE check_list_id = '$checklist_type'" )->result ();
    }
    public function get_grivance_remark( $user_id, $cert_id )
    {
        $this->db->select ( 'statusRemark' );
        $this->db->where ( 'user_id', $user_id );
        return $this->db->get ( 'status_manage_tbl' )->result_array ();
    }



    public function get_user_certificate( $user_id )
    {
        $this->db->select ( 'documents.id as doc_id, documents.name as doc_name, documents.file_name,documents.created_at as upload_date' );
        //$this->db->select('users.*');
        $this->db->where ( 'user_id', $user_id );
        //$this->db->join('users', 'documents.user_id = users.id', 'left');
        return $this->db->get ( 'documents' )->result_array ();
    }

    public function get_grievence( $user_id )
    {
        $this->db->select ( 'id' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->from ( $this->grievenceTable );
        $query = $this->db->get ();
        return $query->result ();
    }
    public function get_greivences()
    {
        $this->db->select ( '*' );
        $this->db->from ( $this->grievenceTable );
        $query = $this->db->get ();
        return $query->result ();
    }
    public function get_by_status()
    {
        return $this->db->where (
            'status',
            'Raised'
        )->from ( $this->ogrievenceTable )->count_all_results ();
    }
    public function get_closed()
    {
        return $this->db->where (
            'status',
            'Closed'
        )->from ( $this->ogrievenceTable )->count_all_results ();
    }
    public function get_users( $user_id )
    {
        $this->db->select ( '*' );
        $this->db->where ( 'id', $user_id );
        $this->db->from ( $this->usersTable );
        $query = $this->db->get ();
        return $query->result ();
    }
    public function get_all_users()
    {
        $this->db->select ( '*' );
        $this->db->from ( $this->usersTable );
        $query = $this->db->get ();
        return $query->result ();
    }
    public function get_query( $currentDate )
    {
        $this->db->select ( '*' );
        $this->db->where ( 'created_at >=', $currentDate );
        $this->db->from ( $this->grievenceTable );
        $query = $this->db->get ();
        return $query->result ();
    }

    public function get_priority( $id )
    {
        $this->db->select ( 'priority' );
        $this->db->where ( 'grievance_id', $id );
        $this->db->from ( $this->ogrievenceTable );
        $query = $this->db->get ();
        return $query->row ();
    }

    public function get_all_grievence_count( $status )
    {
        $this->db->select ( 'grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no,users.created_at' );
        $this->db->join ( 'users', 'grievance.user_id = users.id', 'left' );
        $this->db->where ( 'grievance.status', $status );
        $this->db->from ( 'grievance' );
        return $this->db->count_all_results ();
    }

    public function get_all_grievence( $params, $status )
    {
        $this->db->select ( 'grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no' );
        $this->db->order_by ( 'grievance.id', 'desc' );
        if ( isset( $params ) && !empty( $params ) ) {
            $this->db->limit ( $params['limit'], $params['offset'] );
        }
        $this->db->where ( 'grievance.status', $status );
        $this->db->join ( 'users', 'grievance.user_id = users.id', 'left' );
        return $this->db->get ( 'grievance' )->result ();
    }

    public function get_l2_all_grievence( $params )
    {
        $this->db->select ( 'l2_grievance.*' );
        $this->db->select ( 'users.id as user_id,users.name,users.email,users.phone,users.adhaar_no' );
        $this->db->order_by ( 'l2_grievance.id', 'desc' );
        if ( isset( $params ) && !empty( $params ) ) {
            $this->db->limit ( $params['limit'], $params['offset'] );
        }
        // $this->db->where('l2_grievance.status', $status);
        $this->db->join ( 'users', 'l2_grievance.user_id = users.id', 'left' );
        return $this->db->get ( 'l2_grievance' )->result ();
    }

    public function get_user_grievance( $user_id, $status, $ticket_id )
    {
        $this->db->select ( 'grievance.*' );
        $this->db->order_by ( 'id', 'asc' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->where ( 'id', $ticket_id );
        // $this->db->where('l1_grievance.status',$status);
        return $this->db->get ( 'grievance' )->result_array ();
    }
    public function get_userl1__grievance( $user_id, $status, $ticket_id )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->order_by ( 'id', 'asc' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->where ( 'id', $ticket_id );
        // $this->db->where('l1_grievance.status',$status);
        return $this->db->get ( 'l1_grievance' )->result_array ();
    }
    
    public function get_grievance_l( $id )
    {
        $this->db->select ( 'l1_grievance.*' );
        $this->db->order_by ( 'id', 'desc' );
        $this->db->where ( 'id', $id );
        return $this->db->get ( 'l1_grievance' )->row();
    }
    public function get_grievance( $id )
    {
        $this->db->select ( 'l2_grievance.*' );
        $this->db->order_by ( 'id', 'desc' );
        $this->db->where ( 'id', $id );
        return $this->db->get ( 'l2_grievance' )->row();
    }
    public function get( $id )
    {
        $this->db->select ( 'l3_grievance.*' );
        $this->db->order_by ( 'id', 'desc' );
        $this->db->where ( 'id', $id );
        return $this->db->get ( 'l3_grievance' )->row ();
    }
    public function get_user_business( $user_id )
    {
        $this->db->select ( 'option3.*' );
        $this->db->select ( 'enterprise.user_id' );
        $this->db->where ( 'user_id', $user_id );
        $this->db->join ( 'enterprise', 'enterprise.id = option3.enterprise_id', 'left' );
        return $this->db->get ( 'option3' )->row ();
    }
}