<?php 

	$mysql_host='localhost';
	$mysql_user='prosofte_trazer';
	$mysql_password='trazer@2018';	

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");
	
	$latitude= $_POST["latitude"];
	$longitude= $_POST["longitude"];
	$radius= $_POST["radius"];
	
	$sql = "SELECT * FROM tower_details WHERE ( 6378 * SQRT( POWER( RADIANS( CAST( '".$latitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( latitude AS DECIMAL( 20, 10 ) ) ) , 2) + POWER( RADIANS( CAST( '".$longitude."' AS DECIMAL( 20, 10 ) ) ) - RADIANS( CAST( longitude AS DECIMAL( 20, 10 ) ) ) , 2 ) ) <= '".$radius."'
 AND isnumeric(latitude) >0 AND isnumeric(longitude) >0 )";// echo $sql; die();

	$res = mysqli_query($con, $sql);
	$ret=NULL; $c=0; //echo "sony"; print_r($res); die();
	while($row=mysqli_fetch_assoc($res))
	{
		$ret[$c]['ttower_slno'] = $row['tower_slno'];
		$ret[$c]['ttower_id'] = $row['tower_id'];
		$ret[$c]['tlatitude'] = $row['latitude'];
		$ret[$c]['tlongitude'] = $row['longitude'];
		$ret[$c]['tlower_name'] = $row['lower_name'];
		$ret[$c]['taddress'] = $row['address'];
		$ret[$c]['tcity'] = $row['city'];
		$ret[$c]['tstate'] = $row['state'];
		$ret[$c]['tservice_provider'] = $row['service_provider'];
		
		$c++;
		
	}
	$user_data = json_encode($ret); //print_r($user_data); die();
	print $user_data;
	
?>	