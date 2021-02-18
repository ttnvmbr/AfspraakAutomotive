<?php
session_start();
$nutijd = "H:i";
date_default_timezone_set('CET');
$vandaag=date('d/m/Y');
// initializing variables
$naam = "";
$email= "";
$phone="";
$datum="";
$opmerkingen="";
$tijd="";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'rvs');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $naam = mysqli_real_escape_string($db, $_POST['naam']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $datum = mysqli_real_escape_string($db, $_POST['datum']);
    $tijd = mysqli_real_escape_string($db, $_POST['tijd']);
    $opmerkingen = mysqli_real_escape_string($db, $_POST['opmerkingen']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($naam)) { array_push($errors, "Naam is verplicht"); }
    if (empty($email)) { array_push($errors, "Email is verplicht"); }
    if (empty($phone)) { array_push($errors, "Telefoonnummer is verplicht"); }
    if (empty($datum)) { array_push($errors, "Datum is verplicht"); }
    if (empty($tijd)) { array_push($errors, "Tijd is verplicht"); }
    if($tijd<=$nutijd && $datum === $vandaag){array_push($errors,"De gekozen tijd heeft al plaatsgevonden");}


    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE datum ='$datum' AND tijd='$tijd' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user){
        array(array_push($errors,"Datum en tijd is niet meer beschikbaar"));
    }

    // Finally, make appointment if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO users (naam, email, phone, datum, tijd, opmerkingen) 
  			  VALUES('$naam', '$email', '$phone','$datum', '$tijd', '$opmerkingen')";
        mysqli_query($db, $query);
        $_SESSION['naam'] = $naam;
        $_SESSION['success'] = "Je afspraak is gemaakt";
      header('location: bevestiging.php');
    }
}


