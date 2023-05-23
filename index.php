<?php
session_start();
if ($_SESSION['logged_in'] != true) {
    header("location: ./login/login.php");
} else {
    header("location: ./dashboard/index.php");
}