<?php 

// 	 $mysql_host='localhost';
// 	 $mysql_user='prosofte_trazer';
// 	 $mysql_password='trazer@2018';	
// 	 $con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"prosofte_trazer");

    $mysql_host='35.200.241.253';
	$mysql_user='root';
	$mysql_password='12345';

	$con = mysqli_connect($mysql_host,$mysql_user,$mysql_password,"C5Cell_Tracker");
	 
	 
	
	//echo "hello"; die(); 
	$tower_id= $_POST['data']; //echo "hello = ".$tower_id; die();
//	$array_towerids= explode(',', $tower_id);
	
	
	
		$sql = "SELECT m.* FROM towers_details m WHERE MBRIntersects(GEOMFROMTEXT(CONCAT('POLYGON((', m.latitude , ' ' , m.longitude ,'))')),GEOMFROMTEXT('POLYGON((".$tower_id."))'))";
		
		//echo $sql; die();
		  $res = mysqli_query($con, $sql);
		  $cnt = $res->num_rows;
		  $ret=NULL; $c=0;
		  echo $cnt; die();
		 if($cnt > 0)
		 {
			 while($row=mysqli_fetch_assoc($res))
			 {
				//  $ret[$c]['sptowersid'] = $row['sptowersid'];
				//  $ret[$c]['spmasterid'] = $row['spmasterid'];
				//  $ret[$c]['spcirclemasterid'] = $row['spcirclemasterid'];
				//  $ret[$c]['towerid'] = $row['towerid'];
				 $ret[$c]['towerid_original'] = $row['towerid_original'];
				 $ret[$c]['towername'] = $row['towername'];
				//  $ret[$c]['towerName_original'] = $row['towerName_original'];
				 $ret[$c]['latitude'] = $row['latitude'];
				 $ret[$c]['longitude'] = $row['longitude'];
		      //   $ret[$c]['geopoints'] = $row['geopoints'];
        		 $ret[$c]['address1'] = $row['address1'];
        		 $ret[$c]['address2'] = $row['address2'];
        		 $ret[$c]['towercity'] = $row['towercity'];
        		 $ret[$c]['towerstate'] = $row['towerstate'];
        		 $ret[$c]['towercountry'] = $row['towercountry'];
        		 $ret[$c]['azimuth'] = $row['azimuth'];
        // 		 $ret[$c]['msc_name'] = $row['msc_name'];
        // 		 $ret[$c]['mcc'] = $row['mcc'];
        // 		 $ret[$c]['mnc'] = $row['mnc'];
        // 		 $ret[$c]['lac'] = $row['lac'];
        // 		 $ret[$c]['requiredzeros'] = $row['requiredzeros'];
        		 $ret[$c]['spnameid'] = $row['spnameid'];
        // 		 $ret[$c]['cellid'] = $row['cellid'];
        // 		 $ret[$c]['place'] = $row['place'];
        // 		 $ret[$c]['cgi'] = $row['cgi'];
        // 		 $ret[$c]['lac_cellid'] = $row['lac_cellid'];	
		            
		         //echo $sql_insert.'<br/>'; 
				$c++;
			}
		}
	
    //die();
	
	$user_data = json_encode($ret); //print_r($user_data); die();
	print $user_data;
	//print $mResult;


?>