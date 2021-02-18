<?php include('server_admin.php') ?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css?v1=1">
</head>
<body class="tk-sofia-pro">
<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Gebruikersnaam</label>
        <input type="text" name="gebruikersnaam" >
    </div>
    <div class="input-group">
        <label>Wachtwoord</label>
        <input type="password" name="wachtwoord">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
        <a class="linkje" href="register.php">Terug</a>
    </p>
</form>
</body>
    </html><?php
