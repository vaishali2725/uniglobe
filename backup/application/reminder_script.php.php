<?php

mysqli_connect('localhost','root','');
mysqli_select_db('crm');

$query="SELECT * FROM reminder";
$res=mysqli_query($query);
foreach($res as $r){
	echo $today=new date();
	$rem=$r->reminderDate."".$r->reminderTime;
	echo $seconds = abs(strtotime($today) - strtotime($rem));
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
