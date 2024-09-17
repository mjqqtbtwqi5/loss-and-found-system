<?php
    include "connection.php";

    $email = stripcslashes($_POST['email']);
    $id = stripcslashes($_POST['id']);
    $password = stripcslashes($_POST['password']);
    $nick_name = stripcslashes($_POST['nick_name']);
    $gender = stripcslashes($_POST['gender']);
    $birthday = stripcslashes($_POST['birthday']);

    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $sql) 
        or die("Could not successfully run query.");

    if(mysqli_num_rows($result) === 1) {
        mysqli_close($conn);
        echo json_encode(array("success" => false, "error" => "id_exist"));
        exit();
    }

    $sql = "INSERT INTO user VALUES ('$id', '$password', '$email', '$nick_name', '$gender', '$birthday', 'user', '')";
    $result = mysqli_query($conn, $sql) 
        or die("Could not successfully run query.");
    mysqli_close($conn);

    if($result) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false));
    }
    exit();
?>