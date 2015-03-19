<!DOCTYPE html>

<!--
	HW4
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
	<title>HW34 Determining RPS Winner</title>

	<style type="text/css">
		h1 { font-family: impact;
		      	color: white;
     			text-align: center }
     	body { font-family: Helvetica;
     				background-color: darkcyan;
     				font-size: 1.5em }
		legend { color: purple;
		     		background-color: white;
		     		font-weight: bold;
     				font-family: impact }
     	h4 { font-family: helvetica;
     			color: red;
     			text-align: center }
     	h3 { font-family: helvetica;
     			color: white;
     			text-align: center }
     	p { font-size: xx-small }
     </style>

</head>
<body>

<h1>Who won?!</h1>

	<?php

		 // Get human move (or die if not given)

		 if (!isset($_GET['human'])) {
		 	echo "<a href='http://cscilab.bc.edu/~oconnonx/hw4/hw4.php'>Try again</a>";
		 	die("<h4>You must select a move, simple human.</h4>");
		 }
		 else {
		 	$humanMove = $_GET['human'];
		 }

		 // Generate random computer num and corresponding move

		 $computerNum = rand(1,3);

		 if ($computerNum == 1) {
		 	$computerMove = "Rock";
		 }
		 else if ($computerNum == 2) {
		 	$computerMove = "Paper";
		 } else {
		 	$computerMove = "Scissors";
		 }

		 // Determine winner

		 // Tie

		if ($humanMove == $computerMove) {

			echo "<h3>You chose $humanMove and the computer chose $computerMove</h3><br>";

			echo "<img src='tie.jpg' alt='tie pic' height='400' width='500'>";
			echo "<p>Image source: http://wide-wallpapers.net/quote-about-mediocrity-wide-wallpaper/</p>";

			echo "It's a tie. You should probably play again.";

		}

		// Human win

		else if ( ($humanMove == "Rock" && $computerMove == "Scissors") ||
				($humanMove == "Paper" && $computerMove == "Rock") ||
				($humanMove == "Scissors" && $computerMove == "Paper") ) {
			echo "<h3>You chose $humanMove and the computer chose $computerMove</h3><br>";

			echo "<img src='victory.jpg' alt='victory pic' height='400' width='500'>";
			echo "<p>Image source: http://www.masslive.com/sports/index.ssf/2013/10/outside-fenway-the-celebrity-of-steve-horgan.html</p>";

			echo "You win!";

		} else { // Human loss

			echo "<h3>You chose $humanMove and the computer chose $computerMove</h3><br>";

			echo "<img src='failure.jpg' alt='loss pic' height='400' width='500'>";
			echo "<p>Image source: http://www.haineslocalsearch.com/5-reasons-website-failure/</p>";

			echo "You got beat by a bunch of circuits. Play again for the human race.";

		}


	?>

	<br>

	<!--
	Anchor back to first page to play again
		-->
	<br><br>
	<a href="http://cscilab.bc.edu/~oconnonx/hw4/hw4.php">Want to play again?</a>

</body>
</html>