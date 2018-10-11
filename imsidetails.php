<?php 

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	
	
	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_imsidetails";
	$res_delete = mysqli_query($con, $sql_delete);
	
	$searchstring = $_POST["imsi_number"];
	$array_num = explode(',', $searchstring);
	
	$ret=NULL;
	for($i=0; $i<count($array_num); $i++)
	{
		$sql = "SELECT * FROM imsi_table WHERE cmcc LIKE '%".$array_num[$i]."%' ";
		$res = mysqli_query($con, $sql); //echo $sql; die();
		$cnt = $res->num_rows; //echo $cnt; die();
		if($cnt > 0)
		{
		 	while($row=mysqli_fetch_assoc($res))
		 	{
		 		$ret[0]['nimsi_id'] = $row['nimsi_id']; 
		 		//$ret[0]['imei_id'] = $row->imei_id;
		 		$ret[0]['cmcc'] = $row['cmcc'];
		 		$ret[0]['cmccr'] = $row['cmccr'];
		 		$ret[0]['cspname'] = $row['cspname'];
		 		$ret[0]['cspstate'] = $row['cspstate'];
		 		
		 		$sql_insert = "INSERT INTO temp_imsidetails(timsi_id, tmcc, tmmr, tspname, tspstate) VALUES('".$ret[0]['nimsi_id']."', '".$ret[0]['cmcc']."', '".$ret[0]['cmccr']."', '".$ret[0]['cspname']."', '".$ret[0]['cspstate']."')";  //echo $sql_insert; die();
				mysqli_query($con, $sql_insert); //die();
		 	}
		}
	}
	
	$sql_fetch = "SELECT * FROM temp_imsidetails";
	$res_fetch = mysqli_query($con, $sql_fetch);  //echo $sql_fetch; die();
	$ret1=NULL; $c=0;
	while($row1=mysqli_fetch_assoc($res_fetch))
	{
		$ret1[$c]['tempimsi_id'] = $row1['tempimsi_id'];
		$ret1[$c]['timsi_id'] = $row1['timsi_id'];
		$ret1[$c]['tmcc'] = $row1['tmcc'];
		$ret1[$c]['tmmr'] = $row1['tmmr'];
		$ret1[$c]['tspname'] = $row1['tspname'];
		$ret1[$c]['tspstate'] = $row1['tspstate'];
		
		$c++;
	}
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;

?>