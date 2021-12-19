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

$id = $_GET['id'];

$delete = mysqli_query($conn, "DELETE FROM comment WHERE id = '$id'");

echo $delete;

if($delete){
    mysqli_close($db);
    header("location: https://comment-site.herokuapp.com");
    exit();
}
else{
    echo "Error deleting record";
}


?>
