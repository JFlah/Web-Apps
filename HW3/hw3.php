<!DOCTYPE html>

<!--
	HW3
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW3</title>
     <style type="text/css">
     	h1 { font-family: impact;
	      		color: lime;
     			text-align: center }
     	body { font-family: Helvetica;
     				background-color: darkgray;
     				font-size: 1.5em }
     	legend { color: purple;
     				background-color: white;
     				font-weight: bold;
     				font-family: impact }
     	label { color: purple }
     	img { float: left }
     	p { font-size: xx-small;
     			float: left }
     	select { color: purple }
     	.myClass { float: right }
     	button { background-color: purple;
     				color: white;
     				font-weight: bold;
     				float: center }
     </style>
</head>

<body>
	<h1>Welcome to the tip calculator!</h1>

	<form method="get" action="hw3php.php">
	<fieldset>
		<legend>Fill Out Form to Calculate</legend>

		<label>Enter amount $</label>
		<input type=text name="checkAmt" />

		<br><br><br>

		<img src="cat.jpg" alt="Cat side pic" height="400" width="500">

		<div class="myClass">
		<label>Are you splitting the tab?</label>
		<br><br>
		<select name="split" size="4">
			<option value="1">No</option>
			<option value="2">Yes, 2 people</option>
			<option value="3">Yes, 3 people</option>
			<option value="4">Yes, 4 people</option>
		</select>

		<br><br>

		<label>How was the service?</label>
		<br><br>
		<select name="service" size="5">
			<option value="20">Really Great</option>
			<option value="18">Good</option>
			<option value="15">Okay</option>
			<option value="12">Iffy</option>
			<option value="10">Miserable</option>
		</select>
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<p>
			Image source: http://mygreenerfuture.com/2013/01/22/an-interview-during-a-meal-now-what-do-i-do/
		</p>

		<br>

		<button type="submit" value="Submit">Calculate and Split!</button>
		<button type="reset" value="Reset">Clear</button>


	</fieldset>
	</form>

</body>
</html>