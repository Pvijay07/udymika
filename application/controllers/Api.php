<?php
require APPPATH . '/libraries/REST_Controller.php';
class Api extends CI_Controller
{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
            die();
        }
        parent::__construct();
        $this->load->model('admin/user_model', 'user_model');
        $this->load->model('Crud_model', 'crud_model'); 

    }

     public function index() {
        echo 'hi';
     }
    
    public function leads() {
                
        $postdata = json_decode(file_get_contents('php://input'));
        $query = $this->db->get_where('leads', array('sales' => $postdata->id, 'demo_status !=' => 'Completed'));

		$results = $query->result();

        if(!empty($results)){
           
            $final_data = array();
            foreach($results as $result){
                
                $data = array('id' => $result->id,
                              'service' => $result->service,
                              'name' => $result->name,
                              'email' => $result->email,
                              'mobile' => $result->mobile,
                              'city' => $result->city,
                              'appointment_status' => $result->demo_status,
                              'appointment_date' => $result->demo_date,
                              'appointment_time' => $result->demo_time,
                              'comments' => $result->message);

                array_push($final_data, $data);
                $array = array('status'=>true, 'results'=> $final_data);                 
            }
        } else {
            $array = array('status'=>false, 'msg'=> 'There is No Leads');
        }

        echo json_encode($array);
    }


    public function update() {
                
        $postdata = json_decode(file_get_contents('php://input'));

        $id = $postdata->id;
        $sales_id = $postdata->user_id;
        $status = $postdata->status;
        $message = $postdata->message;
        $visit = $postdata->visit;
        $date = $postdata->date;
        $time = $postdata->time;
        
        if($status == "Follow Up"){
            
                $data = array('demo_status' => "Scheduled",
                            'message' => $message,
                            'demo_date' => $date,
                            'demo_time' => $time,
                            'visit' => $visit);

        } else {
            
              $data = array('status' => $status,
                            'message' => $message,
                            'demo_date' => "",
                            'demo_time' => "",
                            'demo_status' => "Completed",
                            'visit' => $visit);
            
        }

            $update = $this->crud_model->edit("leads", $data, $id);

            if($update){

                $data2 = array('lead_id' => $id,
                            'sales_id' => $sales_id,
                            'visit_status' => $visit,
                            'status' => $status,
                            'demo_date' => $date,
                            'demo_time' => $time,
                            'message' => $message,
                            'created_at' => date("Y-m-d H:i:s"));

                $result = $this->crud_model->add("appointments", $data2);

                
                $array = array('status'=>true, 'msg'=> "Appointment Details Updated Successfully.");  

            } else {

                $array = array('status'=>false, 'msg'=> "No changes has been Done.");  

            }
        

        echo json_encode($array);
        
    }

    public function upload(){

        $postdata = json_decode(file_get_contents('php://input')); 

        
        $id = $postdata->id;
        $logProfilePic   = $postdata->image;

        $date = date('dmYHis');
        $img = base64_decode($logProfilePic);  
        $path = 'uploads/'.$date.'.jpg';
        file_put_contents($path,$img); 

        if($img != false) 
        {
            $file = $path;
        }
        else
        {
            $file = '';
        }


        if(!empty($file))
		{
							
                $data = array("image" => $file);

                $update = $this->crud_model->edit("leads", $data, $id);

                $array = array('status'=>true, 'msg'=> 'Image Uploaded Successfully', 'image' => base_url().$file);                
			
             
		} else {

            $array = array('status'=>false, 'msg'=> "Please Upload Image.");

        }

        echo json_encode($array);

    }
    
    
}