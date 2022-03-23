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

			// Funktion från Peter Bellströms föreläsning 4.
			function deleteSession() {

				session_unset();

				if( ini_get("session.use_cookies")) {

					$sessionCookieData = session_get_cookie_params();
					$path = $sessionCookieData["path"];
					$domain = $sessionCookieData["domain"];
					$secure = $sessionCookieData["secure"];
					$httponly = $sessionCookieData["httponly"];

					$name = session_name();

					setcookie($name, "", time() - 3600, $path, $domain, $secure, $httponly)
				}

				session_destroy();
			}

				//Startar session.
				session_start();
				session_regenerate_id(true);

				$disabled = true;

				//Uppgift 1
				if( isset($_GET["linkNewGame"])) {

					$nbrOfRounds = 0;
					$sumOfAllRounds = 0;
					$medel = 0;
					$_SESSION["nbrOfRounds"] = $nbrOfRounds;
					$_SESSION["sumOfAllRounds"] = $sumOfAllRounds;

					echo ("<p>" . "New Game!" . "</p>");
					$disabled = false;
				}

				//Uppgift 3 och 2.
				if( (!isset($_GET["linkExit"])
				&& !isset($_GET["linkRoll"])
				&& !isset($_GET["linkNewGame"])
				&& !isset($_SESSION["nbrOfRounds"])
				&& !isset($_SESSION["sumOfAllRounds"]))
				|| (isset($_GET["linkExit"])
				&& isset($_SESSION["nbrOfRounds"])
				&& isset($_SESSION["sumOfAllRounds"]))) {

					deleteSession();
				}

				//Uppgift 4
				if( !isset($_GET["linkExit"])
				&& !isset($_GET["linkRoll"])
				&& !isset($_GET["linkNewGame"])
				&& isset($_SESSION["nbrOfRounds"])
				&& isset($_SESSION["sumOfAllRounds"])) {

					echo ("<h6>" . "Antal spel: " . $_SESSION["nbrOfRounds"] . "</h6>");
					echo ("<h6>" . "Summan av alla spel: " . $_SESSION["sumOfAllRounds"] . "</h6>");
					echo ("<h6>" . "Medelvärdet: ". $medel . "</h6>");
				}

				//Uppgift 5
				if( isset($_GET["linkRoll"])
				&& isset($_SESSION["nbrOfRounds"])
				&& isset($_SESSION["sumOfAllRounds"])) {

					include 'include/OneDice.php';
					include 'include/SixDices.php';

					$obSixDices = new SixDices();
					$obSixDices->rollDices();

					echo($obSixDices->svgDices());

					$nbrOfRounds = $_SESSION["nbrOfRounds"];
					$nbrOfRounds++;
					$_SESSION["nbrOfRounds"] = $nbrOfRounds;

					$sumOfAllRounds = $_SESSION["sumOfAllRounds"];
					$sumOfAllRounds += $obSixDices->sumDices();
					$_SESSION["sumOfAllRounds"] = $sumOfAllRounds;

					$medel = $sumOfAllRounds / $nbrOfRounds;

					echo ("<h6>" . "Antal spel: " . $_SESSION["nbrOfRounds"] . "</h6>");
					echo ("<h6>" . "Summan av alla spel: ". $_SESSION["sumOfAllRounds"] . "</h6>");
					echo ("<h6>" . "Medelvärdet: ". $medel . "</h6>");
					$disabled = false;
				}

				//Uppgift 6
				if( !isset($_SESSION["nbrOfRounds"])
				&& !isset($_SESSION["sumOfAllRounds"])) {

					$disabled = true;
				}

			?>
		</div>

		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkRoll=true" class="btn btn-primary <?php if($disabled) echo("disabled"); ?>">Roll six dices</a>
		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkNewGame=true" class="btn btn-primary">New game</a>
		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkExit=true" class="btn btn-primary <?php if($disabled) echo("disabled"); ?>">Exit</a>

		<script src="script/animation.js"></script>

	</body>

</html>
