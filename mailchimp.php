<?php 

$apikey = '826cf1f4ee1d188072717023aacb1b85-us13';
$listID = '5da9c68b7a';
$email  = "patilvaishali366@gmail.com";
$fields = array('apikey' => urlencode($apikey), 'id' => urlencode($listID), 'email_address' => urlencode($email), 'output' => 'json' );
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }

rtrim($fields_string, '&');
$url = 'https://us13.api.mailchimp.com/2.0/lists/subscribe';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
$data = curl_exec($ch);

$arr = json_decode($data, true);
print_r($arr);
curl_close($ch);
if ($arr == 1) {
    echo 'Check now your e-mail and confirm your subsciption.';
} else {
                    echo $arr['code'];
    switch ($arr['code']) {
        case 214:
        echo 'You are already subscribed.';
        break;
        // check the MailChimp API for more options
        default:
        echo 'Unkown error...';
        break;          
    }
}

?>