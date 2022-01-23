<?php
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    $query = "SELECT * FROM to_do";
    mysqli_query($conn, $query) or die('Error querying database');

    $result = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_array($result)) {
        echo "<script type='text/javascript' src='autodelete.js'></script>";
        echo "<tr>";
        echo "<td>";
        echo $row['item'];
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        $id = "delete.php?id=";
        $id .= $row['id'];
        echo "<td><a id='button' class= 'button' href='$id' >Delete Entry</a></td>";
        //echo "<td><button id=";
        //echo $row['id'];
        //echo " onclick='delete_data('";
        //echo $row['id'];
        //echo ")'p>Delete Entry</button></td>";
        echo "</tr>";
    }
    


    
    ?>