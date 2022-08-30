<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_Model extends CI_Model {

   public function __construct()
    {
     parent::__construct();
	$this->load->database('');
     }

       public function index(){
          
	}
	
        public function validate_user($username,$password){
        $this->db->from('user'); 
        $this->db->where('useremail', $username );  
        $this->db->where( 'password', $password );
        $login = $this->db->get()->result();
        if( is_array($login) && count($login) == 1 ) {	
           $this->details = $login[0];           
           $this->set_session();         
           return "success";
           }else{
              return "fail"; 
           }	
            
         }
        
         function set_session() {
         $this->load->library('session');
         $this->session->set_userdata( array(
                'id'=>$this->details->userid,
                'firstname'=> $this->details->firstName,
                'lastname'=>  $this->details->lastName,
                'email'=>$this->details->useremail,
                'phone'=>$this->details->userphone,
                'role'=>$this->details->role,
                'isLoggedIn'=>true
              )

        );

        }
	
	public function getUserTask(){
	$this->db->from('task');
        return $this->db->get()->result_array();
	}
	public function deleteTask($taskid){
        $query = $this->db->query("DELETE FROM task WHERE taskid='$taskid'");
        return TRUE; 		
	}
        public function deleteUser($id){
        $query = $this->db->query("DELETE FROM user WHERE userid='$id'");
        return TRUE; 		
	}
	public function addTask($data){
        return $result = $this->db->insert('task',$data);		
	}
        
       public function addUser($data){
       return  $result = $this->db->insert('user',$data);
        	
	}
        public function leads($leads){
       return  $result = $this->db->insert('lead',$leads);
        	
	}

      public function getUser(){
      $this->db->from('user');
      return $this->db->get()->result_array();
      }
	  public function getLeads(){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->join('user', 'user.userid = lead.userid');
      return $this->db->get()->result_array();
      }
	   public function deleteLead($id){
        $query = $this->db->query("DELETE FROM lead WHERE leadid='$id'");
        return TRUE; 		
	}
	
	public function getTotalLeads($id){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();
      }
	  public function getCompletedLeads($id){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();
      }
	   public function getPendingLeads($id){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();
      }
	  public function getSingleLead($id){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('leadid', $id);
      return $this->db->get()->result_array();
      }
      public function userProfileInfo($id){
        $this->db->select('*');
      $this->db->from('user');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();

      }

     


      public function getSalesmanAction($id){
      $this->db->select('*');
      $this->db->from('salesmanager_action');
      $this->db->where('leadid', $id);
      $this->db->where('userid', $this->session->userdata('id'));
      return $this->db->get()->result_array(); 
      }
      public function AddAction($actionData){
        return $result = $this->db->insert('salesmanager_action',$actionData); 
      }
	  
	  
	 public function addReminder($reminder){
		    return $result = $this->db->insert('reminder',$reminder);		
	 }
	public function getReminders($id){
      $this->db->select('*');
      $this->db->from('reminder');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();
      }
	public function deletereminder($id){
		 $query = $this->db->query("DELETE FROM reminder WHERE R_id='$id'");
        return TRUE; 
	}
	
}
