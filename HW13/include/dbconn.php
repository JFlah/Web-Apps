<?php
function connectToDB($dbname){
	$dbc= @mysqli_connect("localhost", "oconnonx", "bQzjnP53", $dbname) or
					die("Connect failed: ". mysqli_connect_error());
	return $dbc;
}
function disconnectFromDB($dbc){
	mysqli_close($dbc);
}

function performQuery($dbc, $query){
	//echo "My query is >$query< <br>";
	$result = mysqli_query($dbc, $query) or die("BAD QUERY:<br> <a href='http://cscilab.bc.edu/~oconnonx/BestOfBC/index.php?op=Add+Attraction&searchtxt='>Try Again</a><br> Query error: " . mysqli_error($dbc));
	return $result;
}
?>