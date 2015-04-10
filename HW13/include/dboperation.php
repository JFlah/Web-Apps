<?php
include ('dbconn.php');
?>

<!DOCTYPE html>

<!--
	HW13 Best of BC dboperation.php
	Author: Jack Flaherty
-->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>Best of BC</title>
     <link rel="stylesheet" type="text/css" href="../CSS/BoBC.css">
</head>
<body>

<?php
	$address = $_POST['address'];
	$geocodeURL = "https://maps.googleapis.com/maps/api/geocode/xml?";
   	$address = "address=" . urlencode($address);
   	$key = "key=AIzaSyAvMPTIQM4HGh8QY2uLYZ-AKjKi2Pws9dk";
   	$geocoderequest = "$geocodeURL$address" . "&" . $key;

   	$xml = new SimpleXMLElement( file_get_contents( $geocoderequest ) );

   	if ($xml->status != 'OK')
   		die("bad result status <br>Head back to the
   				<a href='http://cscilab.bc.edu/~oconnonx/BestOfBC/index.php'>Home Page</a>");

   	$loc = getLocation($xml);
   	// echo "<pre>"; print_r($loc);  	echo "</pre>";
	
	$name = $_POST['name'];
	$stars = $_POST['stars'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$url = $_POST['url'];
	$id = $_POST['id'];
	$comment = $_POST['comment'];

	$latitude = (float)$loc["latitude"];
	$longitude = (float)$loc["longitude"];

	$dbc = connectToDB('csci2254');
	$addQuery = "insert into bestofbc(
		insertion_date,
        entered_by,
        name,
        category,
        address,
        latitude,
        longitude,
        phone,
        url,
        stars,
        price_range,
        comment) 
		values (curdate(), '$id', '$name', '$category', '$address', $latitude, $longitude,
					'$phone', '$url', '$stars', '$price', '$comment')";

	$result = performQuery($dbc, $addQuery);

	echo "<h1>Attraction inserted<br>Head back to the
   				<a href='http://cscilab.bc.edu/~oconnonx/BestOfBC/index.php'>Home Page</a></h1>";
	?>


</body>
</html>

<?php
function getLocation($xml){
	$latitude  = $xml->result->geometry->location->lat;
    $longitude = $xml->result->geometry->location->lng;    
    $location = array("latitude" => $latitude, "longitude" => $longitude);
        
    return ($location);
}
?>