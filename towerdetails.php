<?php 

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_towerdetails";
	$res_delete = mysqli_query($con, $sql_delete);
	
	$tower_id= $_POST["cell_id"];
	$array_towerids= explode(',', $tower_id);
	$state= $_POST["circle"];
	$service_provider= $_POST["service_provider"];
	$ret=NULL;
	
	for($i=0; $i<count($array_towerids); $i++)
	{
		$sql = "SELECT * FROM tower_details WHERE tower_id LIKE '%".$array_towerids[$i]."%' ";
		if($state != '')
		{
			$sql = $sql. " AND state = '".$state."' " ;
		}
		if($service_provider != '')
		{
			$sql = $sql. " AND service_provider = '".$service_provider."' " ;
		} 
		//echo $sql.'<br/>'; die();
		 $res = mysqli_query($con, $sql);
		 $cnt = $res->num_rows;
		if($cnt > 0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				$ret[0]['tower_slno'] = $row['tower_slno'];
				$ret[0]['tower_id'] = $row['tower_id'];
				$ret[0]['latitude'] = $row['latitude'];
				$ret[0]['longitude'] = $row['longitude'];
				$ret[0]['lower_name'] = $row['lower_name'];
				$ret[0]['address'] = $row['address'];
				$ret[0]['city'] = $row['city'];
				$ret[0]['state'] = $row['state'];
				$ret[0]['service_provider'] = $row['service_provider'];
				$ret[0]['status'] = 'success';
				
				$sql_insert = "INSERT INTO temp_towerdetails(ttower_slno, ttower_id, tlatitude, tlongitude, tlower_name, taddress, tcity, tstate, tservice_provider, tstatus) VALUES('".$ret[0]['tower_slno']."', '".$ret[0]['tower_id']."', '".$ret[0]['latitude']."', '".$ret[0]['longitude']."', '".$ret[0]['lower_name']."', '".$ret[0]['address']."', '".$ret[0]['city']."', '".$ret[0]['state']."', '".$ret[0]['service_provider']."', '".$ret[0]['status']."')";
				mysqli_query($con, $sql_insert);
			}
		}
	}
	
	$sql_fetch = "SELECT * FROM temp_towerdetails";
	$res_fetch = mysqli_query($con, $sql_fetch);  //echo $sql_fetch; die();
	$ret1=NULL; $c=0;
	while($row1=mysqli_fetch_assoc($res_fetch))
	{
		$ret1[$c]['temp_towerid'] = $row1['temp_towerid'];
		$ret1[$c]['ttower_slno'] = $row1['ttower_slno'];
		$ret1[$c]['ttower_id'] = $row1['ttower_id'];
		$ret1[$c]['tlatitude'] = $row1['tlatitude'];
		$ret1[$c]['tlongitude'] = $row1['tlongitude'];
		$ret1[$c]['tlower_name'] = $row1['tlower_name'];
		$ret1[$c]['taddress'] = $row1['taddress'];
		$ret1[$c]['tcity'] = $row1['tcity'];
		$ret1[$c]['tstate'] = $row1['tstate'];
		$ret1[$c]['tservice_provider'] = $row1['tservice_provider'];
		$ret1[$c]['tstatus'] = $row1['tstatus'];
		
		$c++;
		
	}
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;
	


?>