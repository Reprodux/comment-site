<?php
$item = $_POST['item'];


if(empty($item)){
    $name = "N/A";
}

if(!empty($item)){

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT id From to_do Where id = ? Limit 1";
        $INSERT ="INSERT Into to_do (item) values(?)";

        $stmt = $conn -> prepare ($SELECT);
        $stmt -> bind_param("s", $item);
        $stmt -> execute();
        $stmt -> bind_result($item);
        $stmt -> store_result();
        $rnum = $stmt -> num_rows;

        if($rnum == 0){
            $stmt -> close();
            $stmt = $conn -> prepare($INSERT);
            $stmt -> bind_param("s", $item);
            $stmt -> execute();
            echo "item saved!";
        } else{
            echo "There is already an existing item on the list";
        }
        $stmt -> close();
        mysqli_close($conn);
        //header("location: https://comment-site.herokuapp.com");
        exit();
    }

}

?>
