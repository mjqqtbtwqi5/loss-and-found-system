<?php
include "connection.php";

session_start();
$id = stripcslashes($_SESSION['user']['id']);

$img_name = $_FILES['uploadImage']['name'];
$tmp_name = $_FILES['uploadImage']['tmp_name'];
$error = $_FILES['uploadImage']['error'];
$img_path = "";

if ($error === 0) {
    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $allowed_ext = array("jpg", "jpeg", "png");

    if (in_array($ext, $allowed_ext)) {
        $img_upload_path = "user/data/$id/";
        if (!file_exists("../$img_upload_path")) {
            mkdir("../$img_upload_path", 0777, true);
        }

        if (file_exists("../$img_upload_path/icon")) {
            chmod("../$img_upload_path/icon", 0755);
            unlink("../$img_upload_path/icon");
        }

        $new_img_name = "icon.$ext";
        $img_path = $img_upload_path . $new_img_name;
        move_uploaded_file($tmp_name, "../$img_path");
    } else {
        echo
        "<script>
                alert('Please upload a file with jpg/jpeg/png format.');
                location.href = '../user/profile.php';
            </script>";
    }
} else {
    echo
    "<script>
            alert('Unknown image uploading error occurred! Please try again.');
            location.href = '../user/profile.php';
        </script>";
}

$sql = "UPDATE user SET icon = '$img_path' WHERE id = '$id'";

$result = mysqli_query($conn, $sql)
    or die("Could not successfully run query.");
mysqli_close($conn);

if ($result) {
    $_SESSION['user']['icon'] = $img_path;
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