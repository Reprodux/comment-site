<?php
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    echo "<script> console.log(1) </script>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>";
        echo $row['item'];
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        $id = "delete.php?id=";
        $id .= $row['id'];
        echo "<td><a id='button' class= 'button' href='$id' >Delete Entry</a></td>";
        echo "</tr>";
    }
    echo "<script> console.log(2) </script>";
    ?>