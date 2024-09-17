<?php
$password = stripcslashes($_POST['password']);
$cpassword = stripcslashes($_POST['cpassword']);
if ($password != $cpassword) {
    echo
    "<script>
        alert('Password and Confirm Password unmatch! Please try again.');
        location.href = '../forgetPassword.php';
    </script>";
} else {
    include "connection.php";

    $id = stripcslashes($_POST['id']);
    $gender = stripcslashes($_POST['gender']);
    $birthday = stripcslashes($_POST['birthday']);

    $sql = "UPDATE user SET password = '$password' 
        WHERE id = '$id' AND gender = '$gender' AND birthday = '$birthday' AND type = 'user'";

    $result = mysqli_query($conn, $sql)
        or die("Could not successfully run query.");

    if (mysqli_affected_rows($conn) > 0) {
        echo
        "<script>
                alert('Password resetted successfully!');
                location.href = '../';
            </script>";
    } else {
        echo
        "<script>
                alert('Password reset failed! Please check the personal information are correct.');
                location.href = '../forgetPassword.php';
            </script>";
    }
    mysqli_close($conn);
}

exit();
?>