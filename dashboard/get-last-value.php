<?php
require_once '../lib/conf.php';
$query = "SELECT MAX(value) AS `value` FROM `bunkodex_cat`";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$lastValue = $row['value'];
echo $lastValue;
mysqli_close($conn);
?>
