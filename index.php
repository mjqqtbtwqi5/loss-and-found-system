<?php require "./util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/user-form.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/user-form.js"></script>
</head>

<body class="bg-light">
    <div class="container user-form">
        <?php
        if (isset($_COOKIE['user'])) {
            include "./util/connection.php";
            $id = stripcslashes($_COOKIE['user']);
            $sql = "SELECT * FROM user WHERE id = '$id'";
            $result = mysqli_query($conn, $sql)
                or die("Could not successfully run query.");
            mysqli_close($conn);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $id = $row['id'];
                $nick_name = $row['nick_name'];
                $type = $row['type'];
                $icon = $row['icon'] == "" ? "./user/data/default/icon.png" : "./" . $row['icon'];

                $entry = "./$type";
                $icon = "./$icon";

                setcookie("user", null, -1, "/");
                setcookie("user", $id, time() + (60 * 60 * 24), "/");

                session_start();
                $_SESSION['user'] = $row;
            } else {
                setcookie("user", null, -1, "/");
                header("Location: ./");
            }

        ?>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <h3 class="text-success">Lost-and-Found System</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h4>Welcome back</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span onclick="javascript:location.href='<?php echo $entry; ?>';" style="cursor: pointer;" class="badge rounded-pill text-bg-success fs-5">
                                <img style="border-radius: 50%;" width="40px" height="40px" src="<?php echo $icon; ?>" />&nbsp;&nbsp;&nbsp;<b><?php echo $nick_name; ?></b>&nbsp;&nbsp;
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class="row">
                <div class="col">
                    <form>
                        <div class="row">
                            <div class="col">
                                <h3 class="text-success">Lost-and-Found System</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h4>Sign in</h4>
                            </div>
                            <div class="col txt-right">
                                <a href="./registration.php">I don't have an account</a>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="ID" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div>
                            <button id="btn-login" class="btn btn-outline-success w-100">Sign in</button>
                        </div>
                        <div class="forgetPassword txt-center">
                            <a href="./forgetPassword.php">Can't sign in? / Reset password</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>