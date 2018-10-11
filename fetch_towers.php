<?php 

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	
	
	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$sql_delete = "DELETE FROM temp_towerdetails";
	$res_delete = mysqli_query($con, $sql_delete);
	
	$latitude= $_POST["latitude"];
	$longitude= $_POST["longitude"];
	$radius= $_POST["radius"];
	
	$sql = "SELECT DISTINCT(towerid_original) as towerid_original FROM towers_details WHERE ( 6378 * SQRT( POWER( RADIANS( CAST( '".$latitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( latitude AS DECIMAL( 20, 10 ) ) ) , 2) + POWER( RADIANS( CAST( '".$longitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( longitude AS DECIMAL( 20, 10 ) ) ) , 2 ) ) <= '".$radius."'
 AND isnumeric(latitude) >0 AND isnumeric(longitude) >0 )";

	$res = mysqli_query($con, $sql);  //echo $sql; die();
	$ret=NULL; $c=0;
	while($row=mysqli_fetch_assoc($res))
	{
		
		$towerid_original = $row['towerid_original'];
		
		$sql1 = "SELECT * FROM towers_details WHERE towerid_original='".$towerid_original."'LIMIT 1 ";  //echo $sql1; die();
		$res1 = mysqli_query($con, $sql1);
		
		while($row1=mysqli_fetch_assoc($res1))
		{
		    $ret[$c]['sptowersid'] = $row1['sptowersid'];
    		$ret[$c]['spmasterid'] = $row1['spmasterid'];
     		$ret[$c]['spcirclemasterid'] = $row1['spcirclemasterid'];
    		$ret[$c]['towerid'] = $row['towerid'];
    		$ret[$c]['towerid_original'] = $row1['towerid_original'];
    		$ret[$c]['towerName_original'] = $row1['towerName_original'];
    		$ret[$c]['towername'] = $row1['towername'];
    		$ret[$c]['latitude'] = $row1['latitude'];
    		$ret[$c]['longitude'] = $row1['longitude'];
    		$ret[$c]['geopoints'] = $row1['geopoints'];
    		$ret[$c]['address1'] = $row1['address1'];
    		$ret[$c]['address2'] = $row1['address2'];
    		$ret[$c]['towercity'] = $row1['towercity'];
    		$ret[$c]['towerstate'] = $row1['towerstate'];
    		$ret[$c]['towercountry'] = $row1['towercountry'];
    		$ret[$c]['azimuth'] = $row1['azimuth'];
    		$ret[$c]['msc_name'] = $row1['msc_name'];
     		$ret[$c]['mcc'] = $row1['mcc'];
     		$ret[$c]['mnc'] = $row1['mnc'];
     		$ret[$c]['lac'] = $row1['lac'];
     		$ret[$c]['requiredzeros'] = $row1['requiredzeros'];
    		$ret[$c]['spnameid'] = $row1['spnameid'];
     		$ret[$c]['cellid'] = $row1['cellid'];
     		$ret[$c]['place'] = $row1['place'];
     		$ret[$c]['cgi'] = $row1['cgi'];
     		$ret[$c]['lac_cellid'] = $row1['lac_cellid'];
     		
    		
		    
		    //$sql_insert = "INSERT INTO temp_towerdetails(tsptowersid, tspmasterid, tspcirclemasterid, ttowerid, ttowerid_original, ttowername, ttowerName_original, tlatitude, tlongitude, tgeopoints, taddress1, taddress2, ttowercity, ttowerstate, ttowercountry, tazimuth, tmsc_name, tmcc, tmnc, tlac,trequiredzeros, tspnameid, tcellid, tplace, tcgi, tlac_cellid) VALUES('".$ret[$c]['sptowersid']."', '".$ret[$c]['spmasterid']."', '".$ret[$c]['spcirclemasterid']."', '".$ret[$c]['towerid']."', '".$ret[$c]['towerid_original']."', '".$ret[$c]['towerName_original']."', '".$ret[$c]['towername']."', '".$ret[$c]['latitude']."', '".$ret[$c]['longitude']."', '".$ret[$c]['geopoints']."', '".$ret[$c]['address1']."', '".$ret[$c]['address2']."', '".$ret[$c]['towercity']."', '".$ret[$c]['towerstate']."', '".$ret[$c]['towercountry']."', '".$ret[$c]['azimuth']."', '".$ret[$c]['msc_name']."', '".$ret[$c]['mcc']."', '".$ret[$c]['mnc']."', '".$ret[$c]['lac']."', '".$ret[$c]['requiredzeros']."', '".$ret[$c]['spnameid']."' '".$ret[$c]['cellid']."', '".$ret[$c]['place']."', '".$ret[$c]['cgi']."', '".$ret[$c]['lac_cellid']."')";
		    
		    $sql_insert = "INSERT INTO temp_towerdetails(tsptowersid, tspmasterid, tspcirclemasterid, ttowerid, ttowerid_original, ttowername, ttowerName_original, tlatitude, tlongitude, tgeopoints, taddress1, taddress2, ttowercity, ttowerstate, ttowercountry, tazimuth, tmsc_name, tmcc, tmnc, tlac, trequiredzeros, tspnameid, tcellid, tplace, tcgi, tlac_cellid) VALUES
				('".$ret[$c]['sptowersid']."', '".$ret[$c]['spmasterid']."', '".$ret[$c]['spcirclemasterid']."', '".$ret[$c]['towerid']."', '".$ret[$c]['towerid_original']."', '".$ret[$c]['towername']."', '".$ret[$c]['towerName_original']."', '".$ret[$c]['latitude']."', '".$ret[$c]['longitude']."', '".$ret[$c]['geopoints']."', '".$ret[$c]['address1']."', '".$ret[$c]['address2']."', '".$ret[$c]['towercity']."', '".$ret[$c]['towerstate']."', '".$ret[$c]['towercountry']."', '".$ret[$c]['azimuth']."', '".$ret[$c]['msc_name']."', '".$ret[$c]['mcc']."', '".$ret[$c]['mnc']."', '".$ret[$c]['lac']."', '".$ret[$c]['requiredzeros']."', '".$ret[$c]['spnameid']."', '".$ret[$c]['cellid']."', '".$ret[$c]['place']."', '".$ret[$c]['cgi']."', '".$ret[$c]['lac_cellid']."')";
		    
		    //echo $sql_insert; die();
		    
		    $res_insert = mysqli_query($con, $sql_insert);
		    
		    $c++;
		}
		
		
		$sql_fetch = "SELECT * FROM temp_towerdetails";
		$res_fetch = mysqli_query($con, $sql_fetch);//  echo $sql_fetch; die();
		$ret1=NULL; $i=0;  
		while($row1=mysqli_fetch_assoc($res_fetch))
		{
			//$ret1[$i]['temp_towerid'] = $row1['temp_towerid'];
			$ret1[$i]['sptowersid'] = $row1['tsptowersid'];
			$ret1[$i]['spmasterid'] = $row1['tspmasterid'];
			$ret1[$i]['spcirclemasterid'] = $row1['tspcirclemasterid'];
			$ret1[$i]['towerid'] = $row1['ttowerid'];
			$ret1[$i]['towerid_original'] = $row1['ttowerid_original'];
			$ret1[$i]['towername'] = $row1['ttowername'];
			$ret1[$i]['towerName_original'] = $row1['ttowerName_original'];
			$ret1[$i]['latitude'] = $row1['tlatitude'];
			$ret1[$i]['longitude'] = $row1['tlongitude'];
			$ret1[$i]['geopoints'] = $row1['tgeopoints'];
			$ret1[$i]['address1'] = $row1['taddress1'];
			$ret1[$i]['address2'] = $row1['taddress2'];
			$ret1[$i]['towercity'] = $row1['ttowercity'];
			$ret1[$i]['towerstate'] = $row1['ttowerstate'];
			$ret1[$i]['towercountry'] = $row1['ttowercountry'];
			$ret1[$i]['azimuth'] = $row1['tazimuth'];
			$ret1[$i]['msc_name'] = $row1['tmsc_name'];
			$ret1[$i]['mcc'] = $row1['tmcc'];
			$ret1[$i]['mnc'] = $row1['tmnc'];
			$ret1[$i]['lac'] = $row1['tlac'];
			$ret1[$i]['requiredzeros'] = $row1['trequiredzeros'];
			$ret1[$i]['spnameid'] = $row1['tspnameid'];
			$ret1[$i]['cellid'] = $row1['tcellid'];
			$ret1[$i]['place'] = $row1['tplace'];
			$ret1[$i]['cgi'] = $row1['tcgi'];
			$ret1[$i]['lac_cellid'] = $row1['tlac_cellid'];
			
			$i++;
		}
		
	}
	//print_r($ret); die();
	$user_data = json_encode($ret1);
	//print_r($user_data); die();
	print $user_data;
	
?>	