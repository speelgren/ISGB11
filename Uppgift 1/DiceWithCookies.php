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

			$disabled = true;

			// Uppgift 1
			if( isset($_POST["btnNewGame"])) {

				$nbrOfRounds = 0;
				$sumOfAllRounds = 0;
				$medel = 0;
				setcookie("nbrOfRounds", $nbrOfRounds, time() + 3600);
				setcookie("sumOfAllRounds", $sumOfAllRounds, time() + 3600);

				echo ("<p>" . "New Game!" . "</p>");
				$disabled = false;
			}

			// Uppgift 2
			if( isset($_COOKIE["nbrOfRounds"])
			&& isset($_COOKIE["sumOfAllRounds"])
			&& !isset($_POST["btnRoll"])
			&& !isset($_POST["btnNewGame"])
			&& !isset($_POST["btnExit"])) {

				echo ("<h6>" . "Antal spel: " . $_COOKIE["nbrOfRounds"] . "</h6>");
				echo ("<h6>" . "Summan av alla spel: " . $_COOKIE["sumOfAllRounds"] . "</h6>");
			}

			// Uppgift 3
			if( isset($_POST["btnRoll"])
			&& isset( $_COOKIE["nbrOfRounds"])
			&& isset($_COOKIE["sumOfAllRounds"])) {

				include 'include/OneDice.php';
				include 'include/SixDices.php';

				$obSixDices = new SixDices();
				$obSixDices->rollDices();

				echo($obSixDices->svgDices());

				$nbrOfRounds = $_COOKIE["nbrOfRounds"];
				$nbrOfRounds++;
				$_COOKIE["nbrOfRounds"] = $nbrOfRounds;

				$sumOfAllRounds = $_COOKIE["sumOfAllRounds"];
				$sumOfAllRounds += $obSixDices->sumDices();
				$_COOKIE["sumOfAllRounds"] = $sumOfAllRounds;

				$medel = $sumOfAllRounds / $nbrOfRounds;

				echo ("<h6>" . "Antal spel: " . $_COOKIE["nbrOfRounds"] . "</h6>");
				echo ("<h6>" . "Summan av alla spel: " . $_COOKIE["sumOfAllRounds"] . "</h6>");
				echo ("<h6>" . "Medelvärdet: ". $medel . "</h6>");

				setcookie("nbrOfRounds", $nbrOfRounds, time() + 3600);
				setcookie("sumOfAllRounds", $sumOfAllRounds, time() + 3600);
				$disabled = false;
			}

			// Uppgift 4
			if( !isset($_COOKIE["nbrOfRounds"])
			&& !isset($_COOKIE["sumOfAllRounds"])) {

				$disabled = false;
			}

			// Disable Exit och Roll Dice.
			if( !isset($_COOKIE["nbrOfRounds"])
			&& !isset($_COOKIE["sumOfAllRounds"])
			&& !isset($_POST["btnRoll"])
			&& !isset($_POST["btnNewGame"])
			&& !isset($_POST["btnExit"])) {

				$disabled = true;
			}

			if( isset($_POST["btnExit"])
			&& isset($_COOKIE["nbrOfRounds"])
			&& isset($_COOKIE["sumOfAllRounds"])) {

				setcookie("nbrOfRounds", "", time() - 3600);
				setcookie("sumOfAllRounds", "", time() - 3600);

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
