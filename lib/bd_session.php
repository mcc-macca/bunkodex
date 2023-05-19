<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<br><br><br><center><h1>Session Expired!</h1><br><br><h3>Remake the <a hred='../login/index.php'>LOGIN</a></h3></center>";
    die;
}