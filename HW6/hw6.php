<!DOCTYPE html>

<!--
	HW6
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW6</title>
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

	<h1>Build your Pizza</h1>

	<?php

		displayform();
		if ( isset( $_GET['crust_options']) || isset( $_GET['veggie_options_'])
		 || isset( $_GET['size_options']) || isset( $_GET['meat_options_']) ) {
			handleform();
		}

	?>

</body>
</html>

<?php
function displayform(){

//initialize arrays of options

$meat_options = array("pepperoni", "sausage", "BBQ chicken", "proscutto", "ham");
$veggie_options = array("mushrooms", "peppers", "onions", "tomatoes", "spinach");
$crust_options = array("white", "whole wheat", "stuffed");
$size_options = array("small", "medium", "large");

?>

	<form method="get">
		<fieldset>

		<legend>Choose your options</legend>

		<div class="floatRight">
		<label>Choose your crust(required)</label><br>
		<?php
			create_radiobuttons($crust_options, 'crust_options');
		?>
		</div>

		<div class="floatLeft" id="veggies">
		<label>Choose your veggie(s)</label><br>
		<?php
			create_checkboxes($veggie_options, 'veggie_options');
		?>
		</div><br>

		<div class="floatRight" id="sizes">
		<label>Choose your size(required)</label><br>
		<?php
			create_radiobuttons($size_options, 'size_options');
		?>
		</div>

		<div class="floatLeft" id="meats">
		<label>Choose your meat(s)</label><br>
		<?php
			create_checkboxes($meat_options, 'meat_options');
		?>
		</div>

		<br><br><br><br><br><br><br><br><br>

		<button type="submit" value="submitted">Place Your Order</button>

	</fieldset>
	</form>
<?php
}

function handleform() {
	// echo "<pre>";
	// print_r( $_GET );
	// echo "</pre>\n";

	// Check to ensure user chose crust and size, die if not

	if ( !isset($_GET['crust_options']) || !isset($_GET['size_options']) ) {
		die("<div class='bold'>You must choose a crust and a size, resubmit your order please!</div>");
	}

	?>

	<?php

	// constants for price arithmetic

	DEFINE ("VEGGIE_PRICE", 1.0);
	DEFINE ("MEAT_PRICE", 2.0);
	DEFINE ("SMALL_PRICE", 9.0);
	DEFINE ("MEDIUM_PRICE", 11.0);
	DEFINE ("LARGE_PRICE", 14.0);

	// Determine type of crust

	if ($_GET['crust_options']=="white") {
		$crust = "white";
	}
	else if ($_GET['crust_options']=="whole weat") {
		$crust = "whole weat";
	}
	else {
		$crust = "stuffed";
	}


	// Determine base price and size of pizza

	// $size_array = $_GET['size_options_'];
	// $size_imploded = implode("", $size_array);

	if ($_GET['size_options']=="small") {
		$price = SMALL_PRICE;
		$size = "small ($9)";
	}
	else if ($_GET['size_options']=="medium") {
		$price = MEDIUM_PRICE;
		$size = "medium ($11)";
	}
	else {
		$price = LARGE_PRICE;
		$size = "large ($14)";
	}

	// Check if arithmetic for veggies/meats is needed

	if (isset($_GET['veggie_options_'])) {
		$veggie = $_GET['veggie_options_'];
		$num_veggies = count($veggie);
		$price += ($num_veggies * VEGGIE_PRICE);
	}
	if (isset($_GET['meat_options_'])) {
		$meat = $_GET['meat_options_'];
		$num_meats = count($meat);
		$price += ($num_meats * MEAT_PRICE);
	}

	?>

	<fieldset id="fieldid">
	<legend>Order Summary</legend>

		<div class="picRight">
		<img src="pizza.jpg" alt="pizza pic" height="400" width="500"><br>
		<p>
		Image source: http://fineartamerica.com/art/paintings/abstract+pizza/all
		</p>
		</div>

		<h1>Thank you for your order!</h1><br>

		<?php

		echo "You ordered a $size pizza with a $crust crust\n<br>";
		echo "Your toppings are:\n<br>";

		// Check if we must show meat or veggies lists (i.e. user chose some)

		if ( !isset($num_meats) && !isset($num_veggies) ) {
			echo "No toppings\n<br>";
		}
		else {

			if (isset($num_meats)) {
				echo "Meats ($2 ea.):\n";
				echo implode(", ", $meat);
				echo "\n<br>";
			}

			if (isset($num_veggies)) {
				echo "Veggies ($1 ea.):\n";
				echo implode(", ", $veggie);
				echo "<br>\n";
			}

		}

		// format price amount

		setlocale(LC_MONETARY, 'en_US');
		$price = money_format('%(#5n', $price) . "\n";

		echo "<br>Amount due: $price";

		?>



	</fieldset>

	<?php
}

function create_radiobuttons($values, $varname) {
	echo "<div class='mycb'>";
	foreach($values as $valuesitem) {
		echo "<input type='radio' name='$varname' value='$valuesitem'> $valuesitem <br>\n";
	}
	echo "</div>";
}

function create_checkboxes($values, $varname) {
	echo "<div class='mycb'>";
	foreach($values as $valuesitem) {
		echo "<input type='checkbox' name='$varname []' value='$valuesitem'> $valuesitem <br>\n";
	}
	echo "</div>";
}

?>