<?php
include ('include/dbconn.php');
?>
<!DOCTYPE html>

<!--
	HW12 Club 2
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>BC Computer Science Society</title>
     <link rel="stylesheet" type="text/css" href="css/bccss.css">
     <script type="text/javascript">


     		<!-- ===================================== -->
     		<!-- Functions to validate admin mail form -->
     		<!-- ===================================== -->

     		function validateadmin(){
     			var validSub = validateSubject();
     			var validBody = validateBody();
     			var validPW = validateAdminPassword();
     			var validMemAdmin = validateMemAdmin();

     			if (validSub && validBody && validPW && validMemAdmin){
     				return true;
     			}
     			return false;
     		}

     		function validateSubject() {
     			var thesubject = document.getElementById('adminsubject').value;

     			if (thesubject.length < 1) {
     				var errorrpt=document.getElementById('adminsubjecterror');
     				errorrpt.innerHTML = "Please enter a subject";
     				return false;
     			}
     			var errorrpt=document.getElementById('adminsubjecterror');
     			errorrpt.innerHTML = "";

     			return true;
     		}

     		function validateBody(){
     			var thebody = document.getElementById('adminemail').value;

     			if (thebody.length < 1){
     				var errorrpt=document.getElementById('adminemailerror');
				    errorrpt.innerHTML = "Please enter a message";
				    return false;
				}
				var errorrpt=document.getElementById('adminemailerror');
				errorrpt.innerHTML = "";

     			return true;
     		}

     		function validateAdminPassword() {
     			var thepassword = document.getElementById('adminpassword').value;

     			if (thepassword.length < 1){
     				var errorrpt=document.getElementById("adminpassworderror");
					errorrpt.innerHTML = "Please enter a password";
	 				return false;
     			}

     			var errorrpt=document.getElementById("adminpassworderror");
				errorrpt.innerHTML = "";

	 			return true;
     		}

     		function validateMemAdmin() {
     			var themembership = document.forms["adminform"].memtypeadmin;
				var memlength = themembership.length;

				for (var i = 0; i < memlength; i++){
					if (themembership[i].checked) {
						var errorrpt=document.getElementById("memtypeadminerror");
						errorrpt.innerHTML = "";

						return true;
					}
				}

				var errorrpt = document.getElementById("memtypeadminerror");
				errorrpt.innerHTML = "Pick a membership class";
				return false;
     		}
     	</script>
</head>
<body>

	<h1>Admin Console</h1>

	<?php
		displayadmin();
		if (isset($_POST['adminsend'])){
			handleadmin();
		}
	?>

</body>
</html>

<?php

function displayadmin() {
?>
	<fieldset>
		<table>
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Email</th>
				<th>Registration Date</th>
			</tr>
			<?php
			$dbc = connectToDB('oconnonx');
			$tableQuery = "SELECT name, membership_type, email, registration_date from myclub";
			$result = performQuery($dbc, $tableQuery);

			$i = 0;

			while (@extract(mysqli_fetch_array($result, MYSQLI_ASSOC))){
				if ($i % 2 == 0){
					echo "<tr bgcolor='#6A5ACD'><td>$name</td>";
					echo "<td>$membership_type</td>";
					echo "<td>$email</td>";
					echo "<td>$registration_date</td></tr>";
				} else {
					echo "<tr bgcolor='#FFD700'><td>$name</td>";
					echo "<td>$membership_type</td>";
					echo "<td>$email</td>";
					echo "<td>$registration_date</td></tr>";
				}

				$i++;

			}
			disconnectFromDB($dbc);

			?>
		</table>
	</fieldset>



	<form method="post" name="adminform" onsubmit="return validateadmin()">
		<fieldset id="fieldid"><legend>Create Group Mail</legend>
			Subject:
			<input type='text' name='adminsubject' id='adminsubject'>
			<span id='adminsubjecterror'></span><br>
			Body:
			<input type='text' name='adminemail' id='adminemail'>
			<span id='adminemailerror'></span><br>
			Admin Password:
			<input type='password' name='adminpassword' id='adminpassword'>
			<span id='adminpassworderror'></span><br>
			Membership class:
			Peasant <input type='checkbox' name='memtypeadmin' id='memtypeadmin' value='Peasant'>
			Hacker <input type='checkbox' name='memtypeadmin' id='memtypeadmin' value='Hacker'>
			Turing <input type='checkbox' name='memtypeadmin' id='memtypeadmin' value='Turing'>
			<span id='memtypeadminerror'></span><br>
			<input class='buttonleft' type='submit' name='adminsend' id='adminsend' value='Send Mail'>

		</fieldset>
	</form>

<?php
}

// handleadmin
function handleadmin(){
	// Make sure all got filled out

	if (!isset($_POST['adminsubject']) || !isset($_POST['adminemail']) || !isset($_POST['adminpassword']) || !isset($_POST['memtypeadmin']) ) {
		die("<h1>Please fill out all the fields.</h1><br>");
	}

	// Get everything
	$subject = $_POST['adminsubject'];
	$body = $_POST['adminemail'];
	$pw = $_POST['adminpassword'];
	$shapw = sha1( $pw );
	$memtypeadmin = $_POST['memtypeadmin'];


	if ($shapw != '1785ed6ccf537856a2e5d0935a1ffb2dde2d3ab5'){
		die("<h1>Wrong password</h1><br>");
	}

	$dbc = connectToDB('oconnonx');
	$tableQuery = "SELECT email from myclub where membership_type='$memtypeadmin'";
	$result = performQuery($dbc, $tableQuery);

	while (@extract(mysqli_fetch_array($result, MYSQLI_ASSOC))){
		$to = $email;
		$subject = $subject;
		$body = $body;
		$headers = "From: oconnonx@bc.edu";

		mail($to, $subject, $body, $headers);

	}

	echo "<h1>Mail sent</h1>";

	disconnectFromDB($dbc);
}
?>