<?php 

 	//$mysql_host='localhost';
 	//$mysql_user='prosofte_trazer';
 //	$mysql_password='trazer@2018';

    $mysql_host='35.200.241.253';
	$mysql_user='root';
	$mysql_password='12345';

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"C5Cell_Tracker");
//	print_r($con); die();
	
	$towerid= $_POST["cell_id"];
	$array_towerids= explode(',', $towerid);


	$sql_delete = "DELETE FROM temp_towerdetails";
	$res_delete = mysqli_query($con,$sql_delete);
	
	//404-49-58002-100
	//towerid_original
	for($i=0; $i<count($array_towerids); $i++)
	{
		$sql = "SELECT DISTINCT * FROM towers_details WHERE towerid_original LIKE '%".$array_towerids[$i]."%' ";
		$res = mysqli_query($con, $sql); //print_r($res); die();//echo $sql; die()
		$cnt = $res->num_rows;
		$c=0;$ret=NULL;
		if($cnt > 0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				// $ret[$c]['sptowersid'] = $row['sptowersid'];
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
				$ret[$c]['spnameid'] = $row['spnameid'];
				$ret[$c]['cellid'] = $row['cellid'];
				$ret[$c]['place'] = $row['place'];
				$ret[$c]['cgi'] = $row['cgi'];
				$ret[$c]['lac_cellid'] = $row['lac_cellid'];
				
				//print_r($ret); die();
				// $sql_insert = "INSERT INTO temp_towerdetails(tsptowersid, tspmasterid, tspcirclemasterid, ttowerid, ttowerid_original, ttowername, ttowerName_original, tlatitude, tlongitude, tgeopoints, taddress1, taddress2, ttowercity, ttowerstate, ttowercountry, tazimuth, tmsc_name, tmcc, tmnc, tlac, trequiredzeros, tspnameid, tcellid, tplace, tcgi, tlac_cellid) VALUES
				// ('".$ret[$c]['sptowersid']."', '".$ret[$c]['spmasterid']."', '".$ret[$c]['spcirclemasterid']."', '".$ret[$c]['towerid']."', '".$ret[$c]['towerid_original']."', '".$ret[$c]['towername']."', '".$ret[$c]['towerName_original']."', '".$ret[$c]['latitude']."', '".$ret[$c]['longitude']."', '".$ret[$c]['geopoints']."', '".$ret[$c]['address1']."', '".$ret[$c]['address2']."', '".$ret[$c]['towercity']."', '".$ret[$c]['towerstate']."', '".$ret[$c]['towercountry']."', '".$ret[$c]['azimuth']."', '".$ret[$c]['msc_name']."', '".$ret[$c]['mcc']."', '".$ret[$c]['mnc']."', '".$ret[$c]['lac']."', '".$ret[$c]['requiredzeros']."', '".$ret[$c]['spnameid']."', '".$ret[$c]['cellid']."', '".$ret[$c]['place']."', '".$ret[$c]['cgi']."', '".$ret[$c]['lac_cellid']."')";
				
				 $sql_insert = "INSERT INTO temp_towerdetails(tspmasterid, tspcirclemasterid, ttowerid, ttowerid_original, ttowername, ttowerName_original, tlatitude, tlongitude, tgeopoints, taddress1, taddress2, ttowercity, ttowerstate, ttowercountry, tazimuth, tmsc_name, tmcc, tmnc, tlac, trequiredzeros, tspnameid, tcellid, tplace, tcgi, tlac_cellid) VALUES
				 ('".$ret[$c]['spmasterid']."', '".$ret[$c]['spcirclemasterid']."', '".$ret[$c]['towerid']."', '".$ret[$c]['towerid_original']."', '".$ret[$c]['towername']."', '".$ret[$c]['towerName_original']."', '".$ret[$c]['latitude']."', '".$ret[$c]['longitude']."', '".$ret[$c]['geopoints']."', '".$ret[$c]['address1']."', '".$ret[$c]['address2']."', '".$ret[$c]['towercity']."', '".$ret[$c]['towerstate']."', '".$ret[$c]['towercountry']."', '".$ret[$c]['azimuth']."', '".$ret[$c]['msc_name']."', '".$ret[$c]['mcc']."', '".$ret[$c]['mnc']."', '".$ret[$c]['lac']."', '".$ret[$c]['requiredzeros']."', '".$ret[$c]['spnameid']."', '".$ret[$c]['cellid']."', '".$ret[$c]['place']."', '".$ret[$c]['cgi']."', '".$ret[$c]['lac_cellid']."')";
				
				
				$res_insert = mysqli_query($con,$sql_insert); //echo $sql_insert; die();
				
				$c++; 
			}//die();
		}
		
		$sql_fetch = "SELECT * FROM temp_towerdetails";
		$res_fetch = mysqli_query($con, $sql_fetch);//  echo $sql_fetch; die();
		$cnt_fetch = $res_fetch->num_rows;
		$ret1=NULL; $i=0;  
		if($cnt_fetch > 0)
		{
    		while($row1=mysqli_fetch_assoc($res_fetch))
    		{
    			//$ret1[$i]['temp_towerid'] = $row1['temp_towerid'];
    // 			$ret1[$i]['sptowersid'] = $row1['tsptowersid'];
    // 			$ret1[$i]['spmasterid'] = $row1['tspmasterid'];
    // 			$ret1[$i]['spcirclemasterid'] = $row1['tspcirclemasterid'];
    // 			$ret1[$i]['towerid'] = $row1['ttowerid'];
    			$ret1[$i]['towerid_original'] = $row1['ttowerid_original'];
    			$ret1[$i]['towername'] = $row1['ttowername'];
    // 			$ret1[$i]['towerName_original'] = $row1['ttowerName_original'];
    			$ret1[$i]['latitude'] = $row1['tlatitude'];
    			$ret1[$i]['longitude'] = $row1['tlongitude'];
    // 			$ret1[$i]['geopoints'] = $row1['tgeopoints'];
    			$ret1[$i]['address1'] = $row1['taddress1'];
    			$ret1[$i]['address2'] = $row1['taddress2'];
    			$ret1[$i]['towercity'] = $row1['ttowercity'];
    			$ret1[$i]['towerstate'] = $row1['ttowerstate'];
    			$ret1[$i]['towercountry'] = $row1['ttowercountry'];
    			$ret1[$i]['azimuth'] = $row1['tazimuth'];
    // 			$ret1[$i]['msc_name'] = $row1['tmsc_name'];
    // 			$ret1[$i]['mcc'] = $row1['tmcc'];
    // 			$ret1[$i]['mnc'] = $row1['tmnc'];
    // 			$ret1[$i]['lac'] = $row1['tlac'];
    // 			$ret1[$i]['requiredzeros'] = $row1['trequiredzeros'];
    			$ret1[$i]['spnameid'] = $row1['tspnameid'];
    // 			$ret1[$i]['cellid'] = $row1['tcellid'];
    // 			$ret1[$i]['place'] = $row1['tplace'];
    // 			$ret1[$i]['cgi'] = $row1['tcgi'];
    // 			$ret1[$i]['lac_cellid'] = $row1['tlac_cellid'];
    			
    			$i++;
    		}
		}
	}
	
	$user_data = json_encode($ret1); //print_r($user_data); die();
	print $user_data;
?>	