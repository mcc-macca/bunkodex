<?php
$servername = "".$_POST['servername']."";
$username = "".$_POST['username']."";
$password = "".$_POST['password']."";
$dbname = "".$_POST['dbname']."";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "ERRORE DURANTE LA CONNESSIONE AL DATABASE";
} else {
    echo "CONNESSIONE AL DATABASE RIUSCITA";
}
$conn->close();
?>
