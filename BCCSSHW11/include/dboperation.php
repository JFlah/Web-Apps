<?php
include ('dbconn.php');
?>

<!DOCTYPE html>

<!--
	HW11 Club Assignment Join Handler
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>BC Computer Science Society</title>
     <link rel="stylesheet" type="text/css" href="../css/bccss.css">
</head>
<body>

<!--
<?php
echo "<pre>";
print_r( $_POST );
echo "</pre>\n";
?>
-->

<?php
// Make sure all got filled out

if (!isset($_POST['password']) || !isset($_POST['confirmpassword']) || !isset($_POST['email']) || !isset($_POST['name']) || !isset($_POST['memtype'])) {
	die("<h1>Please fill out all the fields.</h1><br>
		<h1><a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php?join=Join+BCCSS'>Try Again</a></h1>");
}

// Get everything
$pw = $_POST['password'];
$pwmatch = $_POST['confirmpassword'];
$email = $_POST['email'];
$name = $_POST['name'];
$memb = $_POST['memtype'];

if ($pw != $pwmatch){
	die("<h1>Passwords did not match.</h1><br>
		<h1><a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php?join=Join+BCCSS'>Try Again</a></h1>");
}

//Connect and Query
$dbc = connectToDB('oconnonx');
$emailQuery = "SELECT * from myclub where email='$email'";
$result = performQuery($dbc, $emailQuery);

// Check if email already in db
$rows = mysqli_num_rows($result);

if ($rows != 0){
	die("<h1>Email is already in use</h1><br>
		<h1><a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php?join=Join+BCCSS'>Try Again</a></h1>");
}

disconnectFromDB($dbc);

//Add person to DB
$pwsha1 = sha1($pw);
$dbc = connectToDB('oconnonx');
$addQuery = "insert into myclub(
		name,
        email,
        password,
        registration_date,
        membership_type) values ('$name', '$email', '$pwsha1', now(), '$memb')";
$addResult = performQuery($dbc, $addQuery);

if ($addResult) {
	echo "<h1>Congratulations $name, you are now a member of the BCCSS!</h1><br>";
	echo "<h1>Head back to the <a href='http://cscilab.bc.edu/~oconnonx/BCCSS/index.php?'>Home Page</a></h1>";
}
else {
	echo "<h1>Something went horribly wrong...</h1>";
}
disconnectFromDB($dbc);



?>

</body>
</html>
