<?php
include "connection.php";

session_start();
$id = stripcslashes($_SESSION['user']['id']);
$email = stripcslashes($_POST['email']);
$nick_name = stripcslashes($_POST['nick_name']);

$sql = "UPDATE user SET email = '$email', nick_name = '$nick_name' WHERE id = '$id'";

$result = mysqli_query($conn, $sql)
    or die("Could not successfully run query.");
mysqli_close($conn);

if ($result) {
    $_SESSION['user']['email'] = $email;
    $_SESSION['user']['nick_name'] = $nick_name;
    echo
    "<script>
            alert('Upload icon successfully!');
            location.href = '../user/profile.php';
        </script>";
} else {
    echo
    "<script>
            alert('Upload icon failed! Please try again.');
            location.href = '../user/profile.php';
        </script>";
}
exit();