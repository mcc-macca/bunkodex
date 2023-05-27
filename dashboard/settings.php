<?php
session_start();
require '../lib/fundash.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    require '../lib/conf.php';
    require '../lib/function.php';
    print_head('Dashboard');
    print_sidebar();

    


?>
    <h1></h1><br><br>
<?php
    print_foot();
} else {
    session_expired();
} ?>