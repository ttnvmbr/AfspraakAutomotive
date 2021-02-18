<?php
include('database.php');
//Get the result set from the database with a SQL query
$query = "SELECT * FROM users";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$afspraken = [];
while ($row = mysqli_fetch_assoc($result)) {
    $afspraken[] = $row;
}

//Close connection
mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <title>Alle afspraken</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css?v1.1"/>
</head>
<body class="tk-sofia-pro">
<h1 class="headertabel">Afspraken</h1>
<table class="tabelletje">
    <thead>
    <tr>
        <th colspan="2">#</th>
        <th colspan="2">Naam</th>
        <th colspan="2">Email</th>
        <th colspan="2">Telefoonnummer</th>
        <th colspan="2">Datum</th>
        <th colspan="2">Tijd</th>
        <th colspan="2">Opmerkingen</th>
    </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody>
    <?php foreach ($afspraken as $afspraak) { ?>
        <tr class="tabelinhoud">
            <td colspan="2"><?= $afspraak['id']; ?></td>
            <td colspan="2"><?= $afspraak['naam']; ?></td>
            <td colspan="2"><?= $afspraak['email']; ?></td>
            <td colspan="2"><?= $afspraak['phone']; ?></td>
            <td colspan="2"><?= $afspraak['datum']; ?></td>
            <td colspan="2"><?= $afspraak['tijd']; ?></td>
            <td colspan="2"><?= $afspraak['opmerkingen']; ?></td>
            <td><a class="roodlinkje" href="delete.php?id=<?= $afspraak['id'];?>">Verwijderen</a></td>
            <td><a class="editlinkje" href="edit.php?id=<?= $afspraak['id'];?>">Wijzigen</a></td>
        </tr>

    <?php } ?>
    </tbody>
</table>
<a class="btn1" href="index.php">Terug naar admin home</a>
<p class="letop">Voor een overzicht van alle komende afspraken klik <a class="linkjehier" href="appointment.php">hier</a>.</p>
</body>
</html>
