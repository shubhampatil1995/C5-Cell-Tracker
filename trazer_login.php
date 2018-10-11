<?php 
	//echo "validateuser.php"; die();
// 	$mysql_host='localhost';
// 	$mysql_user='prosofte_trazer';
// 	$mysql_password='trazer@2018';	

// 	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");

    $mysql_host='35.200.241.253';
	$mysql_user='root';
	$mysql_password='12345';

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"C5Cell_Tracker");

	
	$mobile = $_POST['mobile'];  //echo 'hello'.$mobile; die();
	$device_no = $_POST['device_no'];
	
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
    					    
    					   //print_r($ret); //return;
    					 	
    		        //$fullapiurl="http://smsc.biz/httpapi/send?username=inamullah.mulla@gmail.com&password=Password1&sender_id=PROMOTIONAL&route=P&phonenumber=$mob_number&message=$enc_msg";
    		        
    		        //	$fullapiurl= "https://2factor.in/API/V1/16b43aa4-916d-11e8-a895-0200cd936042/SMS/".$mob_number."/".$otp_number."";
    		        	
    		        	//echo $fullapiurl; //die();
				
					//echo $fullapiurl; die();
					//Call API
					$ch = curl_init($fullapiurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$result = curl_exec($ch); 
					//echo $result ; // For Report or Code Check
					curl_close($ch);	
    					 	
    					 	
    					 	// old function starts
    					 /* $mobileNumber = urlencode($ret['mobile']);
		                $message = urlencode($message_content);		
					$url = 'http://smsc.biz/httpapi/send?username=inamullah.mulla@gmail.com&password=Password1&sender_id=PROMOTIONAL&route=P&phonenumber='.$mobileNumber.'&message='.$message.'';
                
					 //echo "url = ".$url; die();
						 $ch = curl_init();
					         curl_setopt_array($ch, array(
						 CURLOPT_URL => $url,
						 CURLOPT_RETURNTRANSFER => true,
						CURLOPT_POST => true
					//,CURLOPT_POSTFIELDS => $postData
							//,CURLOPT_FOLLOWLOCATION => true
					));
					
					curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					//echo "<h2>Ignoring certificate...<h2>";
					
					//get response
					//echo "<h2>Curl executing...<h2>";
					$output = curl_exec($ch);
					$info = curl_getinfo($ch);
					//echo "<h2>"; print_r($info); echo "<h2>";
							
					
					//Print error if any
					if (curl_errno($ch)) 
					{
						//$messageStatus .= "<h2>Curl not executed.........<h2>";
						$messageStatus .= "Error...= ". curl_error($ch)."<br/>";
						$messageStatus .= "<h4>Message = ". $output. "<h4><br/>";
						
					}
					
					curl_close($ch); */
							
								
			
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