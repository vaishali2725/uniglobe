<?php

class Main_Controller extends CI_Controller {

    public function __construct()
  {
    parent::__construct();
     $this->load->model('Main_Model');
     $this->load->model('Notification');
     $this->load->library('session');
     $this->load->helper('date');	 
      
  }
   public function index()
	{
       if( $this->session->userdata('isLoggedIn') && $this->session->userdata('role') == "admin" ) {
       $this->load->view('admin');     
       }elseif ($this->session->userdata('isLoggedIn') && $this->session->userdata('role') == "user"){
		   $this->load->view('user');  
	    }else{
       $this->load->view('login');   
       }
    }
	
	public function userLogin(){
	     $username = $this->input->post('username');
         $password  = md5($this->input->post('password'));
         $user = $this->Main_Model->validate_user($username,$password); 
          if($user=="success"){
		   $this->Main_Model->update_user($username,$password); 
              redirect('');
              }else{ 
            $data['message'] = "incorrect username or password";
            $this->load->view('login',$data);
         }
	}
	public function userLogout()
	{
		$this->Main_Model->update_chat_status($this->session->userdata('id'));
		$this->session->sess_destroy();
		$this->load->view('login');
	}
	
	public function forgotPassword(){
	$this->load->view('app');
	}
	public function logout(){
	//$this->load->view('login');
	}
	
public function get_leadcounts_by_status(){
	  $data = $this->Main_Model->get_leadcounts_by_status();
	   echo $json_response = json_encode($data);
}	

 public function addUser(){
        $user=json_decode($_GET['user']);
		$c = $user->countrycode;
	    $p = $user->userphone;
		echo $user->userphone ="+".$c." ".$p;
		unset($user->countrycode);
		  
		$filename=$this->input->GET('filename');
		$user->profilePicture = $filename;
		 $user->userstatus=1;
		$user->role="user";
		$user->password=md5($user->password);
	 
		$this->Main_Model->addUser($user);
		 
}	

//admin - All USER	

 public function getUsers(){
	   $user = $this->Main_Model->getUser();
    echo $json_response = json_encode($user);
 }	
	
public function deleteUser(){
	   $id = $this->input->GET('id');
	   if($this->Main_Model->deleteUser($id)){
		   echo "success";
	   }
}	
public function archive_lead(){
	   $id = $this->input->GET('id');
	   $archive = $this->input->GET('archive');
	 echo $this->Main_Model->archive_lead($id,$archive);
}

	
//user activation and deactivation 	  
		  
public function deactivate_User(){
            $id=$this->input->GET('id');
	
		$userstatus=0;
		$newdata=array(
		 'userstatus'=>$userstatus
		  );
		if($this->Main_Model->deactivate_user($id,$newdata)){
			return true;
		}
}
		  
public function activate_User(){
		$id=$this->input->GET('id');
		
		$userstatus=1;
		$newdata=array(
		 'userstatus'=>$userstatus
		  );
		if($this->Main_Model->activate_user($id,$newdata)){
			return true;
		}
}
		  	
//Create Lead	
	

//All Leads
public function getLeads(){
	     $leads = $this->Main_Model->getLeads();
         echo $json_response = json_encode($leads);
}
public function deleteLead(){
	   $id = $this->input->GET('id');
	   if($this->Main_Model->deleteLead($id)){
		   echo "success";
	   }
}


public function addLeads(){
            $leads=json_decode($_GET['leads']);
			echo $leads->country;
			$c = $leads->countrycode;
		    $p = $leads->phone;
		    $ap = $leads->altphone;
			
			
		   $leads->phone ="+".$c." ".$p;
		   $leads->altphone ="+".$c." ".$ap;
		   
		    $country = $leads->country->name;
          
		  $leads->country = $country;
		   
		  unset($leads->countrycode);
		
            if($this->Main_Model->leads($leads)){
				
	     }
}	

//USER Functions 

 public function addLeadToMyList(){
           $leads=json_decode($_GET['leads']);
		   $c = $leads->countrycode;
		   $p = $leads->phone;
		 
		    $ap = $leads->altphone;
			
		   $leads->phone ="+".$c." ".$p;
		   $leads->altphone ="+".$c." ".$ap;
		  unset($leads->countrycode);
		  
		 $country = $leads->country->name;
          
		  $leads->country = $country;
		  
          $leads->userid = $this->session->userdata('id');
          $this->Main_Model->leads($leads);
       echo $json_response = json_encode($message);
			
}

public function change_password(){
	$pwd = $this->input->get('pwd');
	$userid = $this->session->userdata('id');
	echo $this->Main_Model->change_password($pwd,$userid);
}
public function delete_lead(){
	echo $lid = $this->input->get('id');
	$this->Main_Model->delete_lead($lid);
}
	
	
	
	
	public function getUserInfo(){
	 $user = $this->Main_Model->getUserInfo();
	 echo $json_response = json_encode($user);
	}
	public function getUserTask(){
	 $task = $this->Main_Model->getUserTask();
	 echo $json_response = json_encode($task);
	}
 
  
  

  
	   
	  
	public function editLead()
	{
		$id=$this->input->GET('id');
		$leaddata = $this->Main_Model->editLead($id);
		echo $json_response = json_encode($leaddata);
		
	}
	
	public function updateLead()
	{
		
		$leadupdatedata = $this->Main_Model->updateLead();
		echo $json_response = json_encode($leadupdatedata);
		
	}
	
	
	public function transferLead()
	{
		//console.log(leaddata.selectedItems);
		$transfer=json_decode($_GET['transfer']);
		$newuser=json_decode($_GET['newuser']);
	    $user = $newuser->updateuserid;
		
		foreach($transfer as $tr)
		{
			 $data['leadid'] = $tr->leadid;
			 $data['userid'] = $user;
			 $l=$tr->leadid;
			 $u=$tr->userid;
		     $this->Main_Model->transferLead($data);
			 $this->Main_Model->transferLeadactions($data);
			 $this->Main_Model->remove_reminders($l,$u);
		}
			  
		 
		
	}
	public function updateData()
	{
		$change=json_decode($_GET['change']);
	
		$updateData = $this->Main_Model->updateData($change);
		echo $json_response = json_encode($updateData);
	}
	   public function deleteTask(){
	   $taskid = $this->input->GET('taskid');
	   if($this->Main_Model->deleteTask($taskid)){
		   echo "success";
	   }
	}
       
	public function addTask(){
	   $task=json_decode($_GET['task']);
	   $taskname = $task->taskName; 
	if($this->Main_Model->addTask($task)){
		 
	   }
	}
       
         
         public function getUserName(){
             echo $username = $this->session->userdata('id');
         }
		 
		 
public function total_leads(){
   echo $totalLeads = count($this->Main_Model->getTotalLeads($this->session->userdata('id')));
   return $totalLeads;
}
public function completed_leads(){
   echo $completedLeads = count($this->Main_Model->getCompletedLeads($this->session->userdata('id')));
}
public function pending_leads(){
	$totalLeads = count($this->Main_Model->getTotalLeads($this->session->userdata('id')));
	
	$completedLeads = count($this->Main_Model->getCompletedLeads($this->session->userdata('id')));
	
   echo $pendingLeads = $totalLeads - $completedLeads;
}
		 
public function getMyLeads(){
       /* $myLeads = $this->Main_Model->getTotalLeads($this->session->userdata('id'));
      echo $json_response = json_encode($myLeads); */
	  
	  
	  $lead_id=$this->Main_Model->get_lead_id();
	
	$p_leads=$this->Main_Model->get_pending_leads($lead_id);
	
	echo $json_response = json_encode($p_leads);
 }
	
public function getCloseLeads(){
       $closeLeads = $this->Main_Model->getCompletedLeads($this->session->userdata('id'));
      echo $json_response = json_encode($closeLeads);
 }

	
		 public function getLeadById(){
			 $leadid=$_GET['leadid'];
   $data['leadDetails'] = $this->Main_Model->getSingleLead($leadid);
   $data['action'] = $this->Main_Model->getSalesmanAction($leadid);
   echo $json_response = json_encode($data);
  
         } 
         public function getMyProfileInfo(){
       $myProfile = $this->Main_Model->userProfileInfo($this->session->userdata('id'));
      echo $json_response = json_encode($myProfile);
         }
		 
		 
		 
    /************************add lead action time zone*************************/
         public function addAction(){
          /*  $actionData=json_decode($_GET['action']);
		   
           $actionData->userid = $this->session->userdata('id');
	      
          $timezone=$this->Main_Model->gettimezone();
		  print_r($timezone);
			 echo $id=$this->session->userdata('id');
			 foreach($timezone as $t)
			{
	          echo $tm=$t['timez'];
			}  
			echo "hello";
			$dat=$actionData->appointmentDate;
			$arr = explode(' ',trim($dat));
            $dat1=$arr[0]; 
			$datec=$actionData->appointmentDate;
			$datec=date_default_timezone_set();
			
      
			$datetime = new DateTime($datec);
		   $datetime->format('Y-m-d H:i:s') . "\n";
		  $la_time = new DateTimeZone($tm);
			$datetime->setTimezone($la_time);
			$datecon=$datetime->format('H:i:s');
			
		$datetime=$dat1." ".$datecon;
			  
			  $actionData->appointmentDate = $datetime;
			
		 	 
		   if($actionData->next_action=="Close_Lead"){
			   $actionData->appointmentDate =$datetime;
		   } 
		   $actionData->action_date =$datetime;
           if($actionData->next_action!=""){
			   
			   $reminder->leadid = $actionData->leadid;
		       $c_name = $this->Main_Model->getclientname($reminder->leadid);
			 
			   $reminder->userid = $this->session->userdata('id');
			   $reminder->client_name =$c_name[0]['clientName'];
			   $reminder->reminderTitle = $actionData->next_action;
			   $reminder->reminderDate = $datetime;
			   $reminder->action = $actionData->next_action;
			   $reminder->description = $actionData->action_des;
			   if($reminder->action!='Close_Lead'){
				   $this->Main_Model->addReminder($reminder);
			   } 
			   
			   
		   }
		   
		 
           if($this->Main_Model->AddAction($actionData)){
			   
			   
            $data['message'] = "Action Added successfully";
            echo $json_response = json_encode($data);
            }
           */ $actionData=json_decode($_GET['action']);
           $actionData->userid = $this->session->userdata('id');
		   date_default_timezone_set('United Kingdom');
		   
	       $actionData->action_date = date('Y-m-d h:i',now());
	
             
		   if($actionData->next_action=="Close_Lead"){
			   $actionData->appointmentDate = date("Y-m-d h:i",now());
		   }	
		   
           if($actionData->next_action !="" && $actionData->appointmentDate !="" ){
			   
			   $reminder->leadid = $actionData->leadid;
		       $c_name = $this->Main_Model->getclientname($reminder->leadid);
			 
			   $reminder->userid = $this->session->userdata('id');
			   $reminder->client_name =$c_name[0]['clientName'];
			   $reminder->reminderTitle = $actionData->next_action;
			   $reminder->reminderDate = $actionData->appointmentDate;
			   $reminder->action = $actionData->next_action;
			   $reminder->description = $actionData->action_des;
			   $this->Main_Model->addReminder($reminder);
		   }
		 
           if($this->Main_Model->AddAction($actionData)){
            $data['message'] = "Action Added successfully";
            echo $json_response = json_encode($data);
            }

         }
		 
/**************************end lead time zone***********************************/
		 
		 public function viewlead_action($id){
			$data=$this->Main_Model->get_lead_action($id);
			echo $json_response = json_encode($data);
		 }
		
		 
		 
		 
         public function updateUser(){
           $user=json_decode($_GET['user']);
           if($this->Main_Model->updateMyProfile($user))
           {
            $data['message'] = "Profile info updated successfully";
           }else{
            $data['message'] = "Fail to update profile";
           }

         }
		 
        
		 
		 
		function addReminder(){
			//date_default_timezone_set('UTC');
			
	        $reminder=json_decode($_GET['reminder']);
		     $str = $reminder->client_name;
			 $ctime= $this->input->GET('ctime');
			 $cparts= explode(' ' , $ctime);
             $c_time = $cparts[0];
			 $date = date('Y-m-d',NOW());
		     $cur_date = $date.' '.$c_time;
			 
			  $reminder->Remaining_Time = $cur_date;  
			
			
			//$timezone=$this->Main_Model->gettimezone();
			/* foreach($timezone as $t)
			{
	           echo $tm=$t['timez'];
			} 
			
		 $dat=$reminder->reminderDate;
			$arr = explode(' ',trim($dat));
            $dat1=$arr[0]; 
			$datec=$reminder->reminderDate;
			date_default_timezone_set($tm);
      
			$datetime = new DateTime($datec);
		     $datetime->format('Y-m-d H:i:s') . "\n";
			$la_time = new DateTimeZone($tm);
			$datetime->setTimezone($la_time);
			$datecon=$datetime->format('H:i:s');
			$datetime=$dat1." ".$datecon;*/
			
			
                      			
            $parts = explode("-", $str);
            $client_name = $parts[0];
            $leadid = $parts[1];
			  
			
		    $reminder->userid = $this->session->userdata('id');
			$reminder->client_name = $client_name;
			$reminder->leadid = $leadid;
			//$reminder->reminderDate=$datetime;
               if($this->Main_Model->addReminder($reminder)){
				 
			     // $message = "Reminder set successfully ";
			     /// echo $json_response = json_encode($message);
				  	
				//  $status = 'Add Reminder';
		        //$this->Main_Model->activity_log($status);
				  
				  
			 }
		 }
		 
		 

		  public function getreminders(){
          $getreminders = $this->Main_Model->getReminders($this->session->userdata('id'));
          echo $json_response = json_encode($getreminders);
         }
		 
		 public function get_todays_reminders(){
			 $res = array();
            $getreminders = $this->Main_Model->getReminders($this->session->userdata('id'));
			for($i=0;$i<count($getreminders);$i++){
				$d = explode(' ' , $getreminders[$i]['reminderDate']);
				if($d[0] == date('Y-m-d')){
					$getreminders[$i]['rdate'] = $d[0];
					$getreminders[$i]['rtime'] = $d[1];
					array_push($res , $getreminders[$i]);
				}
			}
            echo $json_response = json_encode($res);
         }
		 
		 public function get_data_to_edit(){
		 $id = $this->input->GET('rid');
          $get_data = $this->Main_Model->get_data_rem($id);
          echo $json_response = json_encode($get_data);
         }
		 
		 public function update_remind(){
		    $r_id = $this->input->GET('rid');
            $r_data=json_decode($_GET['r_data']);
			$this->Main_Model->update_rem($r_id,$r_data);
		 }
		 
		 
		 public function deletereminder(){
			$id = $this->input->GET('rid');
	      if($this->Main_Model->deletereminder($id)){
		    return true;
			$status = 'Delete Reminder';
		    $this->Main_Model->activity_log($status);
	     }
			 
		 }
	
	  public function get_pwd(){
		  $input_pwd=$this->input->GET('c_pwd');
		  $cur_pwd = $this->Main_Model->get_cur_pwd($input_pwd);
          if($cur_pwd){
			  return true;
		  }
		  else{
			  return false;
		  }
		}
	
		 
		public function changePassword(){
		   $pwd = $this->input->GET('newpwd');
			if($this->Main_Model->change_pwd($pwd)){
              return true;
			}
			
		}
		
		
		  public function getPendingLeads(){
			 $pendingLeads = $this->Main_Model->getPendingLeads($this->session->userdata('id'));
			  echo $json_response = json_encode($pendingLeads);
			  
		  }
		  
	
		  
public function get_user_target(){
	$user_target=$this->Main_Model->get_user_target();
	
	
	foreach($user_target as $t){
	 $s[]= count($this->Main_Model->get_targetuser_comleads($t['userid']));
	  //array_push($targets,$s);
	 
	 //echo $s[];
	 // $targets['comleadcount'] = $s;
	 }
	$result=array();
	$size=sizeOf($user_target);
	for($i=0;$i<$size;$i++)
	{
		
		 $result[$i]['userid'] = $user_target[$i]['userid'];
	  $result[$i]['target'] = $user_target[$i]['target'];
	  
	  $result[$i]['startdate'] = $user_target[$i]['startdate'];
	  $result[$i]['enddate'] = $user_target[$i]['enddate'];
	  $result[$i]['count'] = $s[$i];
		
	}
	
	 echo $json_response = json_encode($result);
	 
	 
	 
}		  
		  

//Dashboard 

 
public function get_all_users(){
	$user_list = $this->Main_Model->get_all_users();
	 echo $json_response = json_encode($user_list);
} 
		  
public function get_leadcounts_per_user(){
	$res = $this->Main_Model->get_leadcounts_per_user();
	echo $json_response = json_encode($res);
}		

public function get_myleads(){
	$myleads = $this->Main_Model->get_myleads();
	echo $json_response = json_encode($myleads);
}

public function getUpcomingReminders(){
  $upcomming = $this->Main_Model->upcommingReminder();
  echo $json_response = json_encode($upcomming);
}
  
public function reminder_Action()
{
	$id=json_decode($_GET['id']);
	echo $id;
}	



//csv upload functions start	
	public function insert_csv_data(){
		
		 $data=json_decode($_GET['newdata']);
	     $array = array();
        $array = $data;
		$count = sizeof($data);
		$r_count = 0;
        foreach($array as $key =>$value){ 
		
		   if($this->Main_Model->checkmail($array[$key]->email)){
		 
          $data1 = array(
                        // 'userid' => $array[$key]->userid,
						'email' => $array[$key]->email,
						'clientName' => $array[$key]->clientName,
						'altemail' => $array[$key]->altemail,
						'phone' => $array[$key]->phone,
						//'altphone' => $array[$key]->altphone,
						//'city' => $array[$key]->city,
						'country' => $array[$key]->country,
						'status' => $array[$key]->status,
						'source' => $array[$key]->source,
						//'accountNumber' => $array[$key]->accountNumber,
						'clientType' => $array[$key]->clientType,
						
                          );  
		  				
		    $data= $this->Main_Model->insert_csv_data($data1);
			$r_count = $r_count + 1;
		   }
		}
		
	echo $existedrecord_count = $count - $r_count;
		
	}
public function get_userid(){
	$name=$this->input->GET['name'];
	$uid=$this->Main_Model->get_userid($name);
	 echo $json_response = json_encode($uid);
}
//csv upload functions end		
  
  public function getLeadActionsById(){
	  $leadid=$this->input->GET('leadid');
	  $actions = $this->Main_Model->get_leads_actions($leadid);
	  echo $json_response = json_encode($actions);
  }
  
  
//target fuctions
public function get_selected_user_leads(){
	$id=$this->input->GET('u_id');
	$count=count($this->Main_Model->get_selected_user_leads($id));
	echo $count;	
}
  public function set_target(){
	  $data=json_decode($_GET['t']);
	  $id=$data->userid;
	 $user_target=$this->Main_Model->check_target($id);
	  $target = $user_target[0]['target'];
	  if($target!=''){
		 $user_completed_leads =count($this->Main_Model->completedleadsofuser($id));
		// print_r($user_completed_leads);
	     if($user_completed_leads>=$target){
		    $data1 = $this->Main_Model->transfer_completed_target($id);
			if($this->Main_Model->set_target_inhistory($data1[0],$id)){
			   $this->Main_Model->set_target($data,$id);
			  // echo $json_response = json_encode($data);
			echo 1;
			}
	     }else{
			 echo 0;
		 }

		  
	  }else{
		   $this->Main_Model->set_target($data,$id);
		  echo 1;
	  }
	  
  }
  public function disTargets()
{
	$targets=$this->Main_Model->gettargets();
     $tar=$targets;
	
foreach($targets as $t){
	 $s[]= count($this->Main_Model->get_targetuser_comleads($t['userid']));
	  //array_push($targets,$s);
	 
	 //echo $s[];
	 // $targets['comleadcount'] = $s;
	 } 
	 $result = array();
	 $size = sizeOf($targets);
	  for($i=0; $i<$size; $i++){
	  $result[$i]['userid'] = $targets[$i]['userid'];
	  $result[$i]['target'] = $targets[$i]['target'];
	   $result[$i]['firstName'] = $targets[$i]['firstName'];
	     $result[$i]['lastName'] = $targets[$i]['lastName'];
	  $result[$i]['startdate'] = $targets[$i]['startdate'];
	  $result[$i]['enddate'] = $targets[$i]['enddate'];
	  $result[$i]['count'] = $s[$i];
	  
	}
/* $object = new stdClass();
$object->name = "My name";
$targets[] = $object;
 */
	echo $json_response = json_encode($result);
	
}

/************User Status Online-Offline**************************/
public function userstatus()
{
  $status = $this->Main_Model->userstatus();
  echo $json_response = json_encode($status);
}

/************************end User Stauts*************************/



public function getAllleads()
{
	
	  $allleads = $this->Main_Model->getAllleads($this->session->userdata('id'));
      echo $json_response = json_encode($allleads);
	
}

//edit user
public function get_userinfo(){
	$id=$this->input->GET('id');
	$data = $this->Main_Model->get_userinfo($id);
	echo $json_response = json_encode($data);
}	
public function Update_User(){
	$udata = json_decode($_GET['u_data']);
	 $id = $this->input->GET('id');
	$this->Main_Model->Update_User1($udata,$id);
 }
 
 public function upload_file(){
	 $fname = $_FILES["file"]["name"];
	 if(!empty($fname)){
		  $target_dir = "./upload/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 
	 
	 $this->Main_Model->updateprofile($fname);
	 }
	
 }
 
 public function add_profile_picture(){

		  $target_dir = "./upload/";
     $name = $_POST['name'];
     print_r($_FILES);
     $target_file = $target_dir . basename($_FILES["file"]["name"]);

     move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	 

}


//reminder
public function get_upcoming_reminders(){
	 $getreminders = $this->Main_Model->get_upcoming_reminders($this->session->userdata('id'));
     echo $json_response = json_encode($getreminders);
}
public function get_past_reminders(){
	 $getpastreminders = $this->Main_Model->get_past_reminders($this->session->userdata('id'));
     echo $json_response = json_encode($getpastreminders);
}

}