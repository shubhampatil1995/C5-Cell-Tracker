<?php

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_sdrdetails";
	$res_delete = mysqli_query($con, $sql_delete); 
	 
	$searchstring = $_POST["number"];
	$dummy= $_POST["dummy"];
	$array_num= explode(',', $searchstring);
	//print_r($array_num);
	$ret=NULL;
	for($i=0; $i<count($array_num); $i++)
	{
		$sql = "SELECT * FROM sdr_details WHERE mobileno='".$array_num[$i]."' ";
		$res = mysqli_query($con, $sql); //echo $sql;
		 $cnt = $res->num_rows;
		 if($cnt > 0)
		 {
			while($row=mysqli_fetch_assoc($res))
			{
				 $ret[0]['id'] = $row['id'];
				 $ret[0]['subname'] = $row['subname'];
				$ret[0]['mobileno'] = $row['mobileno'];
				$ret[0]['subaddress'] = $row['subaddress'];
				$ret[0]['doa'] = $row['doa'];
				$ret[0]['sp'] = $row['sp'];
				$ret[0]['circle'] = $row['circle'];
				$ret[0]['previoussp'] = $row['previoussp'];
				$ret[0]['previouscircle'] = $row['previouscircle'];
				$ret[0]['typeofconnection'] = $row['typeofconnection'];
				//$ret[0]['status'] = 'success';
				
				$sql_insert = "INSERT INTO temp_sdrdetails(tsubname, tmobileno, tsubaddress, tdoa, tsp, tcircle, tprevioussp, tpreviouscircle, ttypeofconnection) VALUES('".$ret[0]['subname']."', '".$ret[0]['mobileno']."', '".$ret[0]['subaddress']."', '".$ret[0]['doa']."', '".$ret[0]['sp']."', '".$ret[0]['circle']."', '".$ret[0]['previoussp']."', '".$ret[0]['previouscircle']."', '".$ret[0]['typeofconnection']."')";
				mysqli_query($con, $sql_insert); 
			}
		}else
		{
			$ret[0]['mobileno'] = $array_num[$i];
			//$ret[0]['mydetails'] = 'Not Found';
			
			$sql_insert = "INSERT INTO temp_sdrdetails(tmobileno) VALUES('".$ret[0]['mobileno']."')";
				mysqli_query($con, $sql_insert);
		} 
	} 
	//echo $sql_insert.'<br/>';
	//die();
	$sql_fetch = "SELECT * FROM temp_sdrdetails";
	$res_fetch = mysqli_query($con, $sql_fetch);  //echo $sql_fetch; die();
	$ret1=NULL; $c=0;
	while($row1=mysqli_fetch_assoc($res_fetch))
	{
		
		
		/*$tstatus = $row1['tstatus'];
		if($tstatus == 'success')
		{*/
			$ret1[$c]['temp_id'] = $row1['temp_id'];
			$ret1[$c]['tsubname'] = $row1['tsubname'];
			$ret1[$c]['tmobileno'] = $row1['tmobileno'];
			$ret1[$c]['tsubaddress'] = $row1['tsubaddress'];
			$ret1[$c]['tdoa'] = $row1['tdoa'];
			$ret1[$c]['tsp'] = $row1['tsp'];
			$ret1[$c]['tcircle'] = $row1['tcircle'];
			$ret1[$c]['tprevioussp'] = $row1['tprevioussp'];
			$ret1[$c]['tpreviouscircle'] = $row1['tpreviouscircle'];
			$ret1[$c]['ttypeofconnection'] = $row1['ttypeofconnection'];
			$ret1[$c]['tstatus'] = $row1['tstatus'];
		//}
		/*else
		{
			$ret1[$c]['tmobileno'] = $row1['tmobileno'];
			$ret1[$c]['tstatus'] = $row1['tstatus'];
		}*/
		$c++;
	}
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;
	
?>