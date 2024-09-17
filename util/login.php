<?php
    include "connection.php";

    $id = $_POST['id'];
    $password = $_POST['password'];

    $id = stripcslashes($id);
    $password = stripcslashes($password);

    $sql = "SELECT * FROM user WHERE id = '$id' AND password = '$password'";
    $result = mysqli_query($conn, $sql) 
        or die("Could not successfully run query.");
    mysqli_close($conn);
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $type = $row['type'];

        setcookie("user", null, -1, "/");
        setcookie("user", $id, time() + (60 * 60 * 24), "/");

        session_start();
        $_SESSION['user'] = $row;

        echo json_encode(array("success" => true, "user_type" => $type));
    } else {
        echo json_encode(array("success" => false));
    }
    exit();
?>