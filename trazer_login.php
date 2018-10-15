<?php 

$mobile = $_POST['mobile'];  //echo 'hello'.$mobile; die();
$device_no = $_POST['device_no'];

$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
	
$validatemobile_sql = "SELECT * FROM users_table WHERE mobile='".$mobile."' "; // AND device_no='".$device_no."'
$validatemobile_res = mysqli_query($con, $validatemobile_sql); // echo $validatemobile_sql; die();
$cnt = $validatemobile_res->num_rows; 
	if($cnt > 0)
	{
			$validatedevice_sql = "SELECT * FROM users_table WHERE mobile='".$mobile."' AND device_no='".$device_no."' ";
			$validatedevice_res = mysqli_query($con, $validatedevice_sql);
			$cnt1 = $validatedevice_res->num_rows; 
			if($cnt1 > 0)
			{
				while($row=mysqli_fetch_assoc($validatemobile_res))
				{
					
					$otp_number = mt_rand(1000, 9999);  //echo $otp_number; die();
    				$message_content = "Your OTP is ".$otp_number;
    				$enc_msg = urlencode($message_content);
    					
    					//echo "otp_number = ".$otp_number;
    					
    				$ret['id'] = $row['id'];
					$ret['name'] = $row['name'];
					$ret['mobile'] = $row['mobile'];
					$ret['email'] = $row['email'];
					$ret['status'] = $otp_number; 
    					    	
    			    		$mob_number = $ret['mobile'];
    					
					//Call API
					$ch = curl_init($fullapiurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch); 
					//echo $result ; // For Report or Code Check
					curl_close($ch);	
    					 								
			
			}
			}else
			{
				$ret['status'] = 'Incorrect device';  
			}
		
	}
	else
	{
				//$ret[0]['status'] = 'Incorrect device';
				$ret['status'] = 'Unregistered';  //Incorrect device
	}	
	
	$user_data = json_encode($ret); //print_r($user_data); die();
	print $user_data;
	//return $user_data;
?>
