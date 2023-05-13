<?php 
require '../lib/funinst.php';
require '../lib/function.php';
require '../lib/conf.php';
print_head("Inserimento nome azienda");
if (isset($_POST['submit'])) {
    $companyname = html_string($_POST['cmp_name']);
    define('NAME_DEX', ''.$companyname.'');
    $data = read_json("../bunkodex.json");
    $query_file_relative = $data['db']['install'];
    $query_file_asbolute = realpath(__DIR__ . '/' . $query_file_relative);
    $query_file = file_get_contents($query_file_asbolute);
    if (mysqli_multi_query($con, $query_file)) {
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
        $query = "INSERT INTO `bunkodex_admin` (`user`, `pass`) VALUES `$user`, `$pass`;";
        header("location: setupcomplete.php");
    } else {
        echo "<h1 class='errorh1'>ERROR DURING BunkoDEX INSTALL!</h1>";
    }
}
?>
<div class="main">
    <center>
        <h1>Setup Company name and Login credentials</h1>
        <form>
            <table>
                <tbody>
                    <tr>
                        <td>Company name</td>
                        <td><input type="text" name="cmp_name" placeholder="Company name..."></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Username (default: admin)"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="text" name="password" placeholder="Password (default: bunkodex)"></td>
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