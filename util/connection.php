<?php
    $server = "localhost";
    $user = "root";
    $pw = "";
    $db = "eie4431-project";
    $conn = mysqli_connect($server, $user, $pw, $db)
        or die("Connection failed: " . mysqli_connect_error());
?>