<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/user/create-notice.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/user/nav.php"; ?>
    <?php
        session_start();
        $email = $_SESSION['user']['email'];
    ?>
    <div class="container my-5">
        <div class="card">
            <form action="<?php echo $URL_ROOT; ?>/util/insertNotice.php" method="POST" enctype="multipart/form-data">
                <div class="card-header py-4 px-5 bg-light border-0">
                    <h4 class="mb-0 fw-bold">Create Notice</h4>
                </div>

                <div class="card-body px-5">

                    <div class="row gx-xl-5">
                        <div class="col-md-4">
                            <h5>Item</h5>
                            <p class="text-muted">You can create a notice for lost or found item, an image of the item is optional.</p>
                        </div>

                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" required />
                            </div>
                            <div class="mb-3">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type-lost" value="Lost" checked />
                                    <label class="form-check-label" for="type-lost">Lost</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="type-found" value="Found" />
                                    <label class="form-check-label" for="type-found">Found</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="uploadImage" class="form-label">Image of item</label>
                                <input onchange="updateImageView('uploadImage', 'imageView');" class="form-control" type="file" name="uploadImage" id="uploadImage" title="Please select a jpg/jpeg/png format file." accept="image/png, image/jpeg" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <img id="imageView" class="img-fluid" >
                            </div>
                        </div>
                    </div>

                    <hr class="my-5" />

                    <div class="row gx-xl-5">
                        <div class="col-md-4">
                            <h5>Detail</h5>
                            <p class="text-muted">Please describe when and where you lost or found the item. Please also describe the item.</p>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_time" class="form-label">Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="date_time" name="date_time" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="venue" class="form-label">Venue</label>
                                        <input type="text" class="form-control" id="venue" name="venue" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="description" placeholder="Leave description here." name="description"></textarea>
                                            <label for="description">Description</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-5" />

                    <div class="row gx-xl-5">
                        <div class="col-md-4">
                            <h5>Contact</h5>
                            <p class="text-muted">Please leave your contact.</p>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{8}" title="8 digit phone number." required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-end py-4 px-5 bg-light border-0">
                    <button type="reset" class="btn btn-link btn-rounded" data-ripple-color="primary">Clear</button>
                    <button type="submit" class="btn btn-primary btn-rounded" onclick="confirmBeforeSubmit(event, 'Are you sure to create this notice?');">Create</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>