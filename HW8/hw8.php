<!DOCTYPE html>

<!--
	HW8
	Author: Jack Flaherty
-->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW8</title>
     <style>

body { font-family: Helvetica;
     				background-color: steelblue;
     				font-size: 1.5em }
     	h1 { font-family: impact;
     			text-align: center;
     			color: tan }
     	h4 { font-family: impact;
     			text-align: center;
     			color: tan }
     	#fieldid { font-weight: bold;
     				font-size: 150%;
     				color: tan }
     	#fieldid2 { font-weight: bold;
     				font-size: 150%;
     				color: tan }
     	legend { font-weight: bold;
     				font-family: impact;
     				color: tan}
     	.floatRight { float: right;
     					color: lightgray }
     	p { font-size: xx-small;
     		color: black }
     	.button { font-weight: bold;
     				font-size: xx-large;
     				color: tan;
     				background-color: steelblue }
	 	.news {
	 		overflow: auto;
	 		height: 300px;
	 		border: 3px groove blue
	 	}

	</style>
</head>

	<?php

	// News stuff



	?>

<body>
	<img class="floatRight" src="http://i.imgur.com/dgmvo9k.jpg" alt="Main pic" height="200" width="200"><br>

	<h1>Chewing the Fat with Flah</h1>
	<h4>Start your day off right</h4>

	<form method="get">
		<fieldset id="fieldid"><legend>My Weather</legend>
				<div class="floatRight">
					<img src="http://woodcountyema.org/wp-content/uploads/2014/01/fridays-weather-forecast-unit-4_01.jpg" alt="Header title pic" height="400" width="400"><br>
					<p>Image src: http://woodcountyema.org/wp-content/uploads/2014/01/fridays-weather-forecast-unit-4_01.jpg </p>
				</div>
	<?php
	displayweatherform();
	if (isset($_GET['gettheweather'])) {
		handleweatherform();
	} ?>

		</fieldset>
	</form>

	<form method="get">
		<fieldset id="fieldid2"><legend>My News</legend>

	<?php
	displaynewsform();

	if (isset($_GET['getthenews'])) {
		handlenewsform();
	}
	?>
		</fieldset>
	</form>


</body>
</html>
<?php

function create_menu($locations, $name) {
	echo "<select name='$name'>";
	if (isset($_GET[$name])) {
		$menuvalue = $_GET[$name];
	} else {
		$menuvalue = "";
	}
	foreach($locations as $key=>$value){
		if ($menuvalue==$value) {
			echo "<option selected='selected'>$value</option>";
		} else {
			echo "<option>$value</option>";
		}
	}
	echo "</select>";
}

?>

<?php

function displayweatherform() {

	$weatherlocs = array(
	"http://w1.weather.gov/xml/current_obs/KBOS.xml"=>"Boston",
	"http://w1.weather.gov/xml/current_obs/KORD.xml"=>"Chicago",
	"http://w1.weather.gov/xml/current_obs/KROC.xml"=>"Rochester");
?>

	<?php create_menu($weatherlocs, 'weather_location'); ?>

	<br><input class="button" value="Get the weather" type="submit" name="gettheweather">

<?php
}

function displaynewsform() {

	$newslocs = array(
	"http://rss.nytimes.com/services/xml/rss/nyt/Space.xml"=>"NYT Space",
	"http://realtime.mbta.com/alertsrss/rssfeed4"=>"MBTA Alerts",
	"http://www.sportsworldnews.com/rss/archives/all.xml"=>"Sports World News"); ?>

	<?php create_menu($newslocs, 'news_feed'); ?>

	<br><input class="button" type="submit" value="Get the news" name="getthenews">

<?php

}

function handleweatherform() {

	// Weather stuff

	if (isset($_GET['weather_location'])) {
		$city = $_GET['weather_location'];
	}

	if ($city == "Boston") {
		$xml = new SimpleXMLElement(file_get_contents("http://w1.weather.gov/xml/current_obs/KBOS.xml"));
		$location = $xml -> location;
		$weather = $xml -> weather;
		$temperature_string = $xml -> temperature_string;
		$wind_string = $xml -> wind_string;
		$lastupdated = $xml -> observation_time;
	} else if ($city == "Chicago") {
		$xml = new SimpleXMLElement(file_get_contents("http://w1.weather.gov/xml/current_obs/KORD.xml"));
		$location = $xml -> location;
		$weather = $xml -> weather;
		$temperature_string = $xml -> temperature_string;
		$wind_string = $xml -> wind_string;
		$lastupdated = $xml -> observation_time;
	} else {
		$xml = new SimpleXMLElement(file_get_contents("http://w1.weather.gov/xml/current_obs/KROC.xml"));
		$location = $xml -> location;
		$weather = $xml -> weather;
		$temperature_string = $xml -> temperature_string;
		$wind_string = $xml -> wind_string;
		$lastupdated = $xml -> observation_time;
	}

	// echo "<pre>";
	// print_r( $_GET );
	// echo "</pre>\n";

	echo "<h1>" . $location . "</h1><br>";
	echo "<h2>" . $lastupdated . "</h2><br>";
	echo "<h3>" . $temperature_string . " " . $wind_string . " " . $weather . "</h3><br>";
}

function handlenewsform() {
	$newsfeed = $_GET['news_feed'];

	if ($newsfeed == 'NYT Space') {
		$rss= new SimpleXMLElement(file_get_contents('http://rss.nytimes.com/services/xml/rss/nyt/Space.xml'));
		$title = $rss->channel->title;
		echo "<h1>$title</h1>";
		$items = $rss->channel->item;
		foreach ($items as $item) {
			echo "<div class='news'>
						<h2>$item->title</h2>\n";
			echo '<a href="' . $item->link . '">' . $item->title . '</a><br>';
			echo $item->description . "<br><br>\n";
			echo "<br></div>";
		}
	} else if ($newsfeed == 'MBTA Alerts') {
		$rss= new SimpleXMLElement(file_get_contents('http://realtime.mbta.com/alertsrss/rssfeed4'));
		$title = $rss->channel->title;
		echo "<h1>$title</h1>";
		$items = $rss->channel->item;
		foreach ($items as $item) {
			echo "<div class='news'>
						<h2>$item->title</h2>\n";
			echo '<a href="' . $item->link . '">' . $item->title . '</a><br>';
			echo $item->description . "<br><br>\n";
			echo "<br></div>";
		}
	} else { // 'Sports World News'
		$rss= new SimpleXMLElement(file_get_contents('http://www.sportsworldnews.com/rss/archives/all.xml'));
		$title = $rss->channel->title;
		echo "<h1>$title</h1>";
		$items = $rss->channel->item;
		foreach ($items as $item) {
			echo "<div class='news'>
						<h2>$item->title</h2>\n";
			echo '<a href="' . $item->link . '">' . $item->title . '</a><br>';
			echo $item->description . "<br><br>\n";
			echo "<br></div>";
		}
	}

}
