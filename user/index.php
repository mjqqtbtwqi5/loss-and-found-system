<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/notice-table.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/user/nav.php"; ?>

    <div class="container container-md">
        <table class="table table-bordered">
            <colgroup>
                <col span="1">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 46%;">
                <col span="1" style="width: 9%;">
                <col span="1" style="width: 15%;">
            </colgroup>
            <thead>
                <tr class="bg-light">
                    <th scope="col" class="txt-center">Type</th>
                    <th scope="col">Title</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Time</th>
                    <th scope="col" class="txt-right">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php
                session_start();
                $user_id = $_SESSION['user']['id'];

                include "../util/connection.php";
                $sql = "SELECT user_id, nick_name, icon, notice_id, title, n.type, substr(date_time, 1, 16) date_time, venue, description, n.email, phone, image, substr(post_date_time, 1, 16) post_date_time FROM notice n, user u WHERE n.status = 'Pending' AND n.user_id = u.id ORDER BY n.post_date_time DESC";
                $result = mysqli_query($conn, $sql)
                    or die("Could not successfully run query.");
                mysqli_close($conn);

                if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count++;
                        $rowColor = $count % 2 == 0 ? "bg-light" : "";

                        $notice_user_id = $row['user_id'];
                        $icon = $row['icon'] == "" ? "./data/default/icon.png" : "../" . $row['icon'];
                        $nick_name = $row['nick_name'];
                        $notice_id = $row['notice_id'];
                        $title = $row['title'];
                        $type = $row['type'];
                        $date_time = $row['date_time'];
                        $venue = $row['venue'];
                        $description = $row['description'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $image = $row['image'];
                        $post_date_time = $row['post_date_time'];

                        echo
                        "<tr class='$rowColor'>
                            <td class='txt-center vertical-middle'>$type</td>
                            <td class='vertical-middle'>$title</td>
                            <td class='vertical-middle'>$venue</td>
                            <td class='vertical-middle'>$date_time</td>
                            <td class='txt-right vertical-middle'>
                                <a class='btn btn-outline-success' data-bs-toggle='collapse' href='#detail$notice_id' role='button' aria-expanded='false' aria-controls='collapseExample'>Detail</a>&nbsp;&nbsp;
                                ";
                        if($notice_user_id==$user_id) {
                            echo "<a class='btn btn-outline-success disabled' data-bs-toggle='collapse' href='#respond$notice_id' role='button' aria-expanded='false' aria-controls='collapseExample'>Respond</a>";
                        } else {
                            echo "<a class='btn btn-outline-success' data-bs-toggle='collapse' href='#respond$notice_id' role='button' aria-expanded='false' aria-controls='collapseExample'>Respond</a>";
                        }
                        echo
                            "</td>
                        </tr>";

                        echo
                        "<tr class='detail detail-border-bottom-0 $rowColor'>
                            <td colspan='5'>
                                <div class='collapse' id='detail$notice_id'>
                                    <div class='card card-body'>
                                        <div class='row g-0'>
                                            <div class='col-md-4'>
                                                <img src='../$image' class='img-fluid rounded-start' alt='No source image[$title]'>
                                            </div>
                                            <div class='col-md-8'>
                                                <div class='card-body'>
                                                    <h3 class='card-title card-head'>Description</h3>
                                                    <p class='card-text'>$description</p>

                                                    <h3 class='card-title card-head'>Contact</h3>
                                                    <p class='card-text'>
                                                        <img id='icon' src='$icon'> <b id='nick_name'>$nick_name</b><br>
                                                        Email: $email<br>
                                                        Phone: $phone
                                                    </p>

                                                    <p class='card-text'><small class='text-muted'>Post at: $post_date_time</small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>";

                        echo
                        "<tr class='respond respond-border-bottom-0 $rowColor'>
                            <td colspan='5'>
                                <form action='../util/sendResponse.php' method='POST'>
                                    <div class='collapse' id='respond$notice_id'>
                                        <div class='input-group mb-3'>
                                            <input type='hidden' name='notice_id' value='$notice_id' />
                                            <input type='text' name='message' class='form-control' placeholder='Respond a message' aria-label='Respond a message' aria-describedby='basic-addon2' required>
                                            <div class='input-group-append'>
                                                <button class='btn btn-outline-success' type='submit' onclick=\"confirmBeforeSubmit(event, 'Are you sure to send the message?');\">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>