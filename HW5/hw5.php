<!DOCTYPE html>

<!--
	HW5
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW5</title>
     <style type="text/css">
     	body { font-family: Helvetica;
     				background-color: black;
     				font-size: 1.5em }
     	h1 { font-family: impact;
     			text-align: center;
     			color: cyan }
     	legend { font-weight: bold;
     				font-family: impact;
     				color: cyan}
     	.floatLeft { float: left;
     				color: cyan }
     	.floatRight { float: right }
     	p { font-size: xx-small;
     	color: cyan }
     	button { font-weight: bold;
     				font-size: large;
     				color: cyan;
     				background-color: black }
     	table { color: cyan }
     </style>
</head>
<body>

	<h1>Sunrise Sunset...</h1>

	<?php

		displayform();

		if ( isset( $_GET['city'] ) ) {

			handleform();
		}
	?>

</body>
</html>

<?php
function displayform(){
?>

	<form method="get">
		<fieldset>

		<legend>Choose a location</legend>

		<div class="floatRight">
		<img src="sun.jpg" alt="sun Picture" height="400" width="500"><br>
		<p>
		Image source: Professional photographer Jack Flaherty
		</p>
		</div>

		<div class="floatLeft">
		<input type="radio" name="city" value="Boston" /> Boston <br>
		<input type="radio" name="city" value="San Francisco" /> San Fran <br>
		<input type="radio" name="city" value="New York City" /> NYC <br>
		</div>

		<br><br><br><br>

		<button type="submit" value="submitted">Get Sunrise and Sunset</button>

	</fieldset>
	</form>
<?php
}

function handleform() {
	// echo "<pre>";
	// print_r( $_GET );
	// echo "</pre>\n";


	// This is to get rid of an annoying warning message...
	date_default_timezone_set(@date_default_timezone_get());


	$now = time();	// get the current date and time

	$location = $_GET['city'];


	// turn off php and write the table header in html
	?>

	<fieldset>

	<?php
	echo "<legend>Information About $location's Sun</legend>";
	?>

	<table>
		<tr>
			<th>Date</th>
			<th>Sunrise</th>
			<th>Sunset</th>
		</tr>

	<?php
	create_sunrise_data_table($location, $now);
	?>
	</table>
	</fieldset>
	<?php
}

function create_sunrise_data_table($city, $now){

	if ($city=="Boston") {
		$latitude = 42.35670;
		$longitude = -71.05690;
		$gmt_offset = -5;
	}
	if ($city=="San Francisco") {
		$latitude = 37.77750;
		$longitude = -122.41100;
		$gmt_offset = -8;
	}
	if ($city=="New York City") {
		$latitude = 40.75170;
		$longitude = -73.99420;
		$gmt_offset = -5;
	}

		// do this for the next 7 days
		// each time through the loop, I make one row of the table.
		for ( $i = 0; $i < 7; $i++ ) {

			$formatted_date = date( "D M d Y", $now );

			$sunrise_time = date_sunrise( $now, SUNFUNCS_RET_STRING,
			$latitude, $longitude, 90, $gmt_offset );

			$sunset_time = date_sunset( $now, SUNFUNCS_RET_STRING,
			$latitude, $longitude, 90, $gmt_offset );

			echo "<tr>
					<td>$formatted_date</td>
					<td>$sunrise_time</td>
					<td>$sunset_time</td>
				  </tr>\n";

			$now += 24 * 60 * 60;  // add a days worth of seconds to $now
		}
}
?>