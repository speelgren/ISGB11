<?php
	//Här kommer koden...

	//Flagga om knappen är tryckt eller inte...
	$disabled = true; //skapar variabel för disabled

	//Defaultvärdet för CSS...
	$css = "body {
		color: rgb(0, 0, 0);
		background-color: rgb(255, 255, 255);
		}";

	//OM användaren trycker på knappen (btnSend).

	if ( isset( $_POST["btnSend"])) {

		$bgColor = $_POST["backgroundcolor"];
		$fgColor = $_POST["foregroundcolor"];

		//Skapa eller uppdatera cookies

		setcookie("bgColor", $bgColor, time() + 3600);
		setcookie("fgColor", $fgColor, time() + 3600);

		//Sätt om variabelvärdet för disabled och CSS
		$disabled = false;
		$css = "body { color: $fgColor; background-color: $bgColor; }";

	}

	//Om användaren trycker på btnReset
	if (isset($_POST["btnReset"])) {
		//Ta  bort cookies

		setcookie("bgColor", "", time() - 3600);
		setcookie("fgColor", "", time() - 3600);
	}

	if ( !isset($_POST["btnSend"]) && !isset($_POST["btnReset"]) && isset($_COOKIE["bgColor"]) && isset($_COOKIE["fgColor"])) {

		//Om allt detta är sant har användaren redan varit på sidan, värdet på bgColor och fgColor visas igen. kakorna fgColor och bgColor kommer från klient till server.

		$bgColor = $_COOKIE["bgColor"];
		$fgColor = $_COOKIE["fgColor"];

		$disabled = false;
		$css = "body { color: $fgColor; background-color: $bgColor; }";

	}


?>
<!doctype html>
<html lang="en" >
	<head>
		<meta charset="utf-8" />
		<title>Ett exempel med kakor</title>
		<style>
			<?php
				//Skriv ut CSS-instruktionerna...
				echo($css);
			?>
		</style>
	</head>
	<body>
		<div>

			<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">

				<input type="color" name="backgroundcolor" value="<?php if( isset( $bgColor )) { echo( $bgColor ); } ?>" />
				<input type="color" name="foregroundcolor" value="<?php if( isset( $fgColor )) { echo( $fgColor ); } ?>"/>

				<input type="submit" name="btnSend" value="Send" />
				<input type="submit" name="btnReset" value="Reset" <?php if($disabled) { echo("disabled"); } ?>/>

			</form>

			<?php

				echo("<p>\$_POST</p>") . PHP_EOL;
				echo( "<pre>" );
				print_r( $_POST );
				echo( "</pre>" );

				echo("<p> \$_SESSION</p>") . PHP_EOL;
				echo( "<pre>" );
				print_r( $_COOKIE );
				echo( "</pre>" );


			?>

		</div>
	</body>
</html>
