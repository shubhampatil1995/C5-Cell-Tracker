<?php 

// 	$mysql_host='localhost';
// 	$mysql_user='prosofte_trazer';
// 	$mysql_password='trazer@2018';	

// 	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");

    $mysql_host='35.200.241.253';
	$mysql_user='root';
	$mysql_password='12345';

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"C5Cell_Tracker");
	
	$name= $_POST['name'];
	$mobile = $_POST['mobile'];
	$email= $_POST['email'];
	$device_no= $_POST['device_no'];
	$token_no= $_POST['token_no'];
	
	
	$validatesql = "SELECT * FROM users_table WHERE mobile='".$mobile."' AND device_no='".$device_no."' ";
	$validateres = mysqli_query($con, $validatesql); 
	
	$cnt = $validateres->num_rows;  //echo $cnt ; die();
	if($cnt > 0)
	{
		$ret['status'] = "Already registered";
	}else
	{
		$insert_sql = "INSERT INTO users_table(name, mobile, email, device_no, token_id) VALUES('".$name."', '".$mobile."', '".$email."', '".$device_no."', '".$token_no."')"; //echo $insert_sql; die();
		$insert_res = mysqli_query($con, $insert_sql);
		if($insert_res)
		{
		    $otp_number = mt_rand(1000, 9999);  //echo $otp_number; die();
    		$message_content = "Your OTP is ".$otp_number;
    		$enc_msg = urlencode($message_content);
    		
    		$mob_number =$ret['mobile'];
    		
    		//$fullapiurl="http://smsc.biz/httpapi/send?username=inamullah.mulla@gmail.com&password=Password1&sender_id=PROMOTIONAL&route=P&phonenumber=$mob_number&message=$enc_msg";
    		
    		$fullapiurl= "https://2factor.in/API/V1/16b43aa4-916d-11e8-a895-0200cd936042/SMS/".$mobile."/".$otp_number."";
					//echo $fullapiurl; die();
					//Call API
					$ch = curl_init($fullapiurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch); 
					//echo $result ; // For Report or Code Check
					curl_close($ch); 
    					
			$ret['status']= $otp_number;
		} 
	}
	$user_data = json_encode($ret); //print_r($user_data); die();
	print $user_data;

?>