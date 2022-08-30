<?php
class Report_Controller extends CI_Controller {

    public function __construct()
  {
    parent::__construct();
		error_reporting(0);
		ob_start();
     $this->load->model('Report_Model');
	 $this->load->model('Chat_model');
     $this->load->model('Notification');
     $this->load->library('session'); 
	 $this->load->library('email');
     $this->load->helper('url');
  }
   public function index()
	{
		
	}
	/**********************Start chat**************************/
	function getusername(){
		
		if($_POST['str']==0){
			$this->session->set_userdata('friend_id' ,$_POST['id']);
		}
		if($_POST['str']==1){
			$this->session->set_userdata('friend_id1' ,$_POST['id']);
		}
		if($_POST['str']==2){
			$this->session->set_userdata('friend_id2' ,$_POST['id']);
		}
		 $id=$_POST['id'];
		 $myid=$_POST['myid'];
		 $rd=$this->Chat_model->getuser($id);
		 
		$new=$this->Chat_model->gethis($myid,$id);
		//print_r($new);
		 foreach($new as $item){
			 
			if($item['from']==$this->session->userdata('id')){
				
				//if($item['status']==1){
				$cl="my_msg";
				//}
			}else{
				$cl="";
			}
			 //print_r($item);
			@$msg .='<div id="2" class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('id')){
			@$msg .='<!--<img src="'.base_url().'upload/profile_pics/'.$item['profilePicture'].'" alt="" width="32" height="32">-->';
			}
			
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time" >'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		}
		echo @$msg.'+'.$rd[0]['firstName']." ".$rd[0]['lastName']." ";
	}
	
	public function chatreq(){
		 if(isset($_GET['rq'])):
	       switch($_GET['rq']):
		    case 'new':
			  $msg = $_POST['msg'];
			  $myid = $_POST['mid'];
			  $fid = $_POST['fid'];
			  
			if(empty($msg)){
				
				$json = array('status' => 0, 'msg'=> 'Enter your message!.');
			}else{
				$sc=$this->Chat_model->chatset($msg,$myid,$fid);
				$json = array('status' => 1, 'msg' => $sc[0]['msg'], 'time' => date('H:i',strtotime($sc[0]['time'])), 'name'=>$sc[0]['firstName']."".$sc[0]['lastName']);
		       echo json_encode($json);
			}
		break;
		case 'msg':
			 $myid = $_POST['mid'];
			//$fid = $_POST['fid'];
			if(empty($myid)){

			}else{
				/* $this->db->select('*');
				$this->db->from('crm_msg');
				$this->db->join('user','user.userid = crm_msg.from');
				$this->db->where('crm_msg.to',$myid);
				
				$this->db->where('crm_msg.status','1');
				$query=$this->db->get();  
				$q=$query->result_array(); */
				
				
				$query = $this->db->query("SELECT * FROM crm_msg JOIN user ON user.userid = crm_msg.from WHERE crm_msg.to ='".$myid."' AND crm_msg.status ='1'");

				$row = $query->row();
				 $r=$row->from;
				$q=$query->num_rows();
				//print_r($query->result());
				//$sc1=$this->Chat_model->checkmsg123123($myid);
				//print_r($q);
					//echo 'Total Results: ' . $q->num_rows();
			   if($q > 0){
				  // echo "aasd";
				 // echo $r;
				   $query1 = $this->db->query("SELECT * FROM crm_msg JOIN user ON user.userid = crm_msg.from WHERE crm_msg.to ='".$myid."' AND crm_msg.from ='". $myid ."' and crm_msg.to='".$r."' or crm_msg.from='". $r ."' and crm_msg.to='".$myid."'");
				   
				  // print_r($query1);
				   	 foreach ($query1->result() as $row1)
					{
						 $r1=$row1->from;
						
						if($r1==$this->session->userdata('id')){
						echo $cl="my_msg";
						}else{
						   echo $cl="";
						  }
							 @$msg .='<div id="1" class="chat-message clearfix '.$cl.'">';
							if($r1!=$this->session->userdata('id')){
								@$msg .='<!--<img src="'.base_url().'upload/profile_pics/'. $row1->profilePicture .'" alt="" width="32" height="32">-->';
							}
							@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($row1->time)).'</span><p>'. $row1->msg .'</p></div></div><hr>'; 
					}
					//echo $r;
					  $query2 = $this->db->query("SELECT * FROM user where userid='".$r."'");
					// print_r($query2->result());
					  foreach($query2->result() as $row2)
					{
						//echo $row2->firstName;
						//echo $row2->lastName;
						//echo $r;
						
						echo $msg.'+'.@$row2->firstName .' '.@$row2->lastName .'+'.$r;
					}
					//$this->db->query("update crm_msg set status='0' where to='".$myid."'");
				 	  /*  if($this->db->query("update crm_msg set status='0' where crm_msg.to='".$myid."'")){
						    echo "work";
					  }else{
						   echo " not work";
					  }   */
					
					
			   }
			   // $new=$this->Chat_model->gethis($myid,$r);
				
				//$json = array('status' => 1, 'msg' => $sc1[0]['msg'], 'time' => date('H:i',strtotime($sc1[0]['time'])), 'name'=>$sc1[0]['fname']."".$sc1[0]['lname'],'profile_pic'=>$sc1[0]['profile_pic'],'to'=>$sc1[0]['from']);
				//echo json_encode($json);
				 /*foreach($query1 as $item){
					if($item['from']==$this->session->userdata('id')){
				     $cl="my_msg";
			      }else{
				   $cl="";
			      }
				  
			@$msg .='<div id="1" class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('id')){
			@$msg .='<!--<img src="'.base_url().'upload/profile_pics/'.$item['profilePicture'].'" alt="" width="32" height="32">-->';
			}
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		   }
		    $user=$this->Chat_model->getuser($sc1[0]['from']);
		  echo $msg.'+'.@$user[0]['firstName'].' '.@$user[0]['lastName'].'+'.$sc1[0]['from'];
			$sc5=$this->chat_model->updatemsgmy($myid);
			} */
			}
	  break;
	  case 'msgfid':
			$myid = $_POST['mid'];
			$fid = $_POST['fid'];
			if(empty($myid)){

			}else{
				$sc4=$this->Chat_model->checkmsgfid($myid,$fid);
				if($sc4 > 0){
					$json = array('status' => 1);
				 }else{
					$json = array('status' => 0);
				 }
				
				echo json_encode($json);
			}
	  break;
	  case 'NewMsg':
			$myid = $_POST['mid'];
			$fid = $_POST['fid'];
			//$json=$myid.",".$fid;
			$sc2=$this->Chat_model->getmsg($myid,$fid);
			$json = array('status' => 1, 'msg' => $sc2[0]['msg'],'time' => date('H:i',strtotime($sc2[0]['time'])), 'name'=>$sc2[0]['firstName']."".$sc2[0]['lastName'],'profilePicture'=>$sc2[0]['profilePicture']);
			echo json_encode($json);
		
			// update status
			$sc3=$this->Chat_model->updatemsg($myid,$fid);
			
		break;
	endswitch;
endif; 
		
	}
	function getall(){
		$mid=$_POST['mid'];
		$fid=$_POST['fid'];
		//echo $fid;
		$um=$this->Chat_model->getusername($fid);
		$mg=$this->Chat_model->getm($mid,$fid);
		foreach($mg as $item){
		@$msg .='<div class="'.(($item['from']==$mid)?'mymsg':'yourmsg').'"><!--<img src="'.base_url().'upload/profile_pics/'.$item['profilePicture'].'" alt="" width="32" height="32">--><small>'.date('d-m-Y H:i',strtotime($item['time'])).'</small><a href="#" class="msg_online_user">'.$item['firstName'].'&nbsp;'.$item['lastName'].'</a><p>'.$item['msg'].'</p></div>';
		}
		
		echo @$msg.'+'.$um[0]['firstName'].'&nbsp;'.$um[0]['lastName'];
	}
	function sendmsg(){
		$msg=$_POST['msgtxt'];
		$mid=$_POST['mid'];
		$fid=$_POST['fid'];
		$rs=$this->Message_model->insertmsg($msg,$mid,$fid);
		@$msg1 .='<div class="'.(($rs[0]['from']==$mid)?'mymsg':'yourmsg').'"><!--<img src="'.base_url().'upload/profile_pics/'.$rs[0]['profilePicture'].'" alt="" width="32" height="32">--><small>'.date('d-m-Y H:i',strtotime($rs[0]['time'])).'</small><a href="#" class="msg_online_user">'.$rs[0]['firstName'].'&nbsp;'.$rs[0]['lastName'].'</a><p>'.$rs[0]['msg'].'</p></div>';
		
		echo $msg1;
	}
		function removestatus(){
		$mid=$_POST['mid'];
		$rs1=$this->Chat_model->removemsg($mid);
	}
	function removecurrentstatus(){
		$mid=$_POST['mid'];
		$fid=$_POST['fid'];
		$rs2=$this->Chat_model->removecurmsg($mid,$fid);
	}

	function changestatus(){
		$id=$_POST['id'];
		$this->Chat_model->setstatus($id);
	}
	
	
	//Search 
	
	function searchuser(){
		$lst="";
		$txt=$_POST['txt'];
		$newarr=$this->Chat_model->get_userlist();

		foreach($newarr as $row2){ 
			   $this->db->select('*');
			   $this->db->from('user');
			   
			   $this->db->where('firstName like "'.$txt.'%"');
			  // $this->db->where('status=',1);
			   $query=$this->db->get();
		       $users=$query->result_array();
			   if(count($users)>0){
				   
				  $lst .='<li class="chat-user clearfix" onclick="getchatnew('.$this->session->userdata('id').','.$row2.')"><a href="#">'; 
					 if(!empty($users[0]['profilePicture']))
						{
					
						$lst .='<!--<img src="'.base_url().'/upload/profile_pics/'.$users[0]['profilePicture'].'" alt="" width="32" height="32" />-->'; 
					 
			}  
						$lst .='<div class="chat-message-content clearfix">

							<h5 class="chat-usr-name">'.$users[0]['firstName']." ".$users[0]['lastName'].'</h5>
						</div>
					</a>

				</li>';
				   
			   }
		}
			   echo @$lst;
		
	    
	}
	
	function gethistory(){
		$mid=$_POST['mid'];
		$fid=$_POST['fid'];
		$new=$this->Chat_model->gethis($mid,$fid);
		$user=$this->Chat_model->getuser($fid);
		
		foreach($new as $item){
			if($item['from']==$this->session->userdata('id')){
				$cl="my_msg";
			}else{
				$cl="";
			}
			@$msg .='<div class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('id')){
			@$msg .='<!--<img src="'.base_url().'upload/profile_pics/'.$item['profilePicture'].'" alt="" width="32" height="32">-->';
			}
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		}
		echo @$msg.'+'.@$user[0]['firstName'].' '.@$user[0]['lastName'].' ';
	}
	
	function closewind(){
		$id=$_POST['id'];
		if($id==1){
			$this->session->unset_userdata('friend_id');
		}
		if($id==2){
			$this->session->unset_userdata('friend_id1');
		}
		if($id==3){
			$this->session->unset_userdata('friend_id2');
		}
		
	}
	/**********************end chat**************************/	
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
	$link = base_url()."Report_Controller/changepassword/".$id;
		$this->email->from('patilvaishali366@gmail.com', 'vaishali patil');
        $this->email->to($email); 
        $this->email->subject('Reset Password');
        $this->email->message($link);	
        $this->email->send();
		
		$linkmsg['msg']="The link to reset password has been sent to your mail";
		
		$this->load->view('login',$linkmsg);
      
	}else{
		$linkmsg['msg']="This mail id doesn't exist in database";
		$this->load->view('login',$linkmsg);
	}
}	

public function changepassword($id){
	echo $id;
	$data=array(
		 'id'=>$id
		  );
	$this->load->view('resetpwd',$data);
}

public function updatepassword(){
	$u_id=$this->input->POST('u_id');
	$newpassword=$this->input->POST('newpassword');
	if($this->Report_Model->updatepassword($u_id,$newpassword)){
		$msg['messsage']="successfully changed password..login now";
		$this->load->view('login',$msg);
	}
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

public function getleadsby_status(){
	$userid=$this->input->GET('user');
	$status=$this->input->GET('status');
	$data = $this->Report_Model->getleadsby_status($userid,$status);
	echo $json_response = json_encode($data);
}

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
	
//all leads functions
public function get_pending_leads(){
	
	$lead_id=$this->Report_Model->get_lead_id();
	
	$p_leads=$this->Report_Model->get_pending_leads($lead_id);
	
	echo $json_response = json_encode($p_leads);
}	

public function get_unass_leads(){
	$unass_leads=$this->Report_Model->get_unass_leads();
	echo $json_response = json_encode($unass_leads);
}
public function get_closed_leads(){
	$p_leads=$this->Report_Model->get_closed_leads();
	echo $json_response = json_encode($p_leads);
}




public function leaderBoard()
{
  //$leaderb = $this->new_Model->leaderboard();
 // $leaderb1 = $this->new_Model->leaderboard1();
  $leader = $this->Report_Model->leaderboard();
  $leaderb1 = $this->Report_Model->leaderboard1();
  $closed_leads = $this->Report_Model->get_closed_leadsid();
  $leaderb2 = $this->Report_Model->leaderboard2($closed_leads);
  $size = sizeOf($leader);
 
  foreach($leaderb2 as $led)
  {
	  
	  $l[]=$led['p_count'];
	  $a[]=$led['userid'];
  }
  
 if(sizeOf($leader)!=sizeOf($l)){
	 for($j=sizeOf($l);$j<$size;$j++){
		 $l[$j]=0;
	 }
 }
 
  $result = array();
  for($i=0; $i<$size; $i++){
	  $result[$i]['userid'] = $leader[$i]['userid'];
	  $result[$i]['firstName'] = $leader[$i]['firstName'];
	  $result[$i]['lastName'] = $leader[$i]['lastName'];
	  $result[$i]['userstatus'] = $leader[$i]['userstatus'];
	  $result[$i]['total_leads'] = $leader[$i]['lead_count'];
	  $result[$i]['leadid'] = $leaderb1[$i]['leadid'];
	  $result[$i]['complete_lead'] = $leaderb1[$i]['status_count'];
      $result[$i]['pending_lead'] =  $leader[$i]['lead_count'] - $leaderb1[$i]['status_count'];;
	 /*  for($s=$i;$s<sizeOf($leaderb2);$s++){
		  if($result[$i]['userid']==$leaderb2[$s]['userid']){
			  $result[$i]['pending_lead']=$l[$s];
		  }
	  } */
	  
	}
	
	usort($result, function($a, $b) {
    return $a['complete_lead'] <= $b['complete_lead'];
});
   echo $json_response = json_encode($result);
}

	
	
//admin -  delete leads
public function deleteleads(){
	$ldata = json_decode($_GET['ldata']);
	if($this->Report_Model->deleteleads($ldata)){
			return true;
	}

}	
	public function checkmsg77(){
	
	$sc1=$this->Chat_model->checkmsg7();
	print_r($sc1)	;	
	}

	
	

//check lead availability	
public function checkleadavailability(){
	$email = $this->input->GET('email');
	if($this->Report_Model->checkleadavailability($email)){
		echo 1;
	}else{
		echo 0;
	}
}

//edit lead

public function get_leadbyid(){
	$id=$this->input->GET('id');
	$data = $this->Report_Model->get_leadbyid($id);
	
	$s = array();
	$ap = array();
	foreach($data as $d){
	    $s[]=explode(" ",$d['phone']); 
		$ap[]=explode(" ",$d['altphone']); 
	}
	
    $data[0]['phone'] = $s[0][2];
	$data[0]['altphone'] = $ap[0][2];
	
   echo $json_response = json_encode($data);
}
	
public function Update_Lead(){
    $data = json_decode($_GET['l_data']);
    $lid = $this->input->GET('lid');
	$c = $this->input->GET('code');
	$p = $data->phone;
	$ap = $data->altphone;
	
	 $data->phone ="+".$c." ".$p;
	 $data->altphone ="+".$c." ".$ap;
		  unset($user->code);
	
	if($this->Report_Model->Update_Lead($data,$lid)){
		echo 1;
	}
	
}	
	
}	



?>