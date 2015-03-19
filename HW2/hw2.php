<!DOCTYPE html>

<html lang="en">
<head>
     <meta charset="utf-8" />
     <title>HW2</title>
     <style>
     	h1 { font-family: impact;
     			color: black;
     			background-color: yellow;
     			text-align: center }
     	body { font-family: Helvetica;
     				background-color: darkgray;
     				font-size:1.5em }
     	legend { background-color: yellow;
     				font-weight: bold;
     				font-family: impact }
     	label { background-color: yellow }
     	img { float:right }
     	p { font-size:xx-small;
     			float:right }
     </style>
</head>

<body>

	<fieldset>
		<h1>2014 Best Picture</h1>
	</fieldset>

	<form method="post" action="http://cscilab.bc.edu/~turinga/hw2/hw2action.php">

	<fieldset>
		<legend>Who do ya got?!</legend>

				<label>Have you seen any of these movies?</label>
				<br>
				Heck yes! --> <input type="radio" name="Enjoy movies" value="Yes" />
				Hate the movies --> <input type="radio" name="Enjoy movies" value="No" />

				<br>

				<label>Check if you watched the 2014 Awards</label>
				<input type="checkbox" name="Viewed 2014 Oscars" value="Yes" />

				<br><br>

				<img src="oscars.jpg" alt="side pic" height="500" width="500">

				<label>Which of this year's candidates was your favorite?</label>
				<br>
				<select name="Favorite movie" size="8" multiple="multiple">
						<option value="American Sniper">American Sniper</option>
						<option value="Birdman or (The Unexpected Virtue of Ignorance)">Birdman or (The Unexpected Virtue of Ignorance)</option>
						<option value="Boyhood">Boyhood</option>
						<option value="The Grand Budapest Hotel">The Grand Budapest Hotel</option>
						<option value="The Imitation Game">The Imitation Game</option>
						<option value="Selma">Selma</option>
						<option value="The Theory of Everything">The Theory of Everything</option>
						<option value="Whiplash">Whiplash</option>
				</select>

				<br><br>

				<label>Random: Who is your favorite hip hop artist?</label>
				<br>
				<select name="Favorite rapper" size="3">
						<option value="None">None</option>
						<option value="French Montana">French Montana</option>
						<option value="French Montana">or French Montana</option>
				</select>

				<br><br>

				<textarea name="Location">
Where ya from?
				</textarea>

				<br><br>

				<label>Please enter your name:</label>
				<input type="text" name="Name" />

				<br>

				<label>Please enter your email:</label>
				<input type="text" name="EMail" />

				<br>

				<input type="hidden" name="Recipient" value="oconnonx@bc.edu" />
				<input type="hidden" name="Subject" value="Your results!" />

				<br><br>

				<p>
					Image source: http://bgr.com/2015/01/15/2015-academy-awards-nominations/
				</p>

				<br>

				<button type="submit" value="Submit">Submit</button>
				<button type="reset" value="Reset">Reset</button>

	</fieldset>

	</form>

</body>
</html>