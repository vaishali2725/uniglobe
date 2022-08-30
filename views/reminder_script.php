<?php

$conn= mysql_connect('theaxontech.com','theax7fd','uCh;X{Z8d)[E') or die('connection error');
mysql_select_db('theax7fd_crmlive')or die('database error');

//$query="SELECT * FROM reminder ";
$query="SELECT * FROM reminder JOIN user ON user.userid=reminder.userid";
$res=mysql_query($query);

//$res1="DELETE FROM reminder WHERE rem_days=0 AND rem_hours=0";
	// mysql_query($res1);


while($row=mysql_fetch_assoc($res)){
	  //date_default_timezone_set('Asia/Calcutta');
	   $t = $row['timez'];
	 echo date_default_timezone_set('London');	 
    $date = date('Y-m-d H:i:s');
	echo $rem = $row['reminderDate'];
	
	 echo '<br/>';
	 if($rem<$date){
	   $days=0;
	   $hours=0;
	 }else{
	    $seconds = abs(strtotime($date) - strtotime($rem));
        $days    = floor($seconds / 86400); echo '<br/>';
        $hours   = floor(($seconds - ($days * 86400)) / 3600);
		$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
	 }
	 
	 $q="UPDATE reminder SET rem_days='$days',rem_hours='$hours',rem_minutes='$minutes' WHERE R_id='$row[R_id]'";
	 mysql_query($q);
     //$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
     //$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
	 if($days==0 && $hours<=2){
		 $uid=$row['userid'];
		 $sql="SELECT * FROM user WHERE userid='$uid'";
		 $r=mysql_query($sql);
		 $udata=mysql_fetch_array($r);
	     //$mailid = $udata['useremail'];
		 $mailid ="patilvaishali366@gmail.com";
		 $to = $mailid;
         $subject = $row['reminderTitle'];
         $message = "you have to ".$row['action']." to ".$row['client_name']." at ".$row['reminderTime']." on ".$row['reminderDate']."";
         $from = "admin(CRM)";
         $headers = "From:" . $from;
        // $s = mail($to,$subject,$message,$headers); 
     	 
	 }
}

?> 
