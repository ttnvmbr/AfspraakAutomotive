<?php

session_start();

// initializing variables
$gebruikersnaam = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'rvs');

// REGISTER USER
if (isset($_POST['reg_admin'])) {
    // receive all input values from the form
    $gebruikersnaam = mysqli_real_escape_string($db, $_POST['gebruikersnaam']);
    $wachtwoord_1 = mysqli_real_escape_string($db, $_POST['wachtwoord_1']);
    $wachtwoord_2 = mysqli_real_escape_string($db, $_POST['wachtwoord_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($gebruikersnaam)) {
        array_push($errors, "gebruikersnaam is verplicht");
    }
    if (empty($wachtwoord_1)) {
        array_push($errors, "wachtwoord is verplicht");
    }
    if ($wachtwoord_1 != $wachtwoord_2) {
        array_push($errors, "Wachtwoorden zijn niet hetzelfde");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM admin WHERE gebruikersnaam='$gebruikersnaam' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['gebruikersnaam'] === $gebruikersnaam) {
            array_push($errors, "Gebruikersnaam bestaat al");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $wachtwoord = $wachtwoord_1;
        $hashed_password = password_hash($wachtwoord, PASSWORD_DEFAULT);


        $query = "INSERT INTO admin (gebruikersnaam, wachtwoord) 
  			  VALUES('$gebruikersnaam', '$hashed_password')";
        mysqli_query($db, $query);
        $_SESSION['gebruikersnaam'] = $gebruikersnaam;
        $_SESSION['success'] = "Admin is aangemaakt en ingelogd";
        header('location: index.php');
    }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
    $gebruikersnaam = mysqli_real_escape_string($db, $_POST['gebruikersnaam']);
    $wachtwoord = mysqli_real_escape_string($db, $_POST['wachtwoord']);


    if (empty($gebruikersnaam)) {
        array_push($errors, "Gebruikersnaam is verplicht");
    }
    if (empty($wachtwoord)) {
        array_push($errors, "Wachtwoord is verplicht");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM admin WHERE gebruikersnaam='$gebruikersnaam'";

        $results = mysqli_query($db, $query);
        $ro = mysqli_fetch_assoc($results);
        if (mysqli_num_rows($results) == 1) {
            if (password_verify($wachtwoord, $ro['wachtwoord'])) {
                $_SESSION['gebruikersnaam'] = $gebruikersnaam;
                $_SESSION['success'] = "U bent succesvol ingelogd";
                header('location: index.php');
            }
        } else {
            array_push($errors, "fout in gebruikersnaam/wachtwoord combinatie");
        }
    }
}