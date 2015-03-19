<!DOCTYPE html>

<!--
	HW3
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
	<title>HW3 Tip and Split</title>
	<style type="text/css">
		h1 { font-family: impact;
		      	color: lime;
		      	background-color: purple;
     			text-align: center }
     	body { font-family: Helvetica;
		     		background-color: darkgray;
		     		font-size: 1.5em;
		     		color: purple }
		legend { color: purple;
		     		background-color: white;
		     		font-weight: bold;
     				font-family: impact }
     </style>
</head>
<body>

<h1>Your tip Results</h1>

<fieldset>

	<legend>Tip Results</legend>


	<?php

		 // Get the total, the tip dividend, and the num of people splitting from form
		 $checkAmt = $_GET['checkAmt'];

		 $tipDividend = $_GET['service'];

		 $numSplit = $_GET['split'];

		 // Change dividend from percentage to decimal, use it to get the tip amount, then add to the initial total for the new total
		 $decimalDividend = $tipDividend/100;
		 $tip = $checkAmt * $decimalDividend;
		 $totalOwed = $checkAmt + $tip;

		 // Divide the new total by the number of people splitting to get a total per person
		 $perPerson = $totalOwed / $numSplit;

		 // Format numbers to print to 2 sig figs
		 $checkAmtSplit = number_format($checkAmt,2);
		 $tipSplit = number_format($tip,2);
		 $totalOwedSplit = number_format($totalOwed,2);
		 $perPersonSplit = number_format($perPerson,2);


		 // Print The initial total, the tip, the new total, the number of people splitting, then the per person total
		 echo "You owe: <b>$$checkAmtSplit</b>";
		 echo "<ul><li>The tip is: <b>$$tipSplit</b></li>";
		 echo "<li>Your total is: <b>$$totalOwedSplit</b></li>";
		 echo "<li>Splitting it <b>$numSplit</b> way(s)</li>";
		 echo "<li>So each person owes: <b>$$perPersonSplit</b></li></ul>";
	?>

	<br>

	<!--
	Anchor back to first page to recalculate tip
		-->
	<a href="http://cscilab.bc.edu/~oconnonx/hw3/hw3.php">Click here to calculate another tip!</a>

</fieldset>

</body>
</html>