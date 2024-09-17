<?php
    include "connection.php";

    session_start();
    $id = stripcslashes($_SESSION['user']['id']);

    $title = stripcslashes($_POST['title']);
    $type = stripcslashes($_POST['type']);

    $img_name = $_FILES['uploadImage']['name'];
    $tmp_name = $_FILES['uploadImage']['tmp_name'];
    $error = $_FILES['uploadImage']['error'];
    $img_path = "";

    if($error === 0) {
        $ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $allowed_ext = array("jpg", "jpeg", "png"); 

        if(in_array($ext, $allowed_ext)) {
            $img_upload_path = "user/data/$id/notices/";
            if (!file_exists("../$img_upload_path")) {
                mkdir("../$img_upload_path", 0777, true);
            }
            
            $new_img_name = uniqid("NTC-", true).".$ext";
            $img_path = $img_upload_path.$new_img_name;
            move_uploaded_file($tmp_name, "../$img_path");
        } else {
            echo 
            "<script>
                alert('Please upload a file with jpg/jpeg/png format.');
                location.href = '../user/create-notice.php';
            </script>";
        }
    } else {
        echo 
        "<script>
            alert('Unknown image uploading error occurred! Please try again.');
            location.href = '../user/create-notice.php';
        </script>";
    }

    $date_time = stripcslashes($_POST['date_time']);
    $venue = stripcslashes($_POST['venue']);
    $description = stripcslashes($_POST['description']);

    $email = stripcslashes($_POST['email']);
    $phone = stripcslashes($_POST['phone']);

    $sql = "INSERT INTO notice 
        (user_id, title, type, status, date_time, venue, email, phone, description, image) 
        VALUES ('$id', '$title', '$type', 'Pending', '$date_time', '$venue', '$email', '$phone', '$description', '$img_path')";
    
    $result = mysqli_query($conn, $sql) 
        or die("Could not successfully run query.");
    mysqli_close($conn);

    if($result) {
        echo 
        "<script>
            if(confirm('Created successfully. Create another notice?')){
                location.href = '../user/create-notice.php';
            } else {
                location.href = '../user/';
            }
        </script>";
    } else {
        echo 
        "<script>
            alert('Create notice failed! Please try again.');
            location.href = '../user/create-notice.php';
        </script>";
    }
    exit();
