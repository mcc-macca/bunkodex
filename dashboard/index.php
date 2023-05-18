<?php
session_start();
$_SESSION['username'] = "macca";
require '../lib/conf.php';
require '../lib/fundash.php';
require '../lib/function.php';
print_head('Dashboard');
print_sidebar();
$message = check_version();

$cat = $conn->query(QRYCAT);
$numcat = $cat->num_rows;

$subcat = $conn->query(QRYSCAT);
$numscat = $subcat->num_rows;

$product = $conn->query(QRYPRO);
$numprod = $product->num_rows;
?>
<center>
  <img src='../img/bd_alpha.svg'>
</center>
<?php 
$log = $conn->query("SELECT * FROM `bunkodex_log` WHERE `utente`='".$_SESSION['username']."';");
$rislog = $log->fetch_assoc();
$numlog = $log->num_rows;

if ($numlog > 0) {
  echo "<hr>
  <p>Last login on <b>".$rislog['date']."</b> at <b>09:40:47</b> at IP <b>127.0.0.1</b>, visualizza i <a href='log/index.php?id=37'>LOG</a> per pi&ugrave; informazioni.</p>
  <hr>";
} else {
  echo "STICKY JOE!!";
}

?>
<div class='titolo'>
  <h1>Hi {{user}}!</h1>
</div>
<div class='info'>
  <table class='tabella_index'>
    <tr>
      <td class='td'>UID:</td>
      <td class='td'>Macca</td>
      <td rowspan='5' class='longtd'><?= $message ?></td>
    </tr>
    <tr>
      <td class='td'>Installation date:</td>
      <td class='td'><?= INST_DATE ?></td>
    </tr>
    <tr>
      <td class='td'>Categories:</td>
      <td class='td'><?= $numcat ?></td>
    </tr>
    <tr>
      <td class='td'>Sub-Categories:</td>
      <td class='td'><?= $numscat ?></td>
    </tr>
    <tr>
      <td class='td'>Products:</td>
      <td class='td'><?= $numprod ?></td>
    </tr>
  </table>
</div>
</div>
<?php print_foot(); ?>