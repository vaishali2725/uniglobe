<?php

$conn= mysql_connect('localhost','root','') or die('connection error');
mysql_select_db('crm')or die('database error');

$query="SELECT * FROM reminder";
$res=mysql_query($query);
$r=mysql_fetch_assoc($res);
print_r($r);
while($row=mysql_fetch_assoc($res)){
	echo $date = date('Y-m-d H:i:s');
	
	$rem=$row['reminderDate']."".$row['reminderTime'];
	
	echo $seconds = abs(strtotime($date) - strtotime($rem));
}

/*$seconds = abs(strtotime("2010-10-20 08:10:00") - strtotime("2008-12-13 10:42:00"));
$years   = floor($seconds / (365*60*60*24));

 $days    = floor($seconds / 86400);
 $hours   = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
 $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));*/

 

$to = "patilvaishali366@gmail.com";
$subject = "hi";
$message = "helloo";
$from = "vaishu21p@gmail.com";
$headers = "From:" . $from;

$s = mail($to,$subject,$message,$headers);
if($s){
	echo "Mail Sent.";
}
else{
	echo "error";
}
?> 
