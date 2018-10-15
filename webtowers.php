<?php 

$tower_id= $_POST['data'];
//echo "Its Coming home";die();

$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
$tsql = "SELECT [TowerID_Original],[TowerName],[Latitude],[Longitude],[Address1],[Address2],[TowerCity],[TowerState],[TowerCountry],
[Azimuth],[ServiceProviderName] from towers_details m 
wheregeometry::STGeomFromText('Polygon((".$tower_id."))',4326).STIntersects(Geopoints.MakeValid())=1";

echo $tsql;die();
	 
$getResults= sqlsrv_query($conn, $tsql);
$ret=NULL; $c=0;
	
$count_res = $res->num_rows;
if ($getResults == FALSE)
    die(FormatErrors(sqlsrv_errors()));
while($row1=sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC))
{
				
        		$ret[$c]['towerid_original'] = $row1['TowerID_Original'];
        		$ret[$c]['towername'] = $row1['TowerName'];
        		$ret[$c]['latitude'] = $row1['Latitude'];
        		$ret[$c]['longitude'] = $row1['Longitude'];
        		$ret[$c]['address1'] = $row1['Address1'];
        		$ret[$c]['address2'] = $row1['Address2'];
        		$ret[$c]['towercity'] = $row1['TowerCity'];
        		$ret[$c]['towerstate'] = $row1['TowerState'];
        		$ret[$c]['towercountry'] = $row1['TowerCountry'];
        		$ret[$c]['azimuth'] = $row1['Azimuth'];
         
         		$c++;
 }

sqlsrv_free_stmt($getResults);
	 	
$user_data = json_encode($ret); //print_r($user_data); die();
print $user_data;
//print $mResult;
?>
