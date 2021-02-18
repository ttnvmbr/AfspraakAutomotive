<?php
session_start();
$db=mysqli_connect('localhost', 'root', '', 'rvs')
    or die("error: ".mysqli_connect_error());
?>