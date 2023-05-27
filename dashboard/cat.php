<?php
session_start();
require '../lib/fundash.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    require '../lib/conf.php';
    require '../lib/function.php';
    print_head('Dashboard');
    print_sidebar();

    $catquery = QRYCAT;
    $catres = $conn->query($catquery);
    $cat = $catres->fetch_assoc();
?>
    <h1>Category</h1><br><br>
    <a href="crud.php?type=cat&action=add">
        <button class="crudbutton">
            <b>ADD CATEGORY</b>
        </button>
    </a>
    <br><br>
    <?php 
    echo "<table>
    <thead>
    <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>VALUE</th>
    <th>ACTION</th></tr>
    </thead>
    <tbody>";
    if ($catres->num_rows != 0) {
        while ($cat) {
            echo "
            <tr>
                <td style='text-align-center'>".$cat['id']."</td>
                <td style='text-align-center'>".$cat['name']."</td>
                <td style='text-align-center'>".$cat['value']."</td>
            </tr>
            ";
        }
    } else {
        echo "<tr><td colspan='4'><center><h1 style='color: #ff0000'>NO RESULTS FOUND IN DATABASE!</h1></center></td></tr>";
    }
    echo "</tbody></table>";
    ?>
<?php
    print_foot();
} else {
    session_expired();
} ?>