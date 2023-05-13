<?php
session_start();
require '../lib/funinst.php';
require '../lib/function.php';
require '../lib/conf.php';
print_head("Setup complete");
$data = read_json('../bunkodex.json');
$version = $data['version'];
$_SESSION['logged'] = true;
?>
<div class="main">
    <center>
        <h1>Good Job! You succesfully install Macca Computer BunkoDEX!</h1><br><br>
        <h2>BunkoDEX <?= $version ?> succesfully registered to <?= NAME_DEX ?></h2><br>
        <h3>Remember to rename or delete the <code>install</code> folder!</h3>
        <button onclick="openDash()"><b>OPEN DASHBOARD</b></button>
    </center>
</div>
<script>
    function openDash() {
        window.location.replace(
            "../dashboard/index.php"
        );
    }
</script>
<?php
print_foot();
?>