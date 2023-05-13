<?php
require '../lib/funinst.php';
if (isset($_POST['submit'])) {
    include '../lib/conf.php';
    $dbhost = html_string($_POST['dbhost']);
    $dbuser = html_string($_POST['dbuser']);
    $dbpass = html_string($_POST['dbpass']);
    $dbname = html_string($_POST['dbname']);
    define('DB_HOST', ''.$dbhost.'');
    define('DB_USER', ''.$dbuser.'');
    define('DB_PASS', ''.$dbpass.'');
    define('DB_NAME', ''.$dbname.'');
    header("location: setupcompany.php");
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
    <script>
        $(document).ready(function () {
            $('#test-db-btn').on('click', function () {
                var data = $('#db-form').serialize();
                console.log(data);
                $.ajax({
                    type: 'POST',
                    url: 'test_db_connection.php',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            document.getElementById("info").innerHTML = "Database connection successful!";
                            document.getElementById("info").style.color = "lime";
                            $('#submit-btn').show();
                            $('#test-db-btn').hide();
                        } else {
                            document.getElementById("info").innerHTML = "Error connecting to database";
                            document.getElementById("info").style.color = "red";
                        }
                    },
                    error: function (xhr, status, error) {
                        document.getElementById("info").innerHTML = "Error connecting to database";
                        document.getElementById("info").style.color = "red";
                    }
                });
            });
        });

        console.log("%cBunkoDEX INSTALLATION - MACCA COMPUTER", "color: lime")
    </script>
    <?php 
    print_foot();
    ?>