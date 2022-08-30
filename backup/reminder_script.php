<?php

$conn= mysql_connect('theaxontech.com','theax7fd','$^EpH$Xq+@5*') or die('connection error');
mysql_select_db('theax7fd_crm')or die('database error');

$query="SELECT * FROM reminder ";
$res=mysql_query($query);
while($row=mysql_fetch_assoc($res)){
     $date = date('Y-m-d H:i:s');
	 $rem = $row['reminderDate']."".$row['reminderTime'];
	 echo '<br/>';
     $seconds = abs(strtotime($date) - strtotime($rem));
	 echo date_default_timezone_get();
     echo $days    = floor($seconds / 86400); echo '<br/>';
     echo $hours   = floor(($seconds - ($days * 86400)) / 3600);
     //$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
     //$seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));
	 if($days==0 && $hours<=2){
		echo $uid=$row['userid'];
		 $sql="SELECT * FROM user WHERE userid='$uid'";
		 $r=mysql_query($sql);
		 $udata=mysql_fetch_array($r);
	     $mailid = $udata['useremail'];
		 $to = $mailid;
         $subject = $row['reminderTitle'];
         $message = "you have to ".$row['action']." to ".$row['client_name']." at ".$row['reminderTime']." on ".$row['reminderDate']."";
         $from = "admin(CRM)";
         $headers = "From:" . $from;
         $s = mail($to,$subject,$message,$headers); 
		 
	 }
}

?> 
