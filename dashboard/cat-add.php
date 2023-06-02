<?php
session_start();
error_reporting(0);
require '../lib/fundash.php';
require '../lib/conf.php';
require '../lib/function.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    print_head('Add Category');
    print_sidebar();
    if (isset($_POST['submit'])) {
        $name = isset($_POST['name']) ? html_string($_POST['name']) : null;
        $value = isset($_POST['value']) ? html_string($_POST['value']) : null;
        $description = isset($_POST['description']) ? html_string($_POST['description']) : null;
        $created = date("H:i:s d/m/Y");

        $query = "INSERT INTO `bunkodex_cat` (`name`, `value`, `description`, `act`, `create`) VALUES (?, ?, ?, '1', ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $value, $description, $created);

        if ($stmt->execute()) {
            header("location: cat.php");
            exit;
        } else {
            $error = "Error occurred while inserting data into the database.";
            header("location: cat.php?error=" . urlencode($error));
            exit;
        }
    }
?>

    <h1>Add Category</h1>
    <br><br>
    <form method="post" action="cat-add.php">
        <table class='formcrud'>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Value</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="name" required></td>
                    <td><input type="text" name="value" id="value-input" required></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" name="autogenerate" id="autogenerate-checkbox" checked>&nbsp;Auto Generate</td>
                </tr>
                <tr>
                    <td colspan="2">Description</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="description" style="width: 100%; height: 100px"></textarea></td>
                </tr>
                <tr>
                    <td><a href="cat.php"><button type="button"><img src='../img/cancel.png'>&nbsp;CANCEL</button></a></td>
                    <td><button type="submit" name="submit"><img src="../img/create.png">&nbsp;ADD</button></td>
                </tr>
            </tbody>
        </table>
    </form>

    <?php
    print_foot();
    ?>
    <script>
        $(document).ready(function() {
            $('#autogenerate-checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $.ajax({
                        url: 'get-last-value.php',
                        success: function(data) {
                            var lastValue = parseInt(data);
                            var newValue = lastValue + 1;
                            $('#value-input').val(newValue.toString().padStart(3, '0'));
                            $('#value-input').prop('readonly', true);
                        },
                        error: function() {
                            console.log('Error occurred in AJAX request.');
                        }
                    });
                } else {
                    $('#value-input').val('');
                    $('#value-input').prop('readonly', false);
                }
            });
            $.ajax({
                url: 'get-last-value.php',
                success: function(data) {
                    var lastValue = parseInt(data);
                    var newValue = lastValue + 1;
                    $('#value-input').val(newValue.toString().padStart(3, '0'));
                },
                error: function() {
                    console.log('Error occurred in AJAX request.');
                }
            });
        });
    </script>
<?php
} else {
    session_expired();
} ?>