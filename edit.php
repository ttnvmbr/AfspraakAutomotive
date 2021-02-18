<?php
include('database.php');

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $afspraakId    = mysqli_escape_string($db, $_POST['id']);
    $naam     = mysqli_escape_string($db, $_POST['naam']);
    $email       = mysqli_escape_string($db, $_POST['email']);
    $phone      = mysqli_escape_string($db, $_POST['phone']);
    $datum      = mysqli_escape_string($db, $_POST['datum']);
    $tijd    = mysqli_escape_string($db, $_POST['tijd']);
    $opmerkingen = mysqli_escape_string($db, $_POST['opmerkingen']);



    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $afspraak = [
        'naam'    => $naam,
        'email'      => $email,
        'phone'    => $phone,
        'datum'      => $datum,
        'tijd'    => $tijd,
        'opmerkingen' => $opmerkingen
    ];


        //Update the record in the database
        $query = "UPDATE users
                  SET naam = '$naam', email = '$email', phone = '$phone', datum = '$datum', tijd = '$tijd', opmerkingen = '$opmerkingen'
                  WHERE id = '$afspraakId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: appointment.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $afspraakId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM users WHERE id = " . mysqli_escape_string($db, $afspraakId);
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) == 1)
    {
        $afspraak = mysqli_fetch_assoc($result);
    }
    else {
        // redirect when db returns no result
        header('Location: appointment.php');
        exit;
    }
} else {
    header('Location: appointment.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css?v1.2"/>
</head>
<body class="tk-sofia-pro">
<h1 class="header">Wijzig de afspraak met "<?= $afspraak['naam']?>"</h1>

<form action="" method="post" enctype="multipart/form-data">
    <div class="input-group">
        <label for="naam">naam</label>
        <input id="naam" type="text" name="naam" value="<?= $afspraak['naam'] ?>"/>
        <span class="errors"><?= isset($errors['naam']) ? $errors['naam'] : '' ?></span>
    </div>
    <div class="input-group">
        <label for="email">email</label>
        <input id="email" type="text" name="email" value="<?= $afspraak['email'] ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="input-group">
        <label for="phone">telefoon</label>
        <input id="phone" type="text" name="phone" value="<?= $afspraak['phone'] ?>"/>
        <span class="errors"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
    </div>
    <div class="input-group">
        <label for="datum">datum</label>
        <input id="datum" type="date" name="datum" value="<?= $afspraak['datum'] ?>"/>
        <span class="errors"><?= isset($errors['datum']) ? $errors['datum'] : '' ?></span>
    </div>
    <div class="input-group">
        <label for="tijd">tijd</label>
        <input id="tijd" type="time" name="tijd" value="<?= $afspraak['tijd'] ?>"/>
        <span class="errors"><?= isset($errors['tijd']) ? $errors['tijd'] : '' ?></span>
    </div>
    <div>
        <input type="hidden" name="id" value="<?= $afspraakId ?>"/>
        <input class="btn" type="submit" name="submit" value="opslaan"/>
    </div>
</form>
<div>
    <a class="btn2" href="appointment.php">Terug naar afspraken overzicht</a>
</div>
</body>
</html>
