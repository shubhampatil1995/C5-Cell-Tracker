<?php 

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	
	
	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_imeidetails";
	$res_delete = mysqli_query($con, $sql_delete);
	
	$searchstring = $_POST["imei_number"];
	$array_num = explode(',', $searchstring);
	
	$ret=NULL;
	for($i=0; $i<count($array_num); $i++)
	{
		$sql = "SELECT * FROM imei_table WHERE ctac LIKE '%".$array_num[$i]."%' ";
		$res = mysqli_query($con, $sql); //echo $sql; die();
		$cnt = $res->num_rows; //echo $cnt; die();
		if($cnt > 0)
		{
		 	while($row=mysqli_fetch_assoc($res))
		 	{
		 		$ret[0]['nimei_id'] = $row['nimei_id']; 
		 		//$ret[0]['imei_id'] = $row->imei_id;
		 		$ret[0]['ctac'] = $row['ctac'];
		 		$ret[0]['cmodel'] = $row['cmodel'];
		 		$ret[0]['cmake'] = $row['cmake'];
		 		$ret[0]['cbands'] = $row['cbands'];
		 		
		 		$sql_insert = "INSERT INTO temp_imeidetails(timei_id, ttac, tmodel, tmake, tbands) VALUES('".$ret[0]['nimei_id']."', '".$ret[0]['ctac']."', '".$ret[0]['cmodel']."', '".$ret[0]['cmake']."', '".$ret[0]['cbands']."')";  //echo $sql_insert; die();
				mysqli_query($con, $sql_insert); //die();
		 	}
		}
	}
	
	$sql_fetch = "SELECT * FROM temp_imeidetails";
	$res_fetch = mysqli_query($con, $sql_fetch);  //echo $sql_fetch; die();
	$ret1=NULL; $c=0;
	while($row1=mysqli_fetch_assoc($res_fetch))
	{
		$ret1[$c]['tempimei_id'] = $row1['tempimei_id'];
		$ret1[$c]['timei_id'] = $row1['timei_id'];
		$ret1[$c]['ttac'] = $row1['ttac'];
		$ret1[$c]['tmodel'] = $row1['tmodel'];
		$ret1[$c]['tmake'] = $row1['tmake'];
		$ret1[$c]['tbands'] = $row1['tbands'];
		
		$c++;
	}
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;

?>