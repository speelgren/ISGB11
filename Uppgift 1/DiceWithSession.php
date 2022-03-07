<!doctype html>
<html lang="en" >

	<head>
		<meta charset="utf-8" />
		<title>Roll the dice...</title>
		<link href="style/style.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>

	<body>

		<div>
			<?php

				//Var uppmärksam på att PHP-tolken används på ett flertal ställen i filen!

				session_start();
				include 'include/OneDice.php';
				include 'include/SixDices.php';
				$disabled = false;



			?>
		</div>

		<a href="<?php ?>?linkRoll=true" class="btn btn-primary<?php if($disabled) { echo("disabled"); ?>">Roll six dices</a>
		<a href="<?php ?>?linkNewGame=true" class="btn btn-primary">New game</a>
		<a href="<?php ?>?linkExit=true" class="btn btn-primary<?php if($disabled) { echo("disabled"); ?>">Exit</a>

		<script src="script/animation.js"></script>

	</body>

</html>
