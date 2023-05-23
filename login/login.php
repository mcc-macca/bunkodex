<?php
session_start();
require '../lib/function.php';
require '../lib/conf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = html_string($_POST['username']);
    $password = html_string($_POST['password']);
    $ip = getIPAddress();
    $queryuser = $conn->query(QRYADM . "WHERE `uid`='$username'");
    if ($queryuser->num_rows == 0) { // User doesn't exist
        $_SESSION['message'] = "User with that UID doesn't exist!";
        header("location: error.php");
        die;
    } else {
        $user = $queryuser->fetch_assoc();
        if (password_verify($password, $user['pass'])) {
            $id = $user['id'];
            $result_info = $mysqli->query(QRYADM . "WHERE id='$id'");
            $info = $result_info->fetch_assoc();
            $_SESSION['uid']       = $user['uid'];
            $_SESSION['logged_in'] = true;

            $data      = date("d/m/Y");
            $ora       = date("H:i:s");
            $ip        = getIPAddress();
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $os_arch   = PHP_OS;
            $os_type   = PHP_OS_FAMILY;
            $os_uname  = php_uname();

            $log = $mysqli->query("INSERT INTO `bunkodex_log` 
                           (`utente`, `date`, `ora`, `ip`, `user_agent`, `os_arch`, `os_type`, `os_uname`) VALUES
                           ('" . $user['uid'] . "', '$data', '$ora', '$ip', '$useragent', '$os_arch', '$os_type', '$os_uname');");

            //SET DEI COOKIE PER LA SESSIONE 30 GIORNI()
            $rememberMe = isset($_POST["remember"]) && $_POST["remember"] == 'on';
            if ($rememberMe) {
                setcookie("email", $email, time() + (86400 * 30), "/"); // Imposta un cookie con scadenza di 30 giorni
            }

            header("location: ../dashboard/index.php");
        } else {
            $_SESSION['message'] = "You have entered wrong password, try again!";
            header("location: error.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>BunkoDEX Login</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #1f2e51;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/bd_norm.png" type="image/x-icon">
</head>

<body>
    <div class="login-container">
        <h2>BunkoDEX Login</h2><br>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <table>
                <tr>
                    <td><label for="remember">Remember login:</label></td>
                    <td><input type="checkbox" id="remember" name="remember"></td>
                </tr>
            </table>

            <button type="submit"><b>LOGIN</b></button><br><br>
            <center>
                <p>Powered by Macca Computer Login System</p>
            </center>
        </form>
    </div>
</body>

</html>