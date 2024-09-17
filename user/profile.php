<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/profile-form.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/user/nav.php"; ?>

    <?php
    session_start();
    $icon = $_SESSION['user']['icon'] == "" ? "./data/default/icon.png" : "../" . $_SESSION['user']['icon'];
    $id = $_SESSION['user']['id'];
    $nick_name = $_SESSION['user']['nick_name'];
    $email = $_SESSION['user']['email'];
    $gender = $_SESSION['user']['gender'];
    $birthday = $_SESSION['user']['birthday'];
    ?>
    <div class="container container-md profile">
        <div class='row g-0'>
            <div class='col-md-4 profile-icon'>
                <div class="card bg-light mb-3">
                    <div class="card-header">Profile Icon</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img id="imageView" src="<?php echo $icon; ?>" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="../util/uploadImage.php" method="POST" enctype="multipart/form-data">
                                    <div class='input-group mb-3'>
                                        <input onchange="updateImageView('uploadImage', 'imageView');" class="form-control" type="file" name="uploadImage" id="uploadImage" title="Please select a jpg/jpeg/png format file." accept="image/png, image/jpeg" required>
                                        <div class='input-group-append'>
                                            <button class='btn btn-outline-success' type='submit' onclick="confirmBeforeSubmit(event, 'Are you sure to upload the icon?');">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-8 profile-detail'>
                <div class="card bg-light mb-3">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="../util/updateProfile.php" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id" value="<?php echo $id; ?>" disabled />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="nick_name" class="form-label">Nick Name</label>
                                        <input type="text" class="form-control" id="nick_name" name="nick_name" value="<?php echo $nick_name; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <input type="text" class="form-control" id="gender" value="<?php echo $gender; ?>" disabled />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="birthday" class="form-label">Birthday</label>
                                        <input type="text" class="form-control" id="birthday" value="<?php echo $birthday; ?>" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 txt-right">
                                        <button class='btn btn-outline-success' type='submit' onclick="confirmBeforeSubmit(event, 'Are you sure to update personal information?');">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>