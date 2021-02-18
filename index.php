<?php
session_start();

if (!isset($_SESSION['gebruikersnaam'])) {
    $_SESSION['msg'] = "Je moet eerst inloggen";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['gebruikersnaam']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css?v1.3">
</head>
<body class="tk-sofia-pro">

<div class="header">
    <h2>Admin Home</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['gebruikersnaam'])) : ?>
        <p>Welkom <b><?php echo $_SESSION['gebruikersnaam']; ?></b></p>
        <p> <a href="index.php?logout='1'" class="roodlinkje">uitloggen</a> </p>
    <?php endif ?>
    <div class="regnieuw">
        <a class="linkje" href="regadmin.php">Maak een admin aan</a>
    </div>
    <div class="regnieuw">
        <a class="linkje" href="appointment.php">Bekijk <strong>komende</strong> afspraken</a>
    </div>
    <div class="regnieuw">
        <a class="linkje" href="allapp.php">Bekijk <strong>alle</strong> afspraken</a>
    </div>
</div>


</body>
</html>