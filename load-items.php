<?php
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    while ($row = mysqli_fetch_array($result)) : ?>
        <tr>
              <!--Each table column is echoed in to a td cell-->
              <td><?php echo $row['item']; ?></td>
        </tr>
        <tr>
          <td><a id="button" class= 'button' href="delete.php?id=<?php echo $row['id']; ?>" >Delete Entry</a></td>
        </tr>
        <?php endwhile ?>
        <?
        mysqli_close($conn)
        ?>