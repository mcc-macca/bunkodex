<?php
session_start();
error_reporting(0);
require '../lib/fundash.php';
require '../lib/conf.php';
require '../lib/function.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    print_head('Edit category');
    print_sidebar();

    $getid = isset($_GET['id']) ? html_string($_GET['id']) : null;

    if ($getid === null) {
        header("location: cat.php");
        die;
    }

    $getdataquery = QRYCAT . "WHERE `id`='$getid'";
    $getdata = $conn->query($getdataquery);
    $data = $getdata->fetch_assoc();

    $rname = $data['name'];
    $rvalue = $data['value'];
    $rdesc = $data['description'];
    $rmod = date("H:i:s d/m/Y");

    if (isset($_POST['submit'])) {
        $name = isset($_POST['name']) ? html_string($_POST['name']) : null;
        $value = isset($_POST['value']) ? html_string($_POST['value']) : null;
        $description = isset($_POST['description']) ? html_string($_POST['description']) : null;

        $query = "UPDATE `bunkodex_cat` SET `name`=?, `value`=?, `description`=?, `mod`=? WHERE `id`=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssi", $name, $value, $description, $rmod, $getid);

        if ($stmt->execute()) {
            header("location: cat.php");
            exit;
        } else {
            $error = "Error occurred while updating data in the database.";
            header("location: cat.php?error=" . urlencode($error));
            exit;
        }
    }

?>

    <h1>Edit Category</h1>
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
                    <td><input type="text" name="name" value="<?= $rname ?>" required></td>
                    <td><input type="text" name="value" value="<?= $rvalue ?>" id="value-input" required></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td><input type="checkbox" name="autogenerate" id="autogenerate-checkbox" checked>&nbsp;Auto Generate</td>
                </tr>
                <tr>
                    <td colspan="2">Description</td>
                </tr>
                <tr>
                    <td colspan="2"><textarea name="description" style="width: 100%; height: 100px"><?= $rdesc ?></textarea></td>
                </tr>
                <tr>
                    <td><a href="cat.php"><button type="button"><img src='../img/cancel.png'>&nbsp;CANCEL</button></a></td>
                    <td><button type="submit" name="submit"><img src="../img/create.png">&nbsp;EDIT</button></td>
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
        });
    </script>
<?php
} else {
    session_expired();
} ?>