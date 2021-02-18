<?php
include('server.php');
date_default_timezone_set('CET');
$vandaag=date('d/m/Y');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css?v1=1">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</head>
<body class="tk-sofia-pro">
  <div class="header">
  	<h2>Maak een afspraak</h2>
  </div>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Naam</label>
  	  <input type="text" id="naam" name="naam" value="" onkeyup='saveValue(this);'<?php if (isset($naam)){echo $naam;} ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" id="email" name="email" value="" onkeyup='saveValue(this);'<?php if (isset($email)){echo $email;} ?>">
  	</div>
  	<div class="input-group">
  	  <label>Telefoon</label>
  	  <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" value="" onkeyup='saveValue(this);'<?php if (isset($phone)){echo $phone;} ?>">
  	</div>
  	<div class="input-group">
  	  <label>Datum</label>
  	  <input id="datum" type="text" name="datum" value="<?php echo $vandaag ?>" min="<?php echo $vandaag ?>" <?php if (isset($datum)){echo $datum;} ?>">
    </div>
    <div class="input-group">
      <label>Tijd</label>
      <input type="time" name="tijd" value="09:00" min="09:00" max="15:00" step="1800" <?php if (isset($tijd)){echo $tijd;} ?>">
    </div>
    <div class="input-group">
      <label>Opmerkingen</label>
      <input type="text" name="opmerkingen" id="opmerkingen" value="" onkeyup='saveValue(this);'<?php if (isset($opmerkingen)){echo $opmerkingen;} ?>">
    </div>
  	<div class="input-group">
        <button type="submit" class="btn" name="reg_user">Verstuur</button>
  	</div>
  	<p>
  		Admin? <a class="linkje" href="login.php">Log in</a>
  	</p>
  </form>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#datum').datepicker({
            beforeShowDay: function (dt){
                return[dt.getDay() == 6 || dt.getDay() == 0 ? false : true];
            },
            minDate: "0",
            maxDate:"+2M",
            dateFormat:"dd/mm/yy",


        });

    });
    ( function( factory ) {
        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define( [ "../widgets/datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    }( function( datepicker ) {

        datepicker.regional.nl = {
            closeText: "Sluiten",
            prevText: "←",
            nextText: "→",
            currentText: "Vandaag",
            monthNames: [ "januari", "februari", "maart", "april", "mei", "juni",
                "juli", "augustus", "september", "oktober", "november", "december" ],
            monthNamesShort: [ "jan", "feb", "mrt", "apr", "mei", "jun",
                "jul", "aug", "sep", "okt", "nov", "dec" ],
            dayNames: [ "zondag", "maandag", "dinsdag", "woensdag", "donderdag", "vrijdag", "zaterdag" ],
            dayNamesShort: [ "zon", "maa", "din", "woe", "don", "vri", "zat" ],
            dayNamesMin: [ "zo", "ma", "di", "wo", "do", "vr", "za" ],
            weekHeader: "Wk",
            dateFormat: "dd-mm-yy",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: "" };
        datepicker.setDefaults( datepicker.regional.nl );

        return datepicker.regional.nl;

    } ) );

    document.getElementById("naam").value = getSavedValue("naam");    // set the value to this input
    document.getElementById("email").value = getSavedValue("email");
    document.getElementById("phone").value = getSavedValue("phone");
    document.getElementById("opmerkingen").value = getSavedValue("opmerkingen");
    /* Here you can add more inputs to set value. if it's saved */

    //Save the value function - save it to localStorage as (ID, VALUE)
    function saveValue(e){
        var id = e.id;  // get the sender's id to save it .
        var val = e.value; // get the value.
        localStorage.setItem(id, val);// Every time user writing something, the localStorage's value will override .
    }

    //get the saved value function - return the value of "v" from localStorage.
    function getSavedValue  (v){
        if (!localStorage.getItem(v)) {
            return "";// You can change this to your defualt value.
        }
        return localStorage.getItem(v);
    }
</script>