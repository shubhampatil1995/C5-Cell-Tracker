<?php 

// 	$mysql_host='localhost';
// 	$mysql_user='prosofte_trazer';
// 	$mysql_password='trazer@2018';	
	
// 	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");

//   $mysql_host='tcp:prosoftserver.database.windows.net';
// 	$mysql_user='celltracker@prosoftserver';
// 	$mysql_password='{Prosoftdev12#}';
	
	
    $serverName = "<prosoftserver.database.windows.net>";
    $connectionOptions = array("Database" => "<C5Cell_Tracker>", 
    "Uid" => "<celltracker@prosoftserver>", 
    "PWD" => "<Prosoftdev12#>");

    $con = sqlsrv_connect($serverName, $connectionOptions);
        
	if ($con->connect_error) {
          die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";
    
//     echo "hello Server".$con; 
      die();
    
	
	$latitude= $_POST["latitude"];
	$longitude= $_POST["longitude"];
	$radius= $_POST["radius"];
	
		
	
//	echo "hello radius".$radius; die();
// 	$sql = "SELECT DISTINCT(towerid_original) as towerid_original, sptowersid, spmasterid, spcirclemasterid, towerid, towerid_original, towerName_original, towername, latitude, longitude, geopoints, address1, address2, towercity, towerstate, towercountry, azimuth, msc_name, mcc, mnc, lac, requiredzeros, spnameid, cellid, place, cgi, lac_cellid FROM towers_details WHERE ( 6378 * SQRT( POWER( RADIANS( CAST( '".$latitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( latitude AS DECIMAL( 20, 10 ) ) ) , 2) + POWER( RADIANS( CAST( '".$longitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( longitude AS DECIMAL( 20, 10 ) ) ) , 2 ) ) <= '".$radius."'
//  AND isnumeric(latitude) >0 AND isnumeric(longitude) >0 )"; 
//     	$sql = "SELECT DISTINCT(towerid_original) as towerid_original, towername, latitude, longitude, address1, address2, towercity, towerstate, towercountry, azimuth, spnameid FROM towers_details WHERE ( 6378 * SQRT( POWER( RADIANS( CAST( '".$latitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( latitude AS DECIMAL( 20, 10 ) ) ) , 2) + POWER( RADIANS( CAST( '".$longitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( longitude AS DECIMAL( 20, 10 ) ) ) , 2 ) ) <= '".$radius."'
//  AND (latitude) >0 AND (longitude) >0 )";  //isnumeric

   	$sql = "SELECT top 5 towerid_original, towername, latitude, longitude, address1, address2, towercity, towerstate, towercountry, azimuth, serviceprovidername FROM towers_details";  
 
        $res = mysqli_query($con, $sql); 
	//echo $sql; die();
	$ret=NULL; $c=0;
	
	$count_res = $res->num_rows;
	if($count_res > 0)
	{
    	while($row1=mysqli_fetch_assoc($res))
    	{
    	    //echo "hello"; die();
    // 		$ret[$c]['sptowersid'] = $row1['sptowersid'];
        // 		$ret[$c]['spmasterid'] = $row1['spmasterid'];
        //  		$ret[$c]['spcirclemasterid'] = $row1['spcirclemasterid'];
        // 		$ret[$c]['towerid'] = $row['towerid'];
        		$ret[$c]['towerid_original'] = $row1['towerid_original'];
        // 		$ret[$c]['towerName_original'] = $row1['towerName_original'];
        		$ret[$c]['towername'] = $row1['towername'];
        		$ret[$c]['latitude'] = $row1['latitude'];
        		$ret[$c]['longitude'] = $row1['longitude'];
        // 		$ret[$c]['geopoints'] = $row1['geopoints'];
        		$ret[$c]['address1'] = $row1['address1'];
        		$ret[$c]['address2'] = $row1['address2'];
        		$ret[$c]['towercity'] = $row1['towercity'];
        		$ret[$c]['towerstate'] = $row1['towerstate'];
        		$ret[$c]['towercountry'] = $row1['towercountry'];
        		$ret[$c]['azimuth'] = $row1['azimuth'];
        // 		$ret[$c]['msc_name'] = $row1['msc_name'];
        //  		$ret[$c]['mcc'] = $row1['mcc'];
        //  		$ret[$c]['mnc'] = $row1['mnc'];
        //  		$ret[$c]['lac'] = $row1['lac'];
        //  		$ret[$c]['requiredzeros'] = $row1['requiredzeros'];
        		$ret[$c]['spnameid'] = $row1['spnameid'];
        //  		$ret[$c]['cellid'] = $row1['cellid'];
        //  		$ret[$c]['place'] = $row1['place'];
        //  		$ret[$c]['cgi'] = $row1['cgi'];
        //  		$ret[$c]['lac_cellid'] = $row1['lac_cellid'];
         		
         		//print_r($ret); die();
         		$c++;
    	}
	}
	//$user_data = json_encode($ret);
	print_r($user_data); die();
	print $user_data;
 

?>
