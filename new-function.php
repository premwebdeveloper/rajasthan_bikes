<?php
//send sms to user and rajbike team

function sendSMSCustomer($mobileno,$message){
	$msg=urlencode($message);
	$number=trim($mobileno);
	$url = "http://india.jaipurbulksms.com/api/mt/SendSMS?user=rjbike&password=zapak123&senderid=RJBIKE&channel=Trans&DCS=0&flashsms=0&number=91".$number."&text=".$msg."&route=3";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
	return $curl_scraped_page;

}
function sendOtp($mobile,$otp){
	$msg=urlencode($otp);
	$number=trim($mobile);
	$url = "http://india.jaipurbulksms.com/api/mt/SendSMS?user=rjbike&password=zapak123&senderid=RJBIKE&channel=Trans&DCS=0&flashsms=0&number=91".$number."&text=".$msg."&route=3";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
	return $curl_scraped_page;

}
?>
