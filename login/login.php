<?php
session_start();
require '../lib/function.php';
require '../lib/conf.php';

if (isset($_POST['submit'])) {
    $uid  = html_string($_POST['username']);
    $pass = html_string($_POST['password']);

    $query = $conn->query("SELECT * FROM `bunkodex_admin` WHERE `uid` = '$uid'");

    if ($query->num_rows != 0) {
        $user = $query->fetch_assoc();
        if (password_verify($pass, $user['pass'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['uid'] = $user['uid'];
            $data      = date("d/m/Y");
            $ora       = date("H:i:s");
            $ip        = getIPAddress();
            $useragent = $_SERVER['HTTP_USER_AGENT'];
            $os_arch   = PHP_OS;
            $os_type   = PHP_OS_FAMILY;
            $os_uname  = php_uname();

            $log = $conn->query("INSERT INTO `bunkodex_log` 
                           (`utente`, `date`, `ora`, `ip`, `user_agent`, `os_arch`, `os_type`, `os_uname`) VALUES
                           ('" . $user['uid'] . "', '$data', '$ora', '$ip', '$useragent', '$os_arch', '$os_type', '$os_uname');");

            //SET DEI COOKIE PER LA SESSIONE 30 GIORNI()
            $rememberMe = isset($_POST["remember"]) && $_POST["remember"] == 'on';
            if ($rememberMe) {
                setcookie("email", $email, time() + (86400 * 30), "/"); // Imposta un cookie con scadenza di 30 giorni
            }

            header("location: ../dashboard/index.php");
        } else {
            $_SESSION['message'] = "Wrong password! Try Again!";
            header("location: error.php");
            die;
        }
    } else {
        $_SESSION['message'] = "User with that mail doesn't exist!";
        header("location: error.php");
        die;
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

            <input type="submit" name="submit" value="LOGIN"><br><br>
            <center>
                <p>Powered by Macca Computer Login System</p>
            </center>
        </form>
    </div>
</body>

</html>