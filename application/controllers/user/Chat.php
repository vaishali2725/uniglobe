<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		error_reporting(0);
		ob_start();
		
        if(!$this->session->has_userdata('user')){
			 redirect('login');
		 
		
		}
	$this->load->model('user/chat_model');
				
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
				$sc=$this->chat_model->chatset($msg,$myid,$fid);
				$json = array('status' => 1, 'msg' => $sc[0]['msg'], 'time' => date('H:i',strtotime($sc[0]['time'])), 'name'=>$sc[0]['fname']."".$sc[0]['lname'],'profile_pic'=>$sc[0]['profile_pic']);
		       echo json_encode($json);
			}
		break;
		case 'msg':
			$myid = $_POST['mid'];
			//$fid = $_POST['fid'];
			if(empty($myid)){

			}else{
				$sc1=$this->chat_model->checkmsg($myid);
			   if(count($sc1)>0){
			    $new=$this->chat_model->gethis($myid,$sc1[0]['from']);
				//print_r($new);
				//$json = array('status' => 1, 'msg' => $sc1[0]['msg'], 'time' => date('H:i',strtotime($sc1[0]['time'])), 'name'=>$sc1[0]['fname']."".$sc1[0]['lname'],'profile_pic'=>$sc1[0]['profile_pic'],'to'=>$sc1[0]['from']);
				//echo json_encode($json);
				foreach($new as $item){
					if($item['from']==$this->session->userdata('user')['user_id']){
				     $cl="my_msg";
			      }else{
				   $cl="";
			      }
			@$msg .='<div class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('user')['user_id']){
			@$msg .='<img src="'.base_url().'uploads/user_profile/'.$item['profile_pic'].'" alt="" width="32" height="32">';
			}
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		   }
		    $user=$this->chat_model->getuser($sc1[0]['from']);
		    echo $msg.'+'.@$user[0]['fname'].' '.@$user[0]['lname'].'+'.$sc1[0]['from'];
			//$sc5=$this->chat_model->updatemsgmy($myid);
			}
			}
	  break;
	  case 'msgfid':
			$myid = $_POST['mid'];
			$fid = $_POST['fid'];
			if(empty($myid)){

			}else{
				$sc4=$this->chat_model->checkmsgfid($myid,$fid);
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
           $sc2=$this->chat_model->getmsg($myid,$fid);
			
			$json = array('status' => 1, 'msg' => $sc2[0]['msg'],'time' => date('H:i',strtotime($sc2[0]['time'])), 'name'=>$sc2[0]['fname']."".$sc2[0]['lname'],'profile_pic'=>$sc2[0]['profile_pic']);
			echo json_encode($json);
			// update status
			$sc3=$this->chat_model->updatemsg($myid,$fid);
			
		break;
	endswitch;
endif;
		
	}
	
	function getusername(){
		echo "sadsad";
		/*if($_POST['str']==0){
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
		$rd=$this->chat_model->getuser($id);
		if($rd[0]['guru']==100){
			
			$lg='<img width="20" height="20" class="guru_chat" alt="" src="'.base_url().'img/guru-badge.png">';
		}
		$new=$this->chat_model->gethis($myid,$id);
		foreach($new as $item){
			if($item['from']==$this->session->userdata('user')['user_id']){
				$cl="my_msg";
			}else{
				$cl="";
			}
			 //print_r($item);
			@$msg .='<div class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('user')['user_id']){
			@$msg .='<img src="'.base_url().'uploads/user_profile/'.$item['profile_pic'].'" alt="" width="32" height="32">';
			}
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		}
		echo @$msg.'+'.$rd[0]['fname']." ".$rd[0]['lname']." ".$lg;*/
	}
	
	function gethistory(){
		$mid=$_POST['mid'];
		$fid=$_POST['fid'];
		$new=$this->chat_model->gethis($mid,$fid);
		$user=$this->chat_model->getuser($fid);
		if($user[0]['guru']==100){
			
			$lg='<img width="20" height="20" class="guru_chat" alt="" src="'.base_url().'img/guru-badge.png">';
		}
		foreach($new as $item){
			if($item['from']==$this->session->userdata('user')['user_id']){
				$cl="my_msg";
			}else{
				$cl="";
			}
			@$msg .='<div class="chat-message clearfix '.$cl.'">';
			if($item['from']!=$this->session->userdata('user')['user_id']){
			@$msg .='<img src="'.base_url().'uploads/user_profile/'.$item['profile_pic'].'" alt="" width="32" height="32">';
			}
			@$msg .='<div class="chat-message-content clearfix"><span class="chat-time">'.date('H:i',strtotime($item['time'])).'</span><p>'.$item['msg'].'</p></div></div><hr>';
		}
		echo @$msg.'+'.@$user[0]['fname'].' '.@$user[0]['lname'].'  '.$lg.'+'.$fid;
	}
	
	function searchuser(){
		$lst="";
		$txt=$_POST['txt'];
		$newarr=$this->chat_model->get_userlist();
		foreach($newarr as $row2){ 
			   $this->db->select('*');
			   $this->db->from('path_user_info');
			   $this->db->where('user_id="'.$row2.'"');
			   $this->db->where('fname like "'.$txt.'%"');
			  // $this->db->where('status=',1);
			   $query=$this->db->get();
		       $users=$query->result_array();
			   if(count($users)>0){
				   
				  $lst .='<li class="chat-user clearfix" onclick="getchatnew('.$this->session->userdata('user')['user_id'].','.$row2.')"><a href="#">'; 
					 if(!empty($users[0]['profile_pic']))
						{
					
						$lst .='<img src="'.base_url().'/uploads/user_profile/'.$users[0]['profile_pic'].'" alt="" width="32" height="32" />'; 
					 
			}else
			{
				if($users[0]['gender'] == "Male")
				{
				
					$lst .='<img src="'.base_url().'img/user-icon.png" width="32" height="32">';
			
				}
				else
				{
					
					$lst .='<img src="'.base_url().'img/women_user.png" width="32" height="32">';
					
				}
			} 
						$lst .='<div class="chat-message-content clearfix">

							<h5 class="chat-usr-name">'.$users[0]['fname']." ".$users[0]['lname'].'</h5>
						</div>
					</a>

				</li>';
				   
			   }
		}
			   echo @$lst;
		
	    
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
	
}
?>