<!DOCTYPE html>

<!--
	HW11 Club Assignment
 	Author: Jack Flaherty
 -->

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>BC Computer Science Society</title>
     <link rel="stylesheet" type="text/css" href="css/bccss.css">
</head>
<body>

	<h1>BC Computer Science Society</h1>

	<?php


		if ( isset( $_GET['join'] ) ) {
			handlejoin();
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

		<input class="button" type="submit" name="join" value="Join BCCSS"><br>

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

function handlejoin() {
	?>
	<form method="post" action="http://cscilab.bc.edu/~oconnonx/BCCSS/include/dboperation.php">
		<fieldset id="fieldid">
		<legend>Complete Form to Join BCCSS</legend>
		Name:
		<input type='text' name='name'><br>
		Email:
		<input type='text' name='email'><br>
		Password:
		<input type='password' name='password'><br>
		Confirm Password:
		<input type='password' name='confirmpassword'><br>
		Membership type:
		Peasant <input type='radio' name='memtype' value='Peasant'>
		Hacker <input type='radio' name='memtype' value='Hacker'>
		Turing <input type='radio' name='memtype' value='Turing'><br>
		<input class='buttonleft' type='submit' name='infojoin' value='Submit Info'>

		</fieldset>
	</form>

	<?php
}