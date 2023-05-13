<?php 
require '../lib/funinst.php';
print_head("Install");
?>
    <div class="main">
        <h2>Click on the INSTALL button to proceed with the installation of the database.</h2>
        <center><button onclick="dbinstall()"><b>INSTALL</b></button></center>
    </div>
    <?php print_foot(); ?>
    <script>
        function dbinstall() {
            window.location.replace(
                "installdb.php"
            );
        }
    </script>
</body>

</html>