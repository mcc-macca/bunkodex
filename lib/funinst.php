<?php
/**
 * Funzione per evitare attacchi SQL Injection e XSS.
 * Function for prevent SQL Injection and XSS Attacks
 */
function html_string($string){
    $string = htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $string = trim($string);
    $string = addslashes($string);
    return $string;
}

/**
 * Function for print the first part of the HTML code (head)
 */
function print_head($title){
    echo "
    <!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>$title - BunkoDEX</title>
    <link rel='stylesheet' href='style.css'>
    <script src='../vendor/jquery/jquery.min.js'></script>
    <link rel='shortcut icon' href='../favicon.ico' type='image/x-icon'>
</head>

<body>
<div class='head'>
        <h1>$title - BunkoDEX</h1>
        <h3>Thank you for choosing Macca Computer BunkoDEX free software!</h3>
    </div>
    ";
}

/**
 * Function for print the footer
 */
function print_foot(){
    echo "
    <div class='footer'>
        <h1>BunkoDEX</h1>
        <h2><a href='https://maccacomputer.altervista.org'>Macca Computer</a> &copy; 2018 - ".date('Y')."</h2>
        <h5>GNU AGPL License</h5>
    </div>";
}