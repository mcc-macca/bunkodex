<?php
session_start();
require '../lib/fundash.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    require '../lib/conf.php';
    require '../lib/function.php';
    print_head('Dashboard');
    print_sidebar();

    switch (isset($_GET['type'])) {
        case 'cat':
            $typetitle = "category";
            break;
        case 'scat':
            $typetitle = "sub-category";
            break;
        case 'product':
            $typetitle = "product";
            break;
        default:
            $typetitle = "";
            break;
    }
    switch (isset($_GET['action'])) {
        case 'add':
            $typeaction = "- Add ";
            break;
        case 'del':
            $typeaction = "- Delete ";
            break;
        case 'mod':
            $typeaction = "- Edit ";
            break;
        default:
            $typeaction = "";
            break;
    }
?>
    <h1>CRUD <?= $typeaction . $typetitle?></h1><br><br>
    <table class="formcrud">
        <tbody>
            <?php
            $action = $_GET['action'];
            $type = $_GET['type'];

            if ($action === 'add') {
                echo "
                <tr>
                    <td class='normtd'>Name:</td>
                    <td class='normtd'><input type='text' name='name'></td>
                    <td rowspan='2'>Remember that the NAME and VALUE fields are the most important! You can always change them later, but remember that VALUE is unique and cannot be the same for two $typetitle.</td>
                </tr>
                <tr>
                    <td class='normtd'>Value:</td>
                    <td class='normtd'><input type='text' name='value'></td>
                </tr>";
                if ($type === 'scat') {
                    $qqrt = $conn->query("SELECT * FROM `bunkodex_cat` WHERE act=1");
                    $qres = $qqrt->fetch_assoc();
                    echo "<tr><td class='normtd'>Category ID:</td><td>";
                    echo "
                    <select name='id_cat'>";
                        while ($qres) {
                            echo "<option value='".$qres['value']."'>".$qres['value']." - ".$qres['name']."</option>";
                        }
                        if ($qqrt->num_rows === 0){
                            echo "<option selected>NO RECORD IN THE DB</option>";
                        }
                    echo "</select></td></tr>
                    ";
                }
                echo "<tr>
                    <td class='normtd'>Description:</td>
                    <td class='normtd'><textarea name='desc'></textarea></td>
                </tr>
                <tr>
                    <td colspan='2'><input type='submit' value='ADD $typetitle'></td>
                </tr>
                ";
            } elseif ($action === 'edit') {
                echo "Esegui il codice per l'azione 'edit'";
            } else {
                echo "Azione non riconosciuta. Gestisci l'errore qui.";
            }
            ?>

        </tbody>
    </table>
<?php
    print_foot();
} else {
    session_expired();
} ?>