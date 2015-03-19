<!DOCTYPE html>

<!--
	HW7
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW7</title>
     <style type="text/css">
     	body { font-family: Helvetica;
     				background-color: steelblue;
     				font-size: 1.5em }
     	h1 { font-family: impact;
     			text-align: center;
     			color: tan }
     	#fieldid { font-weight: bold;
     				font-size: 150%;
     				color: tan }
     	legend { font-weight: bold;
     				font-family: impact;
     				color: tan}
     	.floatLeft { float: left;
     				color: lightgray;
     				background-color: tan }
     	.floatRight { float: right;
     					color: lightgray;
     					background-color: tan }
     	.picRight { float: right }
     	.mycb { font-size: 150% }
     	.bold { font-weight: bold;
     			font-size: 200%;
     			color: red }
     	#veggies { background-color: darkseagreen }
     	#meats { background-color: salmon }
     	#sizes { background-color: slategray }
     	p { font-size: xx-small;
     		color: black }
     	button { font-weight: bold;
     				font-size: xx-large;
     				color: tan;
     				background-color: steelblue }
     	table { color: tan }
     	label { font-weight: bold }
     </style>
</head>
<body>
	<?php
		$statecapital = array ( // makes our map
		'Alabama' => 'Montgomery',
		'Alaska' => 'Juneau',
		'Arizona' => 'Phoenix',
		'Arkansas' => 'Little Rock',
		'California' => 'Sacramento',
		'Colorado' => 'Denver',
		'Connecticut' => 'Hartford',
		'Delaware' => 'Dover',
		'Florida' => 'Tallahassee',
		'Georgia' => 'Atlanta',
		'Hawaii' => 'Honolulu',
		'Idaho' => 'Boise',
		'Illinois' => 'Springfield',
		'Indiana' => 'Indianapolis',
		'Iowa' => 'Des Moines',
		'Kansas' => 'Topeka',
		'Kentucky' => 'Frankfort',
		'Louisiana' => 'Baton Rouge',
		'Maine' => 'Augusta',
		'Maryland' => 'Annapolis',
		'Massachusetts' => 'Boston',
		'Michigan' => 'Lansing',
		'Minnesota' => 'St. Paul',
		'Mississippi' => 'Jackson',
		'Missouri' => 'Jefferson City',
		'Montana' => 'Helena',
		'Nebraska' => 'Lincoln',
		'Nevada' => 'Carson City',
		'New Hampshire' => 'Concord',
		'New Jersey' => 'Trenton',
		'New Mexico' => 'Santa Fe',
		'New York' => 'Albany',
		'North Carolina' => 'Raleigh',
		'North Dakota' => 'Bismarck',
		'Ohio' => 'Columbus',
		'Oklahoma' => 'Oklahoma City',
		'Oregon' => 'Salem',
		'Pennsylvania' => 'Harrisburg',
		'Rhode Island' => 'Providence',
		'South Carolina' => 'Columbia',
		'South Dakota' => 'Pierre',
		'Tennessee' => 'Nashville',
		'Texas' => 'Austin',
		'Utah' => 'Salt Lake City',
		'Vermont' => 'Montpelier',
		'Virginia' => 'Richmond',
		'Washington' => 'Olympia',
		'West Virginia' => 'Charleston',
		'Wisconsin' => 'Madison',
		'Wyoming' => 'Cheyenne');

	?>


	<h1>Are You Smarter Than a 5th Grader?!</h1>

	<?php
	$total=0;
	$num_correct=0;

	if (isset($_GET['capital'])) {

		$state=$_GET['state'];

		$capital=$_GET['capital'];

		$iscorrect = check($statecapital, $state, $capital);

		$total = $_GET['total'];

		$num_correct = $_GET['num_correct'];

		if ($iscorrect) {
			$num_correct++;
		}

		$total++;

		handleform($iscorrect, $total, $num_correct, $statecapital);
	}

	displayform($statecapital, $total, $correct);

	?>

</body>
</html>

<?php
function displayform($list, $total, $correct){

	$state = array_rand($list, 1);
?>


	<fieldset id="fieldid">

		<legend>What is the capital of <?php echo $state ?>? </legend><br>

		<form method="get">
		<input type="hidden" name="state" value="<?php echo $state ?>">
		<input type="hidden" name="correct" value="<?php echo $correct ?>">
		<input type="hidden" name="total" value="<?php echo $total ?>">

		<?php
			$menuname="capitals";
			make_state_pulldown($menuname, $list); ?>

		<input value="Submit" name="pressed" type="submit">

		</form>
	</fieldset>



<?php
}

function handleform($iscorrect, $total, $correct, $list) {

	$state = $_GET['state'];
	$capital = $_GET['capital'];

	if ($iscorrect) {
		echo "<fieldset><legend>You are smarter!</legend><br><br>
				Capital of $state is <h4>$list[$state]</h4><br><br>
				You have answered $correct out of $total question(s) right!</fieldset>";
	}
	else {
		echo "<fieldset><legend>You should know better!</legend><br><br>
				Capital of $state is <h4>$list[$state]</h4><br><br>
				You have answered $correct out of $total question(s) right!</fieldset>";
	}

}

	?>

	<?php

function make_state_pulldown($name, $list) {
	asort($list);

	echo "<select name=$name class='mymenu'>";

	foreach ($list as $key => $value) {
		if (isset($_GET['capital'])) {
			if ($value==$_GET['capital']) {
				echo "<option selected='selected'>$value</option>";
			}
			else {
				echo "<option>$value</option>";
			}
		}
		else {
			echo "<option>$value</option>";
		}
	}
	echo "</select>";

}

function check_true($list,$state,$capital) {
	if($list[$state] == $capital){
		return true;
	}
	else {
		return false;
	}
}

	?>
