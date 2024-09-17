<?php require "./util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/user-form.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/user-form.js"></script>
</head>

<body class="bg-light">
    <div class="container user-form">
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
                            <h4>Sign up</h4>
                        </div>
                        <div class="col txt-right">
                            <a href="./">I have an account</a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_id">ID</label>
                        <input type="text" class="form-control" id="reg_id" aria-describedby="idHelp" placeholder="ID" maxlength="15" required>
                        <small id="idHelp" class="form-text text-danger" hidden>User ID already exist.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" maxlength="30" required>
                    </div>
                    <div class="form-group">
                        <label for="id">Nick Name</label>
                        <input type="text" class="form-control" id="nick_name" placeholder="Nick Name" maxlength="30" required>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group">
                                <label for="birthday">Birthday</label>
                                <input type="date" class="form-control" id="birthday" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="btn-regirstartion" class="btn btn-outline-success w-100">Sign up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>