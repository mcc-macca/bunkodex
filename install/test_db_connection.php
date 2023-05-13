<?php
$servername = $_POST['dbhost'];
$username = $_POST['dbuser'];
$password = $_POST['dbpass'];
$dbname = $_POST['dbname'];

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    $response = array('success' => false);
} else {
    $response = array('success' => true);
}

echo json_encode($response);
$conn->close();
