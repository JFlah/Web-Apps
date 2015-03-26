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

     		<!-- =============================== -->
     		<!-- Functions to validate join form -->
     		<!-- =============================== -->

	 		function validate(){
	 			var validName = validateName();
				var validEmail = validateEmail();
				var validPW = validatePassword();
				var validMatch = validatePasswordMatch();
				var validMem = validateMembership();

				if (validName && validEmail && validPassword && validMatch && validMem){
					return true;
				}
	 			return false;
	 		}

	 		function validateName(){
	 			var thename= document.getElementById("name").value ;

	 			if (thename.length < 1) {
	 				var errorrpt=document.getElementById("nameerror");
	 				errorrpt.innerHTML = "Please enter a name";
	 				return false;
	 			}
	 			var errorrpt=document.getElementById("nameerror");
	 			errorrpt.innerHTML = "";

	 			return true;
	 		}

	 		function validateEmail(){
	 			var theemail = document.getElementById("email").value;
	 			var emailregex=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/;

	 			if (!emailregex.test(theemail)){
	 				var errorrpt=document.getElementById("emailerror");
					errorrpt.innerHTML = "Please enter your valid email address";
					return false;
				}
				var errorrpt=document.getElementById("emailerror");
				errorrpt.innerHTML = "";

	 			return true;
	 		}

	 		function validatePassword(){
	 			var thepassword = document.getElementById("password").value;

	 			if (thepassword.length < 6) {
	 				var errorrpt=document.getElementById("passworderror");
					errorrpt.innerHTML = "Password is too short";
					return false;
				}


				var errorrpt=document.getElementById("passworderror");
				errorrpt.innerHTML = "";

	 			return true;
	 		}

	 		function validatePasswordMatch(){
	 			var theconfirmpassword = document.getElementById("confirmpassword").value;
	 			var thepassword = document.getElementById("password").value;

				if (thepassword != theconfirmpassword){
					var errorrpt = document.getElementById("confirmpassworderror");
					errorrpt.innerHTML = "Password did not match the one above";
					return false;
				}

				var errorrpt=document.getElementById("confirmpassworderror");
				errorrpt.innerHTML = "";

				return true;
			}

			function validateMembership(){
				var themembership = document.forms["joinform"].memtype;
				var memlength = themembership.length;

				for (var i = 0; i < memlength; i++){
					if (themembership[i].checked) {
						var errorrpt=document.getElementById("memtypeerror");
						errorrpt.innerHTML = "";

						return true;
					}
				}

				var errorrpt = document.getElementById("memtypeerror");
				errorrpt.innerHTML = "Pick a membership type";
				return false;

			}


	</script>
</head>
<body>

	<h1>BC Computer Science Society</h1>

	<?php
		if ( isset( $_GET['join'] ) ) {
			displayjoin();
		}
		if ( isset( $_GET['forgotpw'] ) ) {
			displayforgot();
			if ( isset ( $_POST['forgotpwsub'] ) ) {
				handleforgot();
			}
		}

		displayhome();
	?>

</body>
</html>

<?php
function displayhome(){

?>
	<form method="get">
		<fieldset>

		<legend>Welcome to the club</legend>

		<div class="picLeft" id="p">
				<img src="img/hacker.jpg" alt="hacker pic" height="400" width="500"><br>
				<p>
				Image source: https://zacharydiamond.files.wordpress.com/2014/12/ski-mask-hacker-2.jpg?w=470&h=140&crop=1
				</p>
		</div><br>

		<div class="floatRight" id="sizes">
			<label>Some important links</label><br>
			<a href="https://github.com/jflah">Click here for my github!</a><br>
			<a href="http://linkedin.com/in/jflah">Click here to network with me</a><br>
			<a href="https://github.com/bccss">Our github</a><br>
		</div><br><br><br><br><br><br><br>

		<input class="button" type="submit" name="join" value="Join BCCSS"><br><br><br>
		<input class="button" type="submit" name="forgotpw" value="Forgot my Password"><br><br><br>

		<div class="floatRight">
					<?php
					//initialize news source

					$rss_feed = 'http://www.zdnet.com/blog/big-data/rss.xml';

					$rss= new SimpleXMLElement(file_get_contents('http://www.zdnet.com/blog/big-data/rss.xml'));
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
					?>
		</div>

		<br><br><br><br><br><br><br><br><br>



	</fieldset>
	</form>
<?php
}

function displayforgot() {
	?>
	<form method="post">
		<fieldset id="fieldid">
		<legend>Forgot My Password</legend>
		Email:<br>
		<input type='text' name='forgotpwemail'><br>

		<input class='button' type='submit' name='forgotpwsub' value='Get New Password'>

		</fieldset>
	</form>
<?php
}

function handleforgot() {
	$email = $_POST['forgotpwemail'];

	//Connect and Query
	$dbc = connectToDB('oconnonx');
	$emailQuery = "SELECT * from myclub where email='$email'";
	$result = performQuery($dbc, $emailQuery);

	// Check if email already in db
	$rows = mysqli_num_rows($result);

	// if not in db, send them back
	if ($rows == 0){
		die("<h1>Email is not in BCCSS</h1><br>
			<h1><a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php?forgotpw=Forgot+my+Password'>Try Again</a></h1>");
	}

	$randpw = createpassword();
	$randpwsha1 = sha1($randpw);

	$to = $email;
	$subject = "Your new temporary password for BCCSS";
	$body = "Your new password is: $randpw";
	$headers = "From: oconnonx@bc.edu";

	mail($to, $subject, $body, $headers);

	mysqli_free_result($result);

	// update pw for user in database

	$updateQuery = "update myclub set password='$randpwsha1' where email='$email'";
	$updateResult = performQuery($dbc, $updateQuery);
	if (!$updateResult){
		echo "<h1>Update failed</h1>";
	}

	echo "<h1>New password sent, check email inbox!</h1><br>
			<h1><a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php'>Go Home</a></h1>";
}

function displayjoin() {
	?>
	<form method="post" name="joinform" action="http://cscilab.bc.edu/~oconnonx/BCCSS/include/dboperation.php" onsubmit="return validate()">
		<fieldset id="fieldid">
		<legend>Complete Form to Join BCCSS</legend>
		Name:
		<input type='text' name='name' id='name'>
		<span id='nameerror'></span><br>
		Email:
		<input type='text' name='email' id='email'>
		<span id='emailerror'></span><br>
		Password:
		<input type='password' name='password' id='password'>
		<span id='passworderror'></span><br>
		Confirm Password:
		<input type='password' name='confirmpassword' id='confirmpassword'>
		<span id='confirmpassworderror'></span><br>
		Membership type:
		Peasant <input type='radio' name='memtype' id='memtype' value='Peasant'>
		Hacker <input type='radio' name='memtype' id='memtype' value='Hacker'>
		Turing <input type='radio' name='memtype' id='memtype' value='Turing'>
		<span id='memtypeerror'></span><br>
		<input class='buttonleft' type='submit' name='infojoin' id='infojoin' value='Submit Info'>

		</fieldset>
	</form>

	<?php
}

function createpassword() {// start with an empty password
	$password="";

	//define possible characters
	$possible="23456789abcdefghjklmnpwrstuvwxyz";

	$length=8;

	for ($i=1; $i<=$length; $i++){
		$pick=rand(0, strlen($possible)-1);

		// pick a random character from the possible characters
		$passchar=substr($possible, $pick, 1);

		$password .= $passchar;
	}
	return $password;
}

?>