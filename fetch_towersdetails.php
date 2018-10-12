<?php

	$latitude= $_POST["latitude"];
	$longitude= $_POST["longitude"];
	$radius= $_POST["radius"];
	
$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);
//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

  $tsql = "SELECT [TowerID_Original],[TowerName],[Latitude],[Longitude],[Address1],[Address2]
,[TowerCity],[TowerState],[TowerCountry],[Azimuth],[ServiceProviderName] from towers_details m where
geometry::STGeomFromText('Polygon((15.89679 74.50852,15.89778 74.51863,15.89096 74.5176,
15.89041 74.50784,15.89679 74.50852))',4326).STIntersects(Geopoints.MakeValid())=1";
 
// echo $tsql;die();
 
 $getResults= sqlsrv_query($conn, $tsql);
 $ret=NULL; $c=0;
	
$count_res = $res->num_rows;

if ($getResults == FALSE)
    die(FormatErrors(sqlsrv_errors()));
while($row1=sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
    	{
				
        		$ret[$c]['TowerID_Original'] = $row1['TowerID_Original'];
        		$ret[$c]['TowerName'] = $row1['TowerName'];
        		$ret[$c]['Latitude'] = $row1['Latitude'];
        		$ret[$c]['Longitude'] = $row1['Longitude'];
        		$ret[$c]['Address1'] = $row1['Address1'];
        		$ret[$c]['Address2'] = $row1['Address2'];
        		$ret[$c]['TowerCity'] = $row1['TowerCity'];
        		$ret[$c]['TowerState'] = $row1['TowerState'];
        		$ret[$c]['TowerCountry'] = $row1['TowerCountry'];
        		$ret[$c]['Azimuth'] = $row1['Azimuth'];
         
         		$c++;
    	}

/*while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['TowerName'] . PHP_EOL);

}*/
sqlsrv_free_stmt($getResults);
$user_data = json_encode($ret);
//print_r($user_data); die();
print $user_data;
 

function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: ";

    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."";
        echo "Code: ".$error['code']."";
        echo "Message: ".$error['message']."";
    }
}
// $time_end = microtime(true);
// $execution_time = round((($time_end - $time_start)*1000),2);
// echo 'QueryTime: '.$execution_time.' ms';
 

?>
