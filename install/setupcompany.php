<?php
session_start();
require '../lib/funinst.php';
require '../lib/function.php';
require '../lib/conf.php';

print_head("Setup Company name");

if (isset($_POST['submit'])) {
    $companyname = html_string($_POST['cmp_name']);
    $content .= "\ndefine('NAME_DEX', '$companyname');\ndefine('INST_DATE', '".date("d/m/Y")."')";
    file_put_contents('../lib/conf.php', $content . PHP_EOL, FILE_APPEND);
    if (isset($_POST['username'])) {
        $user = html_string($_POST['username']);
    } else {
        $user = "admin";
    }
    if (isset($_POST['password'])) {
        $pass = md5(html_string($_POST['password']));
    } else {
        $pass = md5("bunkodex");
    }
    $query = "INSERT INTO `bunkodex_admin` (`uid`, `pass`) VALUES ('$user', '$pass');";
    if ($conn->query($query)){
        $_SESSION['user'] = html_string($user);
        header("location: setupcomplete.php");
    } else {
        echo "<h1>ERROR DURING ADMIN SETUP</h1>";
        die;
    }
    
}
?>
<div class="main">
    <center>
        <h1>Setup Company name and Login credentials</h1>
        <form method="post" action="setupcompany.php">
            <table>
                <tbody>
                    <tr>
                        <td>Company name</td>
                        <td><input type="text" name="cmp_name" placeholder="Company name..." required></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Username (default: admin)" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="text" name="password" placeholder="Password (default: bunkodex)" required></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="submit"><b>INSTALL</b></button>
        </form>
    </center>
</div>
<?php
print_foot();
?>