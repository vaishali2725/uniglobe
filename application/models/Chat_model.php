<?php Class Chat_model extends CI_Model{
	public function __construct()
		{
			parent::__construct();
			
		}
	
	
   public function chatset($msg,$myid,$fid){
		//
		 $data=array(
		 'to'		=>$fid,
		 'from'		=>$myid,
		 'msg'		=>$msg, 
		 'status'	=>'1', 
		 );
		 
		 //echo json_encode($data);
		$this->db->insert('crm_msg',$data);
		
		$this->db->select('crm_msg.*, user.firstName,user.lastName');
		$this->db->join('user', 'user.userid = crm_msg.from');
		$this->db->from('crm_msg');
		$this->db->where('from',$myid);
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function checkmsg123123($myid){
		
		 /*$this->db->query("SELECT * FROM crm_msg JOIN user ON user.userid = crm_msg.from WHERE crm_msg.to ='".$myid."' AND crm_msg.status ='1'"); */
	
		$this->db->select('*');
		$this->db->from('crm_msg');
		$this->db->join('user','user.userid = crm_msg.from');
		$this->db->where('crm_msg.to',$myid);
		//$this->db->where('from',$fid);
		$this->db->where('crm_msg.status','1');
		$query=$this->db->get();  
		//print_r($query->result_array());
		//return $query->result_array();
		
	 }
	 
		
	 
	 public function checkmsgfid($myid,$fid){
		$this->db->select('*');
		$this->db->from('crm_msg');
		$this->db->where('to',$myid);
		$this->db->where('from',$fid);
		$this->db->where('status',1);
		$query=$this->db->get();
		return $query->num_rows();
	 }
	
	 public function getmsg($myid,$fid){
		$this->db->select('crm_msg.*,user.firstName,user.lastName,user.profilePicture');
		$this->db->join('user', 'user.userid = crm_msg.from');
		$this->db->from('crm_msg');
		$this->db->where('to',$myid);
		$this->db->where('from',$fid);
		$this->db->where('crm_msg.status','1');
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query=$this->db->get();
		return $query->result_array();
	 }
	  public function setstatus($id){
		$data = array(
               'chat_status' => $id,
            );
		
		$this->db->where('userid="'.$this->session->userdata('id').'"');
        $this->db->update('user', $data); 
	 }
	 public function updatemsg($myid,$fid){
		 $data=array(
		 'status'	=>'0', 
		 );
		 $this->db->where('to',$myid);
		 $this->db->where('from',$fid);
         $this->db->update('crm_msg', $data);
	 }
	 public function getusername($fid){
		 $this->db->select('*');
		 $this->db->from('user');
		 $this->db->where('userid=',$fid);
		 $query=$this->db->get();
		return $query->result_array();
	 }
	   public function getm($myid,$fid){
		 $this->db->select('*');
		 $this->db->join('user', 'user.userid = crm_msg.from');
		 $this->db->from('crm_msg');
		 $this->db->where('from="'.$myid.'" and to="'.$fid.'" or from="'.$fid.'" and to="'.$myid.'"');
		 $this->db->order_by('crm_msg.id','asc');
		 $query=$this->db->get();
		return $query->result_array();
	 }
	 public function removemsg($mid){
		 
		 $data = array(
               'status' => 0,
            );
		$this->db->where('to', $mid);
        $this->db->update('crm_msg', $data); 
	 }
	  public function removecurmsg($mid,$fid){
		 
		 $data = array(
               'status' => 0,
            );
		$this->db->where('to="'.$mid.'" and from="'.$fid.'"');
        $this->db->update('crm_msg', $data); 
	 }
	  public function updatemsgmy($myid){
		 $data=array(
		 'status'	=>'0', 
		 );
		 $this->db->where('to',$myid);
         $this->db->update('crm_msg', $data);
	 }
	 public function getuser($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('userid',$id);
		$query=$this->db->get();
		return $query->result_array();
	 }
	 
	 public function gethis($myid,$fid){
		 $this->db->select('crm_msg.*, user.firstName, user.lastName, user.profilePicture');
		
		 $this->db->from('crm_msg');
		 $this->db->join('user', 'user.userid = crm_msg.from');
		// $this->db->where('from',$myid);
		// $this->db->where('to',$fid);
		 $this->db->where('from="'.$myid.'" and to="'.$fid.'" or from="'.$fid.'" and to="'.$myid.'"');
		 $this->db->order_by('crm_msg.id','asc');
		 $query=$this->db->get();
		return $query->result_array();
	 }
	 
	 public function get_userlist(){
		
		 $arrto=array();
		 $arrfrom=array();
	    $this->db->select('to_user');
		$this->db->from('crm_add_contact_friends');
		$this->db->where('from_user="'.$this->session->userdata('id').'"');
		$this->db->where('accept=','1');
		$this->db->where('reject=','0');
		$query=$this->db->get();
		$check=$query->result_array();
		 foreach($check as $row){
			 array_push($arrto,$row['to_user']);
			 
		 }

		 $this->db->select('from_user');
		//$this->db->join('path_user_info', 'path_user_info.user_id = crm_msg.from');
		$this->db->from('crm_add_contact_friends');
		$this->db->where('to_user="'.$this->session->userdata('id').'"');
		$this->db->where('accept=','1');
		$this->db->where('reject=','0');
		$query=$this->db->get();
		$check1=$query->result_array();
		foreach($check1 as $row1){
			 array_push($arrfrom,$row1['from_user']);
		 }
		 $resultarr = array_merge($arrto, $arrfrom);
		 $newarr=array_unique($resultarr);
		 return $newarr;
	 }
	 
	}
?>