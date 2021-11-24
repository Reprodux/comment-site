<?php

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$query = "SELECT * FROM comment";
  mysqli_query($conn, $query) or die('Error querying database');

  $result = mysqli_query($conn,$query);

echo "Testing testing the php 123";
while ($row = mysqli_fetch_array($result)) : ?>
    <tr>
        <!--Each table column is echoed in to a td cell-->
        <td><?php echo $row['Email']; ?></td>

    </tr>
    
<?php  endwhile; 
mysqli_close($conn);?>
