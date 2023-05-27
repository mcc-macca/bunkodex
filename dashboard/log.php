<?php
session_start();
require '../lib/fundash.php';
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    require '../lib/conf.php';
    
    require '../lib/function.php';
    print_head('Dashboard');
    print_sidebar();

    if (isset($_GET['id'])) {
        $id_log = $_GET['id'];
        $em_log = $_SESSION['uid'];
        $log_sql = "SELECT * FROM bunkodex_log WHERE id = '$id_log' AND utente = '$em_log';";
        $log_res = $conn->query($log_sql);
        $log_num = mysqli_num_rows($log_res);
    } else {
        $per_pagina = 10;
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $offset = ($pagina - 1) * $per_pagina;
        $log_sql = "SELECT * FROM bunkodex_log LIMIT $per_pagina OFFSET $offset";
        $log_res = $conn->query($log_sql);
        $log_num = mysqli_num_rows($log_res);
        $num_pagine = ceil($log_num / $per_pagina);
    }


?>
    <h1>Access LOG</h1><br><br>
<?php
    if ($log_res->num_rows > 0) {
        echo "
<table border='2'>
    <tr>
        <th>ID</th>
        <th>UID</th>
        <th>DATE</th>
        <th>HOUR</th>
        <th>IP</th>
        <th>USER AGENT</th>
        <th>OS ARCH</th>
        <th>OS FAMILY</th>
        <th>OS UNAME</th>
    </tr>
";
        while ($row = mysqli_fetch_assoc($log_res)) {
            echo "
    <tr>
        <td style='text-align: center'>" . $row['id'] . "</td>
        <td style='text-align: center'>" . $row['utente'] . "</td>
        <td style='text-align: center'>" . $row['date'] . "</td>
        <td style='text-align: center'>" . $row['ora'] . "</td>
        <td style='text-align: center'><a href='https://extreme-ip-lookup.com/" . $row['ip'] . "'>" . $row['ip'] . "</a></td>
        <td style='text-align: center'>" . $row['user_agent'] . "</td>
        <td style='text-align: center'>" . $row['os_arch'] . "</td>
        <td style='text-align: center'>" . $row['os_type'] . "</td>
        <td style='text-align: center'>" . $row['os_uname'] . "</td>
    </tr>
    ";
        }
        echo "</table>";
        echo "<center>";
        if (isset($_GET['pagina']) > 1) {
            echo  "<a href='log.php?pagina=" . ($pagina - 1) . "'><button style='height: 35px; padding'>Previous page</button></a>";
        }
        if ($log_num == 10) {
            echo "<a href='log.php?pagina=" . ($pagina + 1) . "'><button style='height: 35px; padding'>Next page</button></a>";
        }
        echo "</center>";
    } else {
        echo "<h2 style='color: #ff0000'>LOG NOT FOUND!</h2>";
    }
    print_foot();
} else {
    session_expired();
} ?>