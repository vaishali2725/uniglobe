
<?php
$seconds = abs(strtotime("2010-10-20 08:10:00") - strtotime("2008-12-13 10:42:00"));

$years   = floor($seconds / (365*60*60*24));

 $days    = floor($seconds - ($years * (365*60*60*24)) / 86400);
 $hours   = floor(($seconds - ($days * 86400)) / 3600);
$minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
 $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));

 echo $years."years".$months."months".$days."days".$hours."hours".$minutes."minutes".$seconds."seconds";

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
