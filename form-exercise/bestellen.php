<?

require('class.phpmailer.php');

/*
* Form Variables.
*/

$aantalRood		= 0;
$aantalGrijs	= 0;
$aantalBlauw	= 0;
$aantalZwart	= 0;

$reclameFlyers	= 0;
$handOutKaarten = 0;

$naam 			= "";
$straat 		= "";
$huisNummer = "";
$postcode 	= "";
$plaats 		= "";
$telNummer 	= "";
$email 			= "";

if (is_numeric($_POST['redBox'])) 	$aantalRood	    = (int) $_POST["redBox"];
if (is_numeric($_POST['greyBox'])) 	$aantalGrijs    = (int) $_POST["greyBox"];
if (is_numeric($_POST['blueBox'])) 	$aantalBlauw    = (int) $_POST["blueBox"];
if (is_numeric($_POST['blackBox'])) $aantalZwart    = (int) $_POST["blackBox"];

if (is_numeric($_POST['flyer'])) $reclameFlyers     = (int) $_POST['flyer'];
if (is_numeric($_POST['handout'])) $handOutKaarten  = (int) $_POST['handout'];

if (is_string($_POST["naam"])) $naam                = $_POST["naam"];
if (is_string($_POST["straat"])) $straat 			      = $_POST["straat"];
if (is_numeric($_POST["huisnummer"])) $huisNummer	  = $_POST["huisnummer"];
if (is_string($_POST["postcode"])) $postcode		    = $_POST["postcode"];
if (is_string($_POST["plaats"])) $plaats 			      = $_POST["plaats"];
if (is_string($_POST["telefoonnummer"])) $telNummer = $_POST["telefoonnummer"];
if (is_string($_POST["email"])) $email 				      = $_POST["email"];

$aantalBoxen 	= $aantalRood+$aantalGrijs+$aantalBlauw+$aantalZwart;

$emailMessage = "";

if($aantalBoxen == 1) {
	$emailMessage .= "<h1>Er is een PARTY box besteld door:</h1>".PHP_EOL;
}
if($aantalBoxen >1) {
	$emailMessage .= "<h1>Er zijn ".$aantalBoxen." PARTY boxen besteld door:</h1>".PHP_EOL;
}
$emailMessage .= "<h2>".$naam."</h2>".PHP_EOL.PHP_EOL;

$emailMessage .= "<h3>Order:</h3>".PHP_EOL;
if($aantalRood > 0) {
	$emailMessage .= "".$aantalRood."x \t Rood"."<br>".PHP_EOL;
}
if($aantalGrijs > 0 ) {
	$emailMessage .= "".$aantalGrijs."x \t Grijs"."<br>".PHP_EOL;

}
if($aantalBlauw > 0 ) {
	$emailMessage .= "".$aantalBlauw."x \t Blauw"."<br>".PHP_EOL;

}

if($aantalZwart > 0 ) {
	$emailMessage .= "".$aantalZwart."x \t Zwart"."<br>".PHP_EOL;
}

$emailMessage .= "<br>".PHP_EOL;	

if($reclameFlyers > 0 || $handoutKaarten > 0) {
	$emailMessage .= "<h3>Extra Materialen:</h3>".PHP_EOL;

	if ($reclameFlyers > 0 ) {
		$emailMessage .= "".$reclameFlyers."x \t Reclame Flyers"."<br>".PHP_EOL;
	}
	if ($handOutKaarten > 0) {
		$emailMessage.="".$handOutKaarten ."x \t Hand Out Kaarten";
	}
	$emailMessage .= "<br>"."<br>".PHP_EOL.PHP_EOL;
}

$emailMessage .= "<h3>Aflever- en factuuraddres</h3>".PHP_EOL;
$emailMessage .= "<b>Naam:</b>\t\t".$naam."<br>".PHP_EOL;
$emailMessage .= "<b>Straat:</b>\t\t".$straat."<br>".PHP_EOL;
$emailMessage .= "<b>Huisnummer:</b>\t\t".$huisNummer."<br>".PHP_EOL;
$emailMessage .= "<b>Postcode:</b>\t".$postcode."<br>".PHP_EOL;
$emailMessage .= "<b>Plaats:</b>\t\t".$plaats."<br>"."<br>".PHP_EOL.PHP_EOL;

$emailMessage .= "<h3>Contactgegevens:</h3>".PHP_EOL;
if ($telNummer != "") {
$emailMessage .= "<b>Telefoonnummer:</b>\t".$telNummer."<br>".PHP_EOL;
}
$emailMessage .= "<b>E-mailadres:</b>\t".$email."<br>"."<br>".PHP_EOL.PHP_EOL;

$stamp = date("Y-m-d H:i:s");

/*
*
* Mail Message
*
*/

$mail = new PHPMailer;

$mail->IsSMTP(); // set to use SMTP;
//$mail->SMTPDebug = 2;
//$mail->Debugoutput = 'html';

$mail->Host = 'localhost';
$mail->Port = 25;

$mail->From = 'bla@mbla.com';
$mail->FromName = 'Bla Bla';
$mail->AddAddress('bla@bla.com','Chatman');
$mail->AddReplyTo('bla@bla.com');

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = 'Bestelling van PARTY-Box - '.$stamp;
$mail->Body = $emailMessage;

if(!$mail->Send()) {
	echo 'Message Could not be Sent';
	echo 'Mailer Error: '.$mail->ErrorInfo;
	header("Location:http://www.party-box.nl/bestellen/fout/");
	exit;
}
header("Location:http://www.party-box.nl/bestellen/succes/");
?>