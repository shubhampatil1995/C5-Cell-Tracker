<?php 

	$mobile = $_POST['mobile'];
	
	$otp_number = mt_rand(1000, 9999);
	//echo $otp_number;

	$fullapiurl= "https://2factor.in/API/V1/16b43aa4-916d-11e8-a895-0200cd936042/SMS/".$mobile."/".$otp_number."";
	$ch = curl_init($fullapiurl);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch); 
	//echo $result ; // For Report or Code Check
	curl_close($ch);
	
	$ret['status'] = $otp_number;
	
	$user_data = json_encode($ret); //print_r($user_data); die();
	print $user_data;
?>
