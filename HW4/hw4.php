<!DOCTYPE html>

<!--
	HW4
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW4</title>
     <style type="text/css">
     	body { font-family: Helvetica;
     				background-color: darkcyan;
     				font-size: 1.5em }
     	h1 { font-family: impact;
     			text-align: center;
     			color: white }
     	ul { color: white;
     			float: right }
     	legend { color: white;
     				font-weight: bold;
     				font-family: impact }
     	.floatLeft { float: left }
     	.floatRight { float: right;
     						color: white }
     	.floatCenter { float: center }
     	p { font-size: xx-small }
     	button { color: blue;
     				background-color: white }
     </style>
</head>
<body>

	<h1>Let's play a game!</h1>
	<br>
	<ul>
		<li>Rock crushes scissors</li>
		<li>Scissors cuts paper</li>
		<li>Paper covers rock</li>
	</ul>

	<br><br><br>
	<a href="http://flahtweet.herokuapp.com/">Rock Paper Scissors</a>

	<br><br>

	<form method="get" action="hw4php.php">
	<fieldset>

		<legend>Make your move...</legend>

		<div class="floatLeft">
		<img src="rps.jpg" alt="RPS Picture" height="400" width="500"><br>
		<p>
		Image source: http://planet941.com/2013/02/07/win-rock-paper-scissors-more-often/
		</p>
		</div>

		<div class="floatRight">
		<label>Choose your move, young grasshopper:</label>
		<br>
		<input type="radio" name="human" value="Rock" /> Rock <br>
		<input type="radio" name="human" value="Paper" /> Paper <br>
		<input type="radio" name="human" value="Scissors" /> Scissors <br>
		</div>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

		<button class="floatCenter" type="submit" value="Submit">GO!</button>


	</fieldset>
	</form>

</body>
</html>