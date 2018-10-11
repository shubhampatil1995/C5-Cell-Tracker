<?php 
	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_ipdetails";
	$res_delete = mysqli_query($con, $sql_delete);  
	
	$search_ip = $_POST["ip_address"]; 
	$array_ip   = explode(',', $search_ip);  
	
	/*$search_ip = ((CONVERT(bigint, PARSENAME(T.CalledPhoneNo,1)) + CONVERT(bigint, PARSENAME(T.CalledPhoneNo,2)) * 256 + CONVERT(bigint, PARSENAME(T.CalledPhoneNo,3)) * 65536 + CONVERT(bigint, PARSENAME(T.CalledPhoneNo,4)) * 16777216)); */ // 09.61.175.200
	$ret=NULL;
	for($i=0; $i<count($array_ip); $i++)
	{
		$ips = explode('.', $array_ip[$i]); //print_r($ips); die();
		
		$int_ip = ($ips[3]+($ips[2] * '256')+($ips[1]*'65536')+($ips[0]*'16777216'));   //echo $int_ip; die();
		
		$sql =  "select * from ip_table where '".$int_ip."' BETWEEN cipfromvalue AND ciptovalue"; //echo $sql; die();
		$res = mysqli_query($con, $sql);
		$cnt = $res->num_rows;
		if($cnt > 0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				$ret[0]['nip_id'] = $row['nip_id'];
				$ret[0]['cipfromvalue'] = $row['cipfromvalue'];
				$ret[0]['ciptovalue'] = $row['ciptovalue'];
				$ret[0]['ccountry'] = $row['ccountry'];
				$ret[0]['cispname'] = $row['cispname'];
				$ret[0]['corganizationname'] = $row['corganizationname'];
				
				$insert_query = "INSERT INTO temp_ipdetails(tip_id, tipfromvalue, tiptovalue, tcountry, tispname, torganizationname, tip_address) VALUES('".$ret[0]['nip_id']."', '".$ret[0]['cipfromvalue']."', '".$ret[0]['ciptovalue']."', '".$ret[0]['ccountry']."', '".$ret[0]['cispname']."', '".$ret[0]['corganizationname']."', '".$array_ip[$i]."')";
				mysqli_query($con, $insert_query);
				
			}
		}
	}
	
	$sql_fetch = "SELECT * FROM temp_ipdetails";
	$res_fetch = mysqli_query($con, $sql_fetch);
	$ret1=NULL; $c=0;
	while($row=mysqli_fetch_assoc($res_fetch))
	{
		$ret1[$c]['tempip_id'] = $row['tempip_id'];
		$ret1[$c]['tip_id'] = $row['tip_id'];
		//$ret1[$c]['tipfromvalue'] = $row['tipfromvalue'];
		//$ret1[$c]['tiptovalue'] = $row['tiptovalue'];
		$ret1[$c]['tcountry'] = $row['tcountry'];
		$ret1[$c]['tispname'] = $row['tispname'];
		$ret1[$c]['torganizationname'] = $row['torganizationname'];
		$ret1[$c]['tip_address'] = $row['tip_address'];
		
		$c++;
	}
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;

?>