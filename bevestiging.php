<?php
include ('server.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css?v1=1">
    <title>Bevestiging</title>
</head>
<body class="tk-sofia-pro">
<h2 class="header">Uw afspraak is bevestigd</h2>
<div class="content">
    <p>Beste <?php echo $naam; ?>, Bedankt voor het maken van een afspraak met Hartman Automotive. Voor vragen en voor het wijzigen of annuleren van uw afspraak, verzoeken wij u vriendelijk een mail te sturen.</p>
    <br>
    <p><b>Overzicht van uw afspraak:</b><br><i>Naam:<i></i> <?php echo $naam; ?><br><i>Email: </i><?php echo $email; ?><br><i>Telefoon: </i><?php echo $phone; ?><br><i> Datum: </i><?php echo $datum; ?><br><i>Tijd: </i><?php echo $tijd; ?><br><i>opmerkingen: </i><?php echo $opmerkingen; ?></p>
    <br>
    <a href="register.php" style="text-decoration: none" class="btn">Maak een nieuwe afpraak</a>
</div>
</body>
</html>