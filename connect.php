<?php
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_Post['comment'];

if(empty($name)){
    $name = "N/A";
}
if(empty($email)){
    $email = "N/A";
}
if(empty($comment)){
    $comment = "N/A";
}

if(!empty($name) || !empty($email) || !empty($comment)){

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    if(mysqli_connect_error()){
        die('Connemt Error('. mysqli_connect_errno().')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From comment Where email = ? Limit 1";
        $INSERT ="INSERT Into comment (name, email, comment) values(?, ?, ?)";

        $stmt = $conn -> prepare ($SELECT);
        $stmt -> bind_param("s", $email);
        $stmt -> execute();
        $stmt -> bind_result($email);
        $stmt -> store_result();
        $rnum = $stmt -> num_rows;

        if($rnum == 0){
            $stmt -> close();
            $stmt = $conn -> prepare($INSERT);
            $stmt -> bind_param("sss", $name, $email, $comment);
            $stmt -> execute();
            echo "Comment saved!";
            header("location: https://comment-site.herokuapp.com/");
            exit();
        } else{
            echo "To prevent clutter, one comment from an email is allowed";
        }
        $stmt -> close();
        mysqli_close($conn);
    }

}

?>
