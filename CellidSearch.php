<?php

$towerid= $_POST["cell_id"];
$array_towerids= explode(',', $towerid);

$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if($conn){
	echo "Connected";
}
echo $cell_id;die();


	$sql_delete = "DELETE FROM temp_towerdetails";
	$res_delete = sqlsrv_query($conn,$sql_delete);



	
	//404-49-58002-100
	//towerid_original
	for($i=0; $i<count($array_towerids); $i++)
	{
		$sql = "SELECT DISTINCT * FROM towers_details WHERE towerid_original LIKE '%".$array_towerids[$i]."%' ";
		$getResults = sqlsrv_query($conn, $sql); //print_r($res); die();//echo $sql; die()
		$cnt = $getResults->num_rows;
		$c=0;$ret=NULL;
		if($cnt > 0)
		{
			while($row=sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
			{
		
				$ret[$c]['spmasterid'] = $row['spmasterid'];
				$ret[$c]['spcirclemasterid'] = $row['spcirclemasterid'];
				$ret[$c]['towerid'] = $row['towerid'];
				$ret[$c]['towerid_original'] = $row['towerid_original'];
				$ret[$c]['towername'] = $row['towername'];
				$ret[$c]['towerName_original'] = $row['towerName_original'];
				$ret[$c]['latitude'] = $row['latitude'];
				$ret[$c]['longitude'] = $row['longitude'];
				$ret[$c]['geopoints'] = $row['geopoints'];
				$ret[$c]['address1'] = $row['address1'];
				$ret[$c]['address2'] = $row['address2'];
				$ret[$c]['towercity'] = $row['towercity'];
				$ret[$c]['towerstate'] = $row['towerstate'];
				$ret[$c]['towercountry'] = $row['towercountry'];
				$ret[$c]['azimuth'] = $row['azimuth'];
				$ret[$c]['msc_name'] = $row['msc_name'];
				$ret[$c]['mcc'] = $row['mcc'];
				$ret[$c]['mnc'] = $row['mnc'];
				$ret[$c]['lac'] = $row['lac'];
				$ret[$c]['requiredzeros'] = $row['requiredzeros'];
				$ret[$c]['spname'] = $row['serviceprovidername'];
				$ret[$c]['cellid'] = $row['cellid'];
				$ret[$c]['place'] = $row['place'];
				
				
				 $sql_insert = "INSERT INTO temp_towerdetails(tspmasterid, tspcirclemasterid, ttowerid, ttowerid_original, ttowername, ttowerName_original, tlatitude, tlongitude, tgeopoints, taddress1, taddress2, ttowercity, ttowerstate, ttowercountry, tazimuth, tmsc_name, tmcc, tmnc, tlac, trequiredzeros, tserviceprovidername, tcellid, tplace) VALUES
				 ('".$ret[$c]['spmasterid']."', '".$ret[$c]['spcirclemasterid']."', '".$ret[$c]['towerid']."', '".$ret[$c]['towerid_original']."', '".$ret[$c]['towername']."', '".$ret[$c]['towerName_original']."', '".$ret[$c]['latitude']."', '".$ret[$c]['longitude']."', '".$ret[$c]['geopoints']."', '".$ret[$c]['address1']."', '".$ret[$c]['address2']."', '".$ret[$c]['towercity']."', '".$ret[$c]['towerstate']."', '".$ret[$c]['towercountry']."', '".$ret[$c]['azimuth']."', '".$ret[$c]['msc_name']."', '".$ret[$c]['mcc']."', '".$ret[$c]['mnc']."', '".$ret[$c]['lac']."', '".$ret[$c]['requiredzeros']."', '".$ret[$c]['serviceprovidername']."', '".$ret[$c]['cellid']."', '".$ret[$c]['place']."')";
				
				
				$res_insert = sqlsrv_query($conn,$sql_insert); //echo $sql_insert; die();
				
				$c++; 
			}//die();
		}
		
		$sql_fetch = "SELECT * FROM temp_towerdetails";
		$res_fetch = sqlsrv_query($conn, $sql_fetch);//  echo $sql_fetch; die();
		$cnt_fetch = $res_fetch->num_rows;
		$ret1=NULL; $i=0;  
		if($cnt_fetch > 0)
		{
    		while($row1=sqlsrv_fetch_array($res_fetch, SQLSRV_FETCH_ASSOC))
    		{

    			$ret1[$i]['towerid_original'] = $row1['ttowerid_original'];
    			$ret1[$i]['towername'] = $row1['ttowername'];
    			$ret1[$i]['latitude'] = $row1['tlatitude'];
    			$ret1[$i]['longitude'] = $row1['tlongitude'];
    			$ret1[$i]['address1'] = $row1['taddress1'];
    			$ret1[$i]['address2'] = $row1['taddress2'];
    			$ret1[$i]['towercity'] = $row1['ttowercity'];
    			$ret1[$i]['towerstate'] = $row1['ttowerstate'];
    			$ret1[$i]['towercountry'] = $row1['ttowercountry'];
    			$ret1[$i]['azimuth'] = $row1['tazimuth'];
    			$ret1[$i]['spname'] = $row1['tserviceprovidername];
    			$i++;
    		}
		}
	}
	
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;
?>
