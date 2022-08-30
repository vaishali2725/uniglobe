<?php

class Report_Controller extends CI_Controller {

    public function __construct()
  {
    parent::__construct();
     $this->load->model('Report_Model');
     $this->load->model('Notification');
     $this->load->library('session'); 
	 $this->load->library('email');
     $this->load->helper('url');
  }
   public function index()
	{
		
	}
	
	
	
	
	public function deactivate_User(){
		$id=$this->input->GET('id');
	
		$userstatus=0;
		$newdata=array(
		 'userstatus'=>$userstatus
		  );
		if($this->Report_Model->deactivate_user($id,$newdata)){
			return true;
		}
	}
	
	public function activate_user(){
		$id=$this->input->GET('id');
		
		$userstatus=1;
		$newdata=array(
		 'userstatus'=>$userstatus
		  );
		if($this->Report_Model->activate_user($id,$newdata)){
			return true;
		}
	}
	
	
	
//forgot password functions

public function forgotPassword(){
	$config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html'; // or html
        $config['validation']   = true; 
        $this->email->initialize($config);
		
	$email=$this->input->POST('email');
	if($data = $this->Report_Model->forgotPassword($email)){
		$id = $data[0]['userid'];
	$link = base_url()."changepassword?id=".$id;
 
		$this->email->from('patilvaishali366@gmail.com', 'vaishali patil');
        $this->email->to('patilvaishali366@gmail.com'); 
        $this->email->subject('Reset Password');
        $this->email->message($link);	
        $this->email->send();
	}
}	

public function changepassword(){
   echo $id = $this->input->get['id'];
	$data=array(
		 'id'=>$id
		  );
	//$this->load->view('resetpwd',$data);
}

public function updatepassword(){
	$newpassword=$this->input->POST('newpassword');
}
	
// View Report	
	
	
	public function get_ComLeads(){
		$data=$this->Report_Model->get_ComLeads();
		echo $json_response = json_encode($data);
	}
	
	public function get_callbkLeads(){
		$data=$this->Report_Model->get_callbkLeads();
		echo $json_response = json_encode($data);
	}
	public function get_callbk_leads(){
		$c_leads=$this->Report_Model->get_callbk_leads();
		echo $json_response = json_encode($c_leads);
	}
	public function get_selecteduser_leads(){
		$id=$this->input->GET('u_id');
		$selected_user_leads=$this->Report_Model->get_selecteduser_leads($id);
		echo $json_response = json_encode($selected_user_leads);
	}
	public function get_followup_leads(){
		$id=$this->input->GET('u_id');
		$selected_user_clbk_leads=$this->Report_Model->get_followup_leads($id);
		echo $json_response = json_encode($selected_user_clbk_leads);
	}
	public function getall_leads_ofselecteduser(){
		$id=$this->input->GET('u_id');
		$s=$this->Report_Model->get_selected_user_all_leads($id);
		echo $json_response = json_encode($s);
	}
	public function get_firstcall_leads(){
		$id=$this->input->GET('u_id');
		$s=$this->Report_Model->get_firstcall_leads($id);
		echo $json_response = json_encode($s);
	}
	
	//grid demo
 
	
	 public function get_selecteduser_data(){
		$id=$this->input->GET('u_id');
		$s=$this->Report_Model->get_sel_userdata($id);
		echo $json_response = json_encode($s);
    }






//new_report functions start


public function getallleads(){
	$allleads = $this->Report_Model->get_all_leads();
	echo $json_response = json_encode($allleads);
}

public function get_leads(){
	
	 $u_id=$this->input->GET('u_id');
      $status=$this->input->GET('status');
     $sel_date1=$this->input->GET('sel_date1');
	   $sel_date2=$this->input->GET('sel_date2');
     $data = $this->Report_Model->get_leads($u_id,$status,$sel_date1,$sel_date2);
     echo $json_response = json_encode($data);
	 
}

public function get_last_month_leads(){
	 $u_id=$this->input->GET('u_id');
     $status=$this->input->GET('status');
	 $data = $this->Report_Model->get_lastmonth_leads($u_id,$status);
	echo $json_response = json_encode($data);
}

public function get_last_week_leads(){
	 $u_id=$this->input->GET('u_id');
     $status=$this->input->GET('status');
	 $data = $this->Report_Model->get_last_week_leads($u_id,$status);
	echo $json_response = json_encode($data);
}

public function get_leads_bydate(){
	$u_id=$this->input->GET('u_id');
	$status=$this->input->GET('status');
	$sel_date=$this->input->GET('sel_date');
	$data = $this->Report_Model->get_leads_bydate($u_id,$status,$sel_date);
	echo $json_response = json_encode($data);
}
	
	

		
//calender
public function add_reminder(){
	$title=$this->input->GET('title');
    $s_date=$this->input->GET('s_date');
    $ctime=$this->input->GET('ctime');
	
	$combinedDT = date('Y-m-d H:i:s', strtotime("$s_date $ctime"));

	$this->Report_Model->add_reminder($title,$combinedDT);
}


//end calender		
	
	
	
	
}	



?>