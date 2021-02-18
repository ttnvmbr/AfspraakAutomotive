<?php
//Require music data & image helpers to use variable in this file
include('database.php');

if (isset($_POST['submit'])) {
    // DELETE IMAGE
    // To remove the image we need to query the file name from the db.
    // Get the record from the database result
    $query = "SELECT * FROM users WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    $afspraak = mysqli_fetch_assoc($result);

    // DELETE DATA
    // Remove the album data from the database
    $query = "DELETE FROM users WHERE id = " . mysqli_escape_string($db, $_POST['id']);

    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header("Location: appointment.php");
    exit;

} else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $afspraakId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM users WHERE id = " . mysqli_escape_string($db, $afspraakId);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

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
    // Id was not present in the url OR the form was not submitted

    // redirect to db_connection.php
    header('Location: appointment.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style.css?v1.1"/>
    <title>Delete - <?= $afspraak['naam'] ?></title>
</head>
<body class="tk-sofia-pro">
<h2 class="header">Delete de afspraak met <?= $afspraak['naam'] ?></h2>
<form action="" method="post" >
    <p>
        Weet u zeker dat u de afspraak met "<?= $afspraak['naam']?>" wilt verwijderen?
    </p>
    <br>
    <input type="hidden" name="id" value="<?= $afspraak['id'] ?>"/>
    <input class="btn" type="submit" name="submit" value="Verwijderen"/>
    <a style="text-decoration: none" href="appointment.php" class="btn">Annuleren</a>
</form>
</body>
</html>
