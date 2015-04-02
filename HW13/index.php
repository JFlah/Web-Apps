<?php
include ('include/dbconn.php');
?>
<!DOCTYPE html>

<!--
	HW13 Best of BC
	Author: Jack Flaherty
-->

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Best of BC</title>
	<link rel="stylesheet" type="text/css" href="CSS/BoBC.css">
	<script type="text/javascript">

			<!-- =============================== -->
     		<!-- Functions to validate add form  -->
     		<!-- =============================== -->

     		function validate(){
     			var validName = validateName();
     			var validStars = validateStars();
     			var validPrice = validatePrice();
     			var validCategory = validateCategory();
     			var validAddress = validateAddress();
     			var validPhone = validatePhone();
     			var validUrl = validateUrl();
     			var validId = validateId();
     			var validComment = validateComment();

     			if (validName && validStars && validPrice
     					&& validCategory && validAddress && validPhone
     					&& validUrl && validId && validComment){
     				return true;
     			}
     			return false;
     		}

     		function validateName(){
	 			var thename= document.getElementById("name").value;

	 			if (thename.length < 1) {
	 				var errorrpt=document.getElementById("nameerror");
	 				errorrpt.innerHTML = "Please enter a name";
	 				return false;
	 			}
	 			var errorrpt=document.getElementById("nameerror");
	 			errorrpt.innerHTML = "";

	 			return true;
     		}

     		function validateStars(){
     			var thestars = document.getElementById("stars");
     			if (thestars.selectedIndex == 0){
     				var errorrpt=document.getElementById("starserror");
     				errorrpt.innerHTML="Please pick a rating";
     				return false;
     			}
     			var errorrpt=document.getElementById("starserror");
     			errorrpt.innerHTML="";
     			return true;
     		}

     		function validatePrice(){
     			var theprice = document.getElementById("price");
     			if (theprice.selectedIndex == 0){
     				var errorrpt=document.getElementById("priceerror");
     				errorrpt.innerHTML="Please pick a price rating";
     				return false;
     			}
     			var errorrpt=document.getElementById("priceerror");
     			errorrpt.innerHTML="";
     			return true;
     		}

     		function validateCategory(){
	 			var thecategory= document.getElementById("category");

	 			if (thecategory.selectedIndex == 1) {
	 				var errorrpt=document.getElementById("categoryerror");
	 				errorrpt.innerHTML = "Please enter a category";
	 				return false;
	 			}
	 			var errorrpt=document.getElementById("categoryerror");
	 			errorrpt.innerHTML = "";

	 			return true;
     		}

     		function validateAddress(){
     			var theaddress = document.getElementById("address").value;

     			if (theaddress.length < 5) {
     				var errorrpt=document.getElementById("addresserror");
     				errorrpt.innerHTML="Please enter a good address";
     				return false;
     			}
     			var errorrpt=document.getElementById("addresserror");
     			errorrpt.innerHTML="";

     			return true;
     		}

     		function validatePhone(){
     			var thephone = document.getElementById("phone").value;
     			var phoneregex=/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/

     			if (!phoneregex.test(thephone)){
     				var errorrpt=document.getElementById("phoneerror");
     				errorrpt.innerHTML="Please enter a valid phone number";
     				return false;
     			}
     			var errorrpt = document.getElementById("phoneerror");
     			errorrpt.innerHTML="";

     			return true;
			}

			function validateUrl(){
				var theurl = document.getElementById("url").value;
				var urlregex=/^www.[A-Za-z0-9]+.[A-Za-z0-9]+$/

				if (!urlregex.test(theurl)){
					var errorrpt=document.getElementById("urlerror");
					errorrpt.innerHTML="Please enter a valid URL";
					return false;
				}
				var errorrpt = document.getElementById("urlerror");
				errorrpt.innerHTML="";

				return true;
			}

			function validateId(){
				var theId = document.getElementById("id").value;
				if (theId.length < 1){
					var errorrpt=document.getElementById("iderror");
					errorrpt.innerHTML="Please enter a valid ID";
					return false;
				}
				var errorrpt = document.getElementById("iderror");
				errorrpt.innerHTML="";

				return true;
			}

			function validateComment(){
				var thecomment = document.getElementById("comment").value;
				if (thecomment.length < 1){
					var errorrpt=document.getElementById("commenterror");
					errorrpt.innerHTML="Please enter a comment!";
					return false;
				}
				var errorrpt=document.getElementById("commenterror");
				errorrpt.innerHTML="";

				return true;
			}


	</script>
</head>
<body>
	<h1>Best of BC</h1>

	<?php
		$op = isset($_GET['op']) ? $_GET['op'] : "";
		switch($op){
			case 'Add Attraction':
				displayInsertAttractionForm();
				displayHomePage("");
				break;
			case 'Search':
				$search = $_GET['searchtxt'];
				displayHomePage($search);
			default:
				displayHomePage("");
				break;
		}
	?>
</body>
</html>

<?php
function displayHomePage($string){
?>
	<form method='get'>
	<fieldset id='fieldid'><legend>Options</legend>
		<input class='button' type='submit' name='op' value='Add Attraction'><br>
		<input type='text' name='searchtxt' id='searchtxt'>
		<input class='button' type='submit' name='op' value='Search'>
	</fieldset>
	</form>
	<br>

<?php
	$dbc = connectToDB('csci2254');
	if ($string==""){
		$tableQuery = "SELECT * from bestofbc";
	} else { 
		$tableQuery = "select * from bestofbc where name like '%$string%'
						or entered_by like '%$string%' or
						category like '%$string%' or address like '%$string%'
						or phone like '%$string%' or url like '%$string%'
						or comment like '%$string%' or phone like '%$string%'";
		echo "<p>Your search results:</p><br>";
	}
	$result = performQuery($dbc, $tableQuery);

	$num_attractions = mysqli_num_rows($result);
	echo "<p>There are $num_attractions attractions listed</p><br>";
	?>

	<table>
	<tr>
		<th>Attraction</th>
		<th>Comment</th>
	</tr>

	<?php

	while (@extract(mysqli_fetch_array($result, MYSQLI_ASSOC))){
		echo "<tr><td>$name $stars $price_range <br> $category <br> $url
					<br> $address $phone</td>";
		echo "<td>$comment</td></tr>";
	}
	disconnectFromDB($dbc);
	?>
	</table>
<?php
}
function displayInsertAttractionForm(){
?>
<form method='post' name='addform' action='http://cscilab.bc.edu/~oconnonx/BestOfBC/include/dboperation.php' onsubmit='return validate()'>
	<fieldset id='fieldid'><legend>Add an Attraction</legend>
		Name:
		<input type='text' name='name' id='name'>
		<span id='nameerror'></span><br>
		Star rating:
		<?php createStarMenu(); ?>
		<span id='starserror'></span><br>
		Price:
		<?php createPriceMenu(); ?>
		<span id='priceerror'></span><br>
		Category:
		<input type='text' name='category' id='category'>
		<span id='categoryerror'></span><br>
		Address:
		<input type='text' name='address' id='address'>
		<span id='addresserror'></span><br>
		Phone: (xxx-xxx-xxxx)
		<input type='text' name='phone' id='phone'>
		<span id='phoneerror'></span><br>
		URL: (www.site_name.site_ending)
		<input type='text' name='url' id='url'>
		<span id='urlerror'></span><br>
		Your UserID:
		<input type='text' name='id' id='id'>
		<span id='iderror'></span><br>
		Comment:<br>
		<input type='text' name='comment' id='comment'>
		<span id='commenterror'></span><br>
		<input class='button' type='submit' name='addsub' value='Add'>
	</fieldset>
</form>

<?php
}

function createStarMenu(){
?>
<select name='stars' id='stars'>
	<option>none</option>
	<option>*</option>
	<option>**</option>
	<option>***</option>
	<option>****</option>
	<option>*****</option>
</select>
<?php
}

function createPriceMenu(){
?>
<select name='price' id='price'>
	<option>none</option>
	<option>$</option>
	<option>$$</option>
	<option>$$$</option>
	<option>$$$$</option>
</select>
<?php
}