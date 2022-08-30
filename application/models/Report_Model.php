<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_Model extends CI_Model {

   public function __construct()
    {
     parent::__construct();
	 $this->load->database('');
    }

    public function index(){
          
	}
	
	public function deactivate_user($id,$newdata){
		
		 $this->db->where('userid',$id);
		 return $this->db->update('user',$newdata);  
	}
	public function activate_user($id,$newdata){
		
		 $this->db->where('userid',$id);
		 return $this->db->update('user',$newdata);  
	}
	
//forgot password 

public function forgotPassword($email){
	
	$this->db->select('*');
    $this->db->from('user');
    $this->db->where('useremail',$email);
	$r_data = $this->db->get()->result_array();
	$num_rows = $this->db->count_all_results();
    if($num_rows==1){
		return $r_data;
	}else{
		return false;
	}
}	
	
public function updatepassword($u_id,$newpassword){
	$this->db->where('userid',$u_id);
	$this->db->set('password',$newpassword);
	$this->db->update('user');
	return true;
}	
	
// View Report	
	
	public function get_ComLeads(){
		$this->db->select('*');
      $this->db->from('salesmanager_action');
      $this->db->where('first_action','Intrested');
      return $this->db->get()->result_array();
	}
	public function get_callbkLeads(){
	 $this->db->select('*');
      $this->db->from('salesmanager_action');
      $this->db->where('first_action','Call Back');
      return $this->db->get()->result_array();
	}
	
	public function get_callbk_leads(){
		
    $this->db->select('*');
    $this->db->from('salesmanager_action s');
    $this->db->join('lead l', 'l.leadid = s.leadid', 'left');
    $this->db->where('s.first_action','Call Back');	
    $query = $this->db->get();
    return $query->result();
		
	}
	
	public function get_selecteduser_leads($id){
	  $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('userid',$id);
	    return $this->db->get()->result_array();
	}
	
public function get_followup_leads($id){
   
   $this->db->select('*');
   $this->db->from('salesmanager_action');
   $this->db->join('lead', 'lead.leadid = salesmanager_action.leadid');
   $this->db->where('salesmanager_action.first_action', 'Follow-Up');
    $this->db->where('salesmanager_action.userid',$id);
   $query=$this->db->get();
   return $query->result_array(); 
	
	}
	public function get_firstcall_leads($id){
		 $this->db->select('*');
         $this->db->from('lead');
         $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid');
         $this->db->where('salesmanager_action.first_action', 'First Call');
         $this->db->where('salesmanager_action.userid',$id);
         $query=$this->db->get();
        return $query->result_array(); 
	}
	
	//grid demo
	
	public function get_sel_userdata($id){
	  $this->db->select('*');
      $this->db->from('lead');
      $this->db->where('lead.userid',$id);
	    return $this->db->get()->result_array();
	}
	
	
	
//new_report_functions

public function getleadsby_status($userid,$status){
	 $this->db->select('lead.*');
     $this->db->from('lead');
     $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
     $this->db->group_by('lead.leadid');
	 $this->db->where('salesmanager_action.userid',$userid);
	 $this->db->where('salesmanager_action.first_action',$status);
     $query=$this->db->get();
      return $query->result_array(); 
}

public function get_all_leads(){
	$this->db->select('*');
    $this->db->from('lead');
    return $this->db->get()->result_array();
}	

public function get_leads($u_id,$status,$sel_date1,$sel_date2){
	
       $this->db->select('*');
       $this->db->from('lead');
       $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid');
       $this->db->where('salesmanager_action.first_action',$status);
       $this->db->where('salesmanager_action.userid',$u_id);
	   $this->db->where("(salesmanager_action.action_date >='$sel_date1' AND salesmanager_action.action_date <= '$sel_date2')");
	   $query=$this->db->get();
   return $query->result_array(); 
	}


public function get_lastmonth_leads($u_id,$status){
	
    $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid');
   $this->db->where('salesmanager_action.first_action', $status );
   $this->db->where('salesmanager_action.userid', $u_id );
  $this->db->where('MONTH(salesmanager_action.action_date)',date('m'));
   $query=$this->db->get();
   return $query->result_array(); 
}	

public function get_last_week_leads($u_id,$status){
	$monday = strtotime("last monday");
	$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
	 
	$sunday = strtotime(date("Y/m/d",$monday)." +6 days");
	 
	 $this_week_sd = date("Y/m/d",$monday);
	 $this_week_ed = date("Y/m/d",$sunday);
 
	   $this->db->select('*');
	   $this->db->from('lead');
	   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid');
	   $this->db->where('salesmanager_action.first_action', $status );
	   $this->db->where('salesmanager_action.userid', $u_id );
	   //$this->db->where('salesmanager_action.time ','(salesmanager_action.time >=$this_week_sd AND salesmanager_action.time <= $this_week_ed)');
	   $this->db->where("(salesmanager_action.action_date >='$this_week_sd' AND salesmanager_action.action_date <= '$this_week_ed')");
	   $query=$this->db->get();
	  
	   return $query->result_array(); 
}	
public function get_leads_bydate($u_id,$status,$sel_date){
	
       $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid');
   $this->db->where('salesmanager_action.first_action', $status );
   $this->db->where('salesmanager_action.userid', $u_id );
   $this->db->where('salesmanager_action.action_date =',$sel_date);
   $query=$this->db->get();
      return $query->result_array();
}		
	

//calender

public function add_reminder($title,$s_date){
	$u_id=$this->session->userdata('id');
  $this->db->query("INSERT INTO reminder(userid,client_name,reminderDate)values('{$u_id}','{$title}','{$s_date}')");

}

//end calender	

//All Leads functions
public function get_pending_leads($lead_id){
	
  
    $this->db->select('lead.*,user.*');
   //$this->db->select('');
   $this->db->from('lead');
   
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
  
    $this->db->join('user', 'user.userid = lead.userid');
   //$this->db->where("lead.leadid !=",$lead_id);
    $this->db->group_by('lead.leadid');
     foreach($lead_id as $id)
   { 
    $idd=$id['leadid'];
    // $this->db->where_not_in('lead.leadid',$id);
	  $this->db->where("lead.leadid != $idd"); 
   }
     
   
  $query=$this->db->get();
   
   return $query->result_array(); 
  
}

public function get_lead_id()
{
  $this->db->select('salesmanager_action.leadid');
  $this->db->from('salesmanager_action');
  $this->db->where("salesmanager_action.next_action='Close_Lead'");
  $query=$this->db->get();
  return $query->result_array();
}


public function get_closed_leads(){
   $this->db->select('*');
   $this->db->from('lead');
   $this->db->join('salesmanager_action', 'lead.leadid = salesmanager_action.leadid','left');
   $this->db->join('user', 'salesmanager_action.userid = user.userid');
   $this->db->where("salesmanager_action.next_action = 'Close_Lead'" );
   
   $query=$this->db->get();
   return $query->result_array(); 
}

public function get_unass_leads(){
  $this->db->select('*');
   $this->db->from('lead');
   $this->db->where('userid',null);
   $query=$this->db->get();
   return $query->result_array(); 
}

public function gettargets()
{
	$this->db->select('*');
    $this->db->from('set_target');
	$this->db->join('user', 'set_target.userid = user.userid');
    return $this->db->get()->result_array();
}


/*****************Leader Board******************/

public function leaderboard()
{

	  $this->db->select('user.userid as userid,max(user.firstName) as   firstName, COUNT(lead.leadid) as lead_count,lastName,userstatus',FALSE)
                      ->from('user')
                      ->join('lead', 'user.userid=lead.userid','left')
					  
					 ->where("user.role='user'")
                      ->group_by('user.userid')
                      ->order_by('user.userid', 'asc');
                     
 
	
      return $this->db->get()->result_array();
	
}

public function leaderboard1()
{
	$this->db->select('user.userid as userid, COUNT(CASE WHEN salesmanager_action.next_action = "Close_Lead" THEN 1 END) as status_count,salesmanager_action.leadid',FALSE)
                      ->from('user')
                      ->join('salesmanager_action', 'user.userid=salesmanager_action.userid','left')
					  ->where("user.role='user'")
                      ->group_by('user.userid')
                      ->order_by('user.userid', 'asc');
                     
     return $this->db->get()->result_array();
}
public function leaderboard2($closed_leads){
	
	$this->db->select('user.userid as userid,COUNT(leadid) as p_count',FALSE);
                      $this->db->from('user');
					  $this->db->join('lead', 'user.userid=lead.userid','left');
					  $this->db->where("user.role='user'");
                   foreach($closed_leads as $l)
                   { 
                      $lid=$l['leadid'];
	                  $this->db->where("lead.leadid != $lid"); 
                   }
				   $this->db->group_by('user.userid');
                   $this->db->order_by('user.userid', 'asc');
					  
   $query=$this->db->get();
   return $query->result_array(); 
}

public function get_closed_leadsid(){
	$this->db->select('leadid');
	$this->db->from('salesmanager_action');
	$this->db->where('next_action','Close_Lead');
	$query=$this->db->get();
    return $query->result_array(); 
}


//admin - delete leads
public function deleteleads($ldata){
	foreach($ldata as $l){
		 $this->db->where('leadid',$l->leadid);
         $this->db->delete('lead');
	}
	return true;
}

// check lead availability
public function checkleadavailability($email){
	$this->db->select('*');
	$this->db->from('lead');
	$this->db->where('email',$email);
	$query = $this->db->get();
	$rowcount = $query->num_rows();
	if($rowcount==0){
		return true;
	}else{
		return false;
	}
}

///edit lead

public function get_leadbyid($id){
	$this->db->select('*');
	$this->db->from('lead');
	$this->db->where('leadid',$id);
	$query = $this->db->get();
	return $query->result_array(); 
}

 public function Update_Lead($data,$lid){
	 $this->db->where('leadid',$lid);
	 $this->db->update('lead',$data);
	 
	 $s = $this->db->affected_rows();
	 if($s>0){
		 return true;
	 }
 }
 
}
?>