<?php
    include "connection.php";
    
    session_start();
    $user_id = $_SESSION['user']['id'];

    $message = stripcslashes($_POST['message']);
    $notice_id = stripcslashes($_POST['notice_id']);

    mysqli_autocommit($conn, FALSE);
    $sql = "INSERT INTO response (notice_id, user_id, message) VALUES ($notice_id, '$user_id', '$message')";
    $success = TRUE;
    if(mysqli_query($conn, $sql)) {
        $sql = "UPDATE notice SET status = 'Completed' WHERE notice_id = '$notice_id'";
        if(mysqli_query($conn, $sql)) {
            if(!mysqli_commit($conn)) {
                $success = FALSE;
            }
        } else {
            $success = FALSE;
        }
    } else {
        $success = FALSE;
    }

    mysqli_close($conn);
    if($success) {
        echo 
        "<script>
            alert('Thank you for your response!');
            location.href = '../user/my-notices.php';
        </script>";
    } else {
        echo 
        "<script>
            alert('Send response failed! Please try again.');
            location.href = '../user/';
        </script>";
    }
    exit();
?>