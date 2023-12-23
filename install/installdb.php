<?php
require '../lib/funinst.php';
require '../lib/function.php';
if (isset($_POST['submit'])) {
    $dbhost = html_string($_POST['dbhost']);
    $dbuser = html_string($_POST['dbuser']);
    $dbpass = html_string($_POST['dbpass']);
    $dbname = html_string($_POST['dbname']);

    $content = "<?php\n";
    $content .= "define('DB_HOST', '$dbhost');\n";
    $content .= "define('DB_NAME', '$dbname');\n";
    $content .= "define('DB_USER', '$dbuser');\n";
    $content .= "define('DB_PASS', '$dbpass');\n";
    $content .= PHP_EOL . "$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);\n";
    $content .= "if (mysqli_connect_errno()) {\n";
    $content .= " echo 'Error during database connection: ' . mysqli_connect_error();\n";
    $content .= "}";
    if (file_put_contents('../lib/conf.php', $content)) {
        require '../lib/conf.php';
        $data = read_json("../bunkodex.json");
        $query_file_relative = $data['db']['install'];
        $query_file_asbolute = realpath('../' . $query_file_relative);
        $query_file = file_get_contents($query_file_asbolute);
        if (mysqli_multi_query($conn, $query_file)) {
            header("location: setupcompany.php");
            exit();
        } else {
            echo "<h1 class='errorh1'>ERROR DURING BunkoDEX INSTALL!</h1>";
        }
    }

    $data = read_json("../bunkodex.json");
    $query_file_relative = $data['db']['install'];
    $query_file_asbolute = realpath('../' . $query_file_relative);
    $query_file = file_get_contents($query_file_asbolute);
    if (mysqli_multi_query($conn, $query_file)) {
        header("location: setupcompany.php");
        exit();
    } else {
        echo "<h1 class='errorh1'>ERROR DURING BunkoDEX INSTALL!</h1>";
    }
}
print_head("Database Installation");
?>
<div class="main">
    <h2>Enter your database credentials:</h2>
    <form method="post" action="installdb.php" id="db-form">
        <table>
            <tbody>
                <tr>
                    <td>DB Host:</td>
                    <td><input type="text" name="dbhost" placeholder="es. localhost"></td>
                </tr>
                <tr>
                    <td>DB User:</td>
                    <td><input type="text" name="dbuser" placeholder="es. root"></td>
                </tr>
                <tr>
                    <td>DB Pass:</td>
                    <td><input type="text" name="dbpass" placeholder="in some cases you can leave this field blank">
                    </td>
                </tr>
                <tr>
                    <td>DB Name:</td>
                    <td><input type="text" name="dbname" placeholder="es. bunkodex"></td>
                </tr>
            </tbody>
        </table>
        <h2 id="info"></h2>
        <button type="button" id="test-db-btn"><b>Test database connection</b></button>
        <button type="submit" id="submit-btn" style="display: none;" name="submit"><b>Next</b></button>
    </form>
</div>
<script src="../lib/js/checkdbconn.js"></script>
<?php
print_foot();
?>
