<?php 

$towerid= $_POST["cell_id"];

$array_towerids= explode(',', $towerid);

$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn){
	return json_encode($array_towerids);
	//return json_encode("connected");
}
else{
	return json_encode("not connected");
}

	



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

?>	
