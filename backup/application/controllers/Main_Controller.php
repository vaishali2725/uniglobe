<?php

class Main_Controller extends CI_Controller {

    public function __construct()
  {
    parent::__construct();
     $this->load->model('Main_Model');
     $this->load->model('Notification');
     $this->load->library('session'); 
      
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
         $password  = $this->input->post('password');
         $user = $this->Main_Model->validate_user($username,$password); 
          if($user=="success"){
              redirect('');
              }else{ 
            $data['message'] = "incorrect username or password";
            $this->load->view('login',$data);
         }
	}
	
	public function forgotPassword(){
	$this->load->view('app');
	}
	public function logout(){
	$this->load->view('login');
	}
	public function getUserInfo(){
	 $user = $this->Main_Model->getUserInfo();
	 echo $json_response = json_encode($user);
	}
	public function getUserTask(){
	 $task = $this->Main_Model->getUserTask();
	 echo $json_response = json_encode($task);
	}
           public function getUsers(){
	   $user = $this->Main_Model->getUser();
         echo $json_response = json_encode($user);
     }
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
	   public function deleteTask(){
	   $taskid = $this->input->GET('taskid');
	   if($this->Main_Model->deleteTask($taskid)){
		   echo "success";
	   }
	}
        public function deleteUser(){
	   $id = $this->input->GET('id');
	   if($this->Main_Model->deleteUser($id)){
		   echo "success";
	   }
	}
	public function addTask(){
	   $task=json_decode($_GET['task']);
	   $taskname = $task->taskName; 
	if($this->Main_Model->addTask($task)){
		 
	   }
	}
        public function addUser(){
            $user=json_decode($_GET['user']);
            $email = $user->email;
            date_default_timezone_set("America/New_York");
            //$user['registerdate'] = date("h:i:sa");
            if($this->Main_Model->addUser($user)){
	     }
         }
         public function addLeads(){
            $leads=json_decode($_GET['leads']);
           //date_default_timezone_set("America/New_York");
            //$user['registerdate'] = date("h:i:sa");
            if($this->Main_Model->leads($leads)){
	     }
         }
         public function getUserName(){
             echo $username = $this->session->userdata('id');
         }
		 public function total_leads(){
   echo $totalLeads = count($this->Main_Model->getTotalLeads($this->session->userdata('id')));
         }
		 public function completed_leads(){
   echo $completedLeads = count($this->Main_Model->getCompletedLeads($this->session->userdata('id')));
         }
		 public function pending_leads(){
   echo $pendingLeads = count($this->Main_Model->getPendingLeads($this->session->userdata('id')));
         }
		 public function getMyLeads(){
   $myLeads = $this->Main_Model->getPendingLeads($this->session->userdata('id'));
   echo $json_response = json_encode($myLeads);
         }
		 
		 public function getLeadById(){
			 $leadid=$_GET['leadid'];
   $data['leadDetails'] = $this->Main_Model->getSingleLead($leadid);
   $data['action'] = $this->Main_Model->getSalesmanAction($leadid);
   echo $json_response = json_encode($data);
   // echo $json_response = json_encode($action);
         } 
         public function getMyProfileInfo(){
       $myProfile = $this->Main_Model->userProfileInfo($this->session->userdata('id'));
      echo $json_response = json_encode($myProfile);
         }
         public function addAction(){
           $actionData=json_decode($_GET['action']);
           if($this->Main_Model->AddAction($actionData)){
            $data['message'] = "Action Added successfully";
            echo $json_response = json_encode($data);
            }

         }
         public function updateUser(){
           $user=json_decode($_GET['user']);
           if($this->Main_Model->updateMyProfile($this->session->userdata('id')))
           {
            $data['message'] = "Profile info updated successfully";
           }else{
            $data['message'] = "Fail to update profile";
           }

         }
         public function addLeadToMyList(){
           $leads=json_decode($_GET['leads']);
           $leads->userid = $this->session->userdata('id');
          if($this->Main_Model->leads($leads)){
          $message = "Lead Added successfully to your task list";
          echo $json_response = json_encode($message);
       }
         }
		 
		 
		 function addReminder(){
	     $reminder=json_decode($_GET['reminder']);
		 $reminder->userid = $this->session->userdata('id');
              $this->Main_Model->addReminder($reminder);
		 }

		  public function getreminders(){
          $getreminders = $this->Main_Model->getReminders($this->session->userdata('id'));
          echo $json_response = json_encode($getreminders);
         }
		 
		 public function deletereminder(){
			$id = $this->input->GET('rid');
	      if($this->Main_Model->deletereminder($id)){
		    return true;
	   }
			 
		 }
}