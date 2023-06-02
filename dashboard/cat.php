<?php
session_start();
require '../lib/fundash.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    require '../lib/conf.php';
    require '../lib/function.php';
    print_head('Dashboard');
    print_sidebar();
    $catres = $conn->query(QRYCAT . "WHERE `act`='1'");
    $binres = $conn->query(QRYCAT . "WHERE `act`='0'");
    
    if (isset($_GET['rid'])) {
        $rid = html_string($_GET['rid']);
        $prid = "UPDATE `bunkodex_cat` SET `act`='0' WHERE `id`='$rid';";
        if ($conn->query($prid)){
            $msg = 'Category set to un-active';
            header('location: cat.php');
        } else {
            $error = 'ERROR';
        }
    }
    if (isset($_GET['rrid'])) {
        $rrid = html_string($_GET['rid']);
        $pprid = "DELETE FROM `bunkodex_cat` WHERE `id`='$rrid'";
        if ($conn->query($pprid)){
            $msg = 'Category delete permanently';
            header('location: cat.php');
        } else {
            $error = 'ERROR';
        }
    }
    if (isset($_GET['restore'])) {
        $rrrid = html_string($_GET['restore']);
        $ppprid = "UPDATE `bunkodex_cat` SET `act`='1' WHERE `id`='$rrrid';";
        if ($conn->query($ppprid)){
            $msg = 'Category restore sucessfully!';
            header('location: cat.php');
        } else {
            $error = 'ERROR';
        }
    }
?>
    <h1>Category</h1><br><br>
    <?php 
    if (isset($error)) {
        echo html_string($error);
    } 
    ?>
    <a href="cat-add.php">
        <button class="crudbutton">
            <b>ADD CATEGORY</b>
        </button>
    </a>
    <br><br><table class="sumview">
    <thead>
    <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>VALUE</th>
    <th>ACTION</th></tr>
    </thead>
    <tbody><?php
    if ($catres->num_rows != 0) {
        while ($cat = $catres->fetch_assoc()) {
            print "
            <tr>
                <td style='text-align: center; width: 50px'>".$cat['id']."</td>
                <td>".$cat['name']."</td>
                <td>".$cat['value']."</td>
                <td>
                    <a href='cat-mod.php?id=".$cat['id']."'><img src='../img/modifica.png' alt='MOD'></a>
                    <a href='cat.php?rid=".$cat['id']."'><img src='../img/delete.png' alt='DEL'></a>
                </td>
            </tr>
            ";
        }
    } else {
        print "<tr><td colspan='4' style='width: 600px'><center><h1 style='color: #ff0000'>NO RESULTS FOUND IN DATABASE!</h1></center></td></tr>";
    }
    ?>
    </tbody></table>
    <hr>
    <h1>Un-Active category</h1><br><br>
    <table class="sumview">
    <thead>
    <tr>
    <th>ID</th>
    <th>NAME</th>
    <th>VALUE</th>
    <th>ACTION</th></tr>
    </thead>
    <tbody><?php
    if ($binres->num_rows != 0) {
        while ($bin = $binres->fetch_assoc()) {
            print "
            <tr>
                <td style='text-align: center; width: 50px'>".$bin['id']."</td>
                <td>".$bin['name']."</td>
                <td>".$bin['value']."</td>
                <td>
                    <a href='cat.php?restore=".$bin['id']."'><img src='../img/modifica.png' alt='MOD'></a>
                    <a href='cat.php?rrid=".$bin['id']."'><img src='../img/delete.png' alt='DEL'></a>
                </td>
            </tr>
            ";
        }
    } else {
        print "<tr><td colspan='4' style='width: 600px'><center><h1 style='color: #ff0000'>NO RESULTS FOUND IN DATABASE!</h1></center></td></tr>";
    }
    ?>
<?php
    print_foot();
} else {
    session_expired();
} ?>