<!DOCTYPE html>


<?php

$mysql_host='localhost';
$mysql_user='prosofte_trazer';
$mysql_password='trazer@2018';	

$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer);

if(isset($_POST['save'])){
			
			//echo 'hello';
			//die();
			$Name= $_POST['username'];
			$Mobile= $_POST['mobile'];
			$Email= $_POST['emailid'];
			
			$sql = "INSERT INTO users_table (name,mobile,email) VALUES ('$Name','$Mobile','$Email')";
			
			
		
			if(mysqli_query($con,$sql)){
		
				
				$username = "anaghakatageri@gmail.com";
				$hash = "0aa756befeadec7c78361bfb33fb647065324f0cc0f1af3d9cada8d3a2534730";

				// Config variables. Consult http://api.textlocal.in/docs for more info.
				$test = "0";

				// Data for text message. This is the text message data.
				$sender = "TXTLCL"; // This is who the message appears to be from.
				$numbers = $Mobile; // A single number or a comma-seperated list of numbers
				//$encode_message = encrypt('http://localhost/trazer/validateuser.php');  //used for encryption
				
				$encode_message = 'prosoft@123 http://developersworld.co.in/trazer/validateuser.php';  //echo $encode_message; die();
				
				//$decode_message = decrypt($encode_message);
				
				
				//echo $encode_message.'==='.$decode_message; die();
				// 612 chars or less
				// A single number or a comma-seperated list of numbers
				 $message = urlencode($encode_message);
				$data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
				$ch = curl_init('http://api.textlocal.in/send/?');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($ch); // This is the result from the API
				if($result)
				{
					echo '<script type="text/javascript">alert("Message Sent");</script>';
				}
				curl_close($ch); 
				
				
				
			}
			else{
				//echo "not inserted";
				echo '<script type="text/javascript">alert("Message Not Sent");</script>';
				
			}
			
			
		}
?>

<html lang="en">
<head>
  <title>Trazer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="styles.css">
 
</head>
<body>
	<div class="container">
		<img src="img/student.png">
		</img>
		
		<form action="#" method="POST">
			<div class="form-input">
				<input type="text" name="username" placeholder="Enter Username">
			</div>
			<div>
				<input type="text" name="mobile" placeholder="Enter Mobile Number">
			</div>
			<div>
				<input type="text" name="emailid" placeholder="Enter Email ID">
			</div>
			<button class="btn btn-block btn-success" type="submit" name="save" href="#" value="Register">
				Register
			
			</button>
		</form>
	
	</div>
</body>
</html>



