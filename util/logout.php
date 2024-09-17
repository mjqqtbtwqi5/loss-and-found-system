<?php
    setcookie("user", null, -1, "/");
    session_start();
    session_unset();
    session_destroy();
    header("Location: /lost-and-found-system");
    exit();
?>