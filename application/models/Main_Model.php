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
		$this->db->where( 'userstatus',1);
        $login = $this->db->get()->result();
        if( is_array($login) && count($login) == 1 ) {	
           $this->details = $login[0];           
           $this->set_session();         
           return "success";
           }else{
              return "fail"; 
           }	
            
         }
		 
		 function update_user($u,$p){
			  $this->db->where('useremail',$u);
			 $this->db->where('password',$p);
			 $this->db->set('chat_status',1);
			 $this->db->update('user');
			
		 }
		 function update_chat_status($id){
			 $this->db->where('userid',$id);
			 $this->db->set('chat_status',0);
			 $this->db->update('user');
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
 
 //admin Dashboard
 public function get_leadcounts_by_status(){
	 $this->db->select('COUNT(CASE WHEN status = "Active" THEN 1 END) as active_leads,COUNT(CASE WHEN status = "New Lead" THEN 1 END) as prospective_leads,COUNT(CASE WHEN status = "Irrelevant" THEN 1 END) as demo_leads,COUNT(CASE WHEN status = "Not Interested" THEN 1 END) as nonactive_leads');
      $this->db->from('lead');
	  //$this->db->where('status','Active Client');
	 return $this->db->get()->result_array();  
 }
 
  //admin - ADD USER
  
 public function addUser($data){
       return  $result = $this->db->insert('user',$data);
}
	
//admin - All USER	
public function getUser(){
	  $this->db->select('*');
      $this->db->from('user');
	  $this->db->where('role','user');
	 return $this->db->get()->result_array();
}	
public function deleteUser($id){
        $query = $this->db->query("DELETE FROM user WHERE userid='$id'");
        return TRUE; 		
}
public function archive_lead($id,$archive){
        $this->db->where('leadid',$id);
	    $this->db->set('archive',$archive); 
		 $this->db->update('lead');
        return $this->db->last_query(); 		
}	
//user activation and deactivation 	  
	
public function deactivate_User($id,$newdata){
		$this->db->where('userid',$id);
		 return $this->db->update('user',$newdata);  
}
	
public function activate_user($id,$newdata){
		
		 $this->db->where('userid',$id);
		 return $this->db->update('user',$newdata);  
}

//Create Lead

public function leads($leads){
       return  $result = $this->db->insert('lead',$leads);
        	
}

//All Leads

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


	
	public function getUserTask(){
	$this->db->from('task');
        return $this->db->get()->result_array();
	}
	public function deleteTask($taskid){
        $query = $this->db->query("DELETE FROM task WHERE taskid='$taskid'");
        return TRUE; 		
	}
       
	public function addTask($data){
        return $result = $this->db->insert('task',$data);		
	}
        
       
    public function change_password($pwd , $userid){
		
		$this->db->where('userid',$userid);
		$this->db->set('password',md5($pwd));
        $this->db->update('user');
		if($this->db->affected_rows()){
			return 1;
		}
	}    
    
	public function delete_lead($lid){
		
		$this->db->delete('lead', array('leadid' => $lid)); 
        $this->db->delete('salesmanager_action', array('leadid' => $lid));
       $this->db->delete('reminder', array('leadid' => $lid));
	}  
	
      
	  
	  
	 
	 
	
/**********************************Transfer lead********************************/
	public function editLead($id){
      /* $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('leadid', $id);
      return $this->db->get()->result_array();  */
   $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('user', 'lead.userid = user.userid');
  
   $this->db->where('lead.leadid', $id );
   $query=$this->db->get();
   return $query->result_array(); 
	}
	
	
	public function updateLead(){
      $this->db->select('*');
   $this->db->from('user');
   $this->db->where('role','user');
   $query=$this->db->get();
   return $query->result_array(); 
	  
	  }
	  public function updateData($change){
      $leadid=$change->leadid;
	  //$owner=$change->userid;
	  
		$this->db->where('leadid',$leadid);
        $this->db->update('lead' ,$change);
	  }
	  
	  public function transferLead($data)
	  {
		    $this->db->where('leadid',$data['leadid']);
            $this->db->update('lead' ,$data);
			
	  }
	    public function transferLeadactions($data){
		  $this->db->where('leadid',$data['leadid']);
          $this->db->update('salesmanager_action' ,$data);
	  }
	  public function remove_reminders($l,$u){
            
		  $this->db->where('leadid',$l);
		  $this->db->where('userid',$u);
          $this->db->delete('reminder'); 
	  }
/**********************************end transfer lead***********************************/

/*******************************Activity log status**********************************/

	public function activity_log($status){
		$log_data['userid'] =  $this->session->userdata('id');
		$log_data['status'] =  $status;
		return $result = $this->db->insert('activity_log',$log_data);
	}


/******************************User Dashboard Status*****************************/	  
	
public function getTotalLeads($id){
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();
}



public function getCompletedLeads($id){
   $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
   $this->db->where('salesmanager_action.userid', $id );
   $this->db->where('salesmanager_action.next_action','Close_Lead' );
   $query=$this->db->get();
   return $query->result_array(); 
}

public function getPendingLeads($id){
   $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
   $this->db->where('salesmanager_action.userid', $id );
   $this->db->where("salesmanager_action.next_action != 'Close_Lead'" );
   $this->db->group_by('salesmanager_action.leadid');
   $query=$this->db->get();
   return $query->result_array(); 
}
/************************End User Dashboard Status************************************/

	  public function getSingleLead($id){
      $this->db->select('*');
      $this->db->from('lead');
	  $this->db->join('user','lead.userid=user.userid');
      $this->db->where('leadid', $id);
      return $this->db->get()->result_array();
      }
      public function userProfileInfo($id){
        $this->db->select('*');
      $this->db->from('user');
      $this->db->where('userid', $id);
      return $this->db->get()->result_array();

      }

     public function updateMyProfile($user){
		 
		 $this->db->where('userid',$this->session->userdata('id') );
        $this->db->update('user' ,$user);
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
	  
	
	  
	  public function update_rem($r_id,$r_data){
		$this->db->where('R_id',$r_id);
        $this->db->update('reminder' ,$r_data);
	  }
	  
	  public function getclientname($id){
	    $this->db->select('*');
        $this->db->from('lead');
        $this->db->where('leadid', $id);
        $this->db->where('userid', $this->session->userdata('id'));
        return $this->db->get()->result_array(); 
	  }
	 public function addReminder($reminder){
		    return $result = $this->db->insert('reminder',$reminder);   		   
	 }
	 
	public function get_lead_action($id){
		
		
	  $this->db->select('*');
      $this->db->from('salesmanager_action');
      $this->db->where('leadid', $id);
      return $this->db->get()->result_array();
		
	}
	 
	public function getReminders($id){
      $this->db->select('reminder.*');
      $this->db->from('reminder');
	  $this->db->join('lead','lead.leadid = reminder.leadid');
      $this->db->where('reminder.userid', $id);
	    $this->db->where('lead.archive!=',1);
      return $this->db->get()->result_array();
    }
	  
	public function get_upcoming_reminders($id){
		$this->db->select('*');
        $this->db->from('reminder');
        $this->db->where('userid', $id);
	$where = '(rem_days!="0" or rem_hours != "0")';
       $this->db->where($where);
 
        return $this->db->get()->result_array();
	  }
	  
	   public function get_past_reminders($id){
		$this->db->select('*');
        $this->db->from('reminder');
        $this->db->where('userid', $id);
	    $this->db->where('rem_days',0);
        $this->db->where('rem_hours',0);
        //$this->db->where('rem_minutes',0); 
        return $this->db->get()->result_array();
	  } 
	  
	  public function get_data_rem($id){
      $this->db->select('*');
      $this->db->from('reminder');
      $this->db->where('R_id', $id);
      return $this->db->get()->result_array();
      }
	  
	  
	public function deletereminder($id){
		 $query = $this->db->query("DELETE FROM reminder WHERE R_id='$id'");
        return TRUE; 
	}
	
	
	public function get_cur_pwd($input_pwd){
		
	  $this->db->select('password');
      $this->db->from('user');
      $this->db->where('userid',$this->session->userdata('id'));
	  $c_pwd = $this->db->get()->result_array();
      if($input_pwd==$c_pwd['password']){
		  return true;
	  }else{
		  return false;
	  }
	  
	}
	
	public function change_pwd($pwd){
		$this->db->set('password',$pwd);
        $this->db->where('userid',$this->session->userdata('id') );
        $this->db->update('user');
		return $this->db->get()->result_array();
	}
	
	
	
//Dashboard
public function get_user_target(){
	$this->db->select('*');
	$this->db->from('set_target');
    $this->db->where('userid',$this->session->userdata('id'));
	return $this->db->get()->result_array(); 
}

public function get_all_users(){
	$this->db->select('*');
	$this->db->from('user');
    $this->db->where('role','user');
	return $this->db->get()->result_array(); 
}	
	
public function get_leadcounts_per_user(){
	
	
$this->db->select(' user.* ,COUNT(lead.userid) as lead_count')
         ->from('user')
		 ->WHERE('user.userid = lead.userid');
$this->db->join('lead', 'lead.userid = user.userid','left');
       return $this->db->get()->result_array(); 
}	

	
public function get_myleads(){
	  $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $this->session->userdata('id'));
	  return $this->db->get()->result_array(); 
}

public function upcommingReminder(){
	  $this->db->select('*');
      $this->db->from('reminder');
      $this->db->where('userid',$this->session->userdata('id'));
	  $this->db->order_by('reminderDate','asc');
	  $this->db->limit(10);
      return $this->db->get()->result_array(); 
		
}



//csv upload functions

public function insert_csv_data($data1){
	if($this->db->insert('lead',$data1)){
		return true;
	}
	
}
public function checkmail($email){
	 $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('email',$email);
      $r = $this->db->get(); 
	  $count = $r->num_rows();
	  if($count==0){
		  return true;
	  }
}
public function get_userid($name){
	$this->db->select('userid');
	$this->db->from('user');
	$this->db->where('firstName',$name);
}
//end of csv upload
//target functions
public function get_selected_user_leads($id){
	  $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid',$id);
      return $this->db->get()->result_array(); 
}	
public function set_target($data,$id){
	
	$this->db->insert('set_target',$data);

	}	
	
public function check_target($id)
{
		$this->db->select('target');
		$this->db->from('set_target');
		$this->db->where('userid',$id);
		$result = $this->db->get()->result_array();
		if($result){
			return $result;
		}else{
			return false;
		}
		
}
public function transfer_completed_target($id){
	    $this->db->select('*');
		$this->db->from('set_target');
		$this->db->where('userid',$id);
		$result = $this->db->get()->result_array();
		return $result;
		//echo $this->set_target_inhistory($result,$id);
		
		
}

public function set_target_inhistory($data,$id){
	  if($this->db->insert('set_target_history',$data)){
		 $this->db->where('userid', $id);
          $this->db->delete('set_target'); 
		  return true;
	  }
}


public function completedleadsofuser($id){
	$this->db->select('*');
    $this->db->from('salesmanager_action');
    $this->db->where('userid',$id);
	$this->db->where('next_action','Close_Lead');
    return $this->db->get()->result_array();	
}
	
public function gettargets()
{
	$this->db->select('*');
    $this->db->from('set_target');
	$this->db->join('user', 'set_target.userid = user.userid');
    return $this->db->get()->result_array();
}
public function get_targetuser_comleads($uid){
	$this->db->select('*');
    $this->db->from('set_target');
	$this->db->join('salesmanager_action', 'set_target.userid = salesmanager_action.userid');
	$this->db->where('salesmanager_action.next_action','Close_Lead');
	$this->db->where('set_target.userid',$uid);
	$this->db->where('salesmanager_action.action_date BETWEEN set_target.startdate and set_target.enddate');
    return $this->db->get()->result_array();
}

public function get_leads_actions($leadid){
	 $this->db->select('*');
      $this->db->from('salesmanager_action');
      $this->db->where('leadid',$leadid);
      return $this->db->get()->result_array(); 
}
/**********Get timezone ***********/
public function gettimezone()
{
	  $id=$this->session->userdata('id');
	  $this->db->select('timez');
      $this->db->from('user');
      $this->db->where('userid',$id);
      return $this->db->get()->result_array(); 
}
/************End Timezone************/

/**************Online-Offline Status*********************/
public function userstatus()
{
   $this->db->select('chat_status,firstName,lastName');
   $this->db->from('user');
   $this->db->where('role','user');
   $query=$this->db->get();
   return $query->result_array(); 
	
}
/*******************End Online-Offline********************/


/********************Mylead pending and close lead***************************/


public function get_lead_id()
{
  $this->db->select('salesmanager_action.leadid');
  $this->db->from('salesmanager_action');
  $this->db->where("salesmanager_action.next_action='Close_Lead'");
  $query=$this->db->get();
  return $query->result_array();
}


public function get_pending_leads($lead_id){
	
   $id1=$this->session->userdata('id');
    $this->db->select('lead.*,user.*');
   //$this->db->select('');
   $this->db->from('lead');
   
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
  
    $this->db->join('user', 'user.userid = lead.userid');
   //$this->db->where("lead.leadid !=",$lead_id);
     $this->db->where("user.userid=$id1");
	 $this->db->group_by('lead.leadid'); 
	 $this->db->order_by('lead.register_date','DESC'); 
     foreach($lead_id as $id)
   { 
    $idd=$id['leadid'];
    // $this->db->where_not_in('lead.leadid',$id);
	  $this->db->where("lead.leadid != $idd"); 
	  
   }
 
 
     
   
  $query=$this->db->get();
   
   return $query->result_array(); 
  
}
/*************************End Mylead pending and close lead****************************/

/*****************************Add reminder ******************************/


public function getAllleads($id)
{
      $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid', $id);
	  $this->db->where('archive!=',1);
      return $this->db->get()->result_array();
}


/***************************End Add Reminder******************************/

//edit user
public function get_userinfo($id){
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('userid',$id);
	$query=$this->db->get();
    return $query->result_array(); 
}

 public function Update_User1($udata,$id){
	$this->db->where('userid',$id);
	$this->db->update('user',$udata);

} 

public function updateprofile($fname){
	$this->db->set('profilePicture',$fname);
	$this->db->where('userid',$this->session->userdata('id'));
	$this->db->update('user');
}


}