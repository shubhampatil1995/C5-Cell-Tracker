<?php 
// echo "yoooo";
// error_reporting(E_ALL);
// $towerid= $_POST["cell_id"];

// $array_towerids= explode(',', $towerid);

$serverName = "tcp:prosoftserver.database.windows.net,1433";
$connectionOptions = array(
    "Database" => "C5Cell_Tracker",
    "Uid" => "celltracker",
    "PWD" => "Prosoftdev12#"
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if($conn)
{
	echo "CONNECTED";
}
else{
	echo "NOOOOOOOOOOOOOOOOOO";
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
