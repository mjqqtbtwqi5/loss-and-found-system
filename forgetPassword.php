<?php require "./util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/user-form.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/user-form.js"></script>
</head>

<body class="bg-light">
    <div class="container user-form">
        <div class="row">
            <div class="col">
                <form action="./util/resetPassword.php" method="POST">
                    <div class="row">
                        <div class="col">
                            <h3 class="text-success">Lost-and-Found System</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>Password Reset</h5>
                        </div>
                        <div class="col txt-right">
                            <a href="./">Back to sign-in</a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" class="form-control" name="id" id="id" placeholder="ID" required>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" name="birthday" id="birthday" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm Password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-outline-success w-100">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>