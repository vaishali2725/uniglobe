 <?php

$conn= mysql_connect('localhost','root','') or die('connection error');
mysql_select_db('crmlive')or die('database error');

$query="SELECT * FROM reminder ";
$res=mysql_query($query);

 
//$res1="DELETE FROM reminder WHERE rem_days=0 AND rem_hours=0";
	// mysql_query($res1);

 $somevar = $_GET["n"];
 $cparts= explode(' ' , $somevar);
 $c_time = $cparts[0];
 $date = date('Y-m-d');
 echo $cur_date = $date.' '.$c_time;


while($row=mysql_fetch_assoc($res)){

	 $rem = $row['reminderDate'];
	 echo '<br/>';
	 if($rem<$cur_date){
	   $days=0;
	   $hours=0;
	 }else{
	    $seconds = abs(strtotime($cur_date) - strtotime($rem));
        $days    = floor($seconds / 86400); echo '<br/>';
        $hours   = floor(($seconds - ($days * 86400)) / 3600);
	 }

    
	 
	 $q="UPDATE reminder SET rem_days='$days',rem_hours='$hours' WHERE R_id='$row[R_id]'";
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
<script>
    var d = new Date();
    var n = d.toTimeString();
  window.location.href="reminder_script.php?n="+n;
</script>