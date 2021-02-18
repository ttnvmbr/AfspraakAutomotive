<?php include('server_admin.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="tk-sofia-pro">
<div class="header">
    <h2>Registreer een admin</h2>
</div>

<form method="post" action="regadmin.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Gebruikersnaam</label>
        <input type="text" name="gebruikersnaam" value="<?php echo $gebruikersnaam; ?>">
    </div>
    <div class="input-group">
        <label>Wachtwoord</label>
        <input type="password" name="wachtwoord_1">
    </div>
    <div class="input-group">
        <label>Bevestig wachtwoord</label>
        <input type="password" name="wachtwoord_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_admin">Registreer</button>
    </div>
    <p>
        <a class="linkje" href="index.php">Terug naar admin home</a>
    </p>
</form>
</body>
</html>
