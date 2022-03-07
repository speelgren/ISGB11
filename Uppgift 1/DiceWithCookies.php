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

			include 'include/OneDice.php';
			include 'include/SixDices.php';
			$disabled = true;
			$newGame = 'New Game!';

			// Skapar variabler för knappar.
			$btnRoll = $_POST["btnSend"];
			$btnNewGame = $_POST["btnNewGame"];
			$btnExit = $_POST["btnExit"];

			// Uppgift 1
			if( isset($_POST["btnNewGame"])) {
				echo ("<p>" . $newGame . "</p>");

				$nbrOfRounds = 0;
				$sumOfAllRounds = 0;
				$median = $nbrOfRounds / $sumOfAllRounds;
				setcookie("nbrOfRounds", $nbrOfRounds, time() + 3600);
				setcookie("sumOfAllRounds", $sumOfAllRounds, time() + 3600);

			}
			// Uppgift 2
			if( isset($nbrOfRounds)
			&& isset($sumOfAllRounds)
			&& !isset($_POST["btnRoll"])
			&& !isset($_POST["btnNewGame"])
			&& !isset($_POST["btnExit"])) {

				echo ($nbrOfRounds);
				echo ($sumOfAllRounds);
				echo ($median);

				$nbrOfRounds++;
				$sumOfAllRounds += $nbrOfRounds;

			}

			// Uppgift 3
			if( isset($_POST["btnRoll"])
			&& isset( $_COOKIE["nbrOfRounds"])
			&& isset($_COOKIE["sumOfAllRounds"])) {

				// echo (dumpDices())
				sixDices->dumpDices();

				echo ($nbrOfRounds);
				echo ($sumOfAllRounds);
				echo ($median);

				$nbrOfRounds++;
				$sumOfAllRounds += $nbrOfRounds;

			}

			if( !isset($_COOKIE["nbrOfRounds"])
			&& !isset($_COOKIE["sumOfAllRounds"])) {

				$disabled = false;

			}

			if( isset($_POST["btnExit"])
			&& isset($_COOKIE["nbrOfRounds"])
			&& isset($_COOKIE["sumOfAllRounds"])) {

				setcookies("nbrOfRounds", "", time() - 3600);
				setcookies("sumOfAllRounds", "", time() - 3600);

				$disabled = true;

			}

			?>
		</div>

		<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
			<input type="submit" name="btnRoll" class="btn btn-primary" value="Roll six dices" <?php if($disabled) { echo("disabled"); } ?>/>
			<input type="submit" name="btnNewGame" class="btn btn-primary" value="New Game" />
			<input type="submit" name="btnExit" class="btn btn-primary" value="Exit" <?php if($disabled) { echo("disabled"); } ?>/>
		</form>

		<script src="script/animation.js"></script>
	</body>

</html>
