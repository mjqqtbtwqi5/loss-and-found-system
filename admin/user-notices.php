<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/notice-table.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/admin/nav.php"; ?>

    <div class="container container-md">
        <?php
        $nick_name = $_POST['nick_name'];
        ?>
        <h1><?php echo "Notices created by <u>$nick_name</u>"; ?></h1>
        <table class="table table-bordered">
            <colgroup>
                <col span="1">
                <col span="1">
                <col span="1" style="width: 30%;">
                <col span="1" style="width: 60%;">
                <col span="1" style="width: 10%;">
                <col span="1">
            </colgroup>
            <thead>
                <tr class="bg-light">
                    <th scope="col" class="txt-center">Status</th>
                    <th scope="col" class="txt-center">Type</th>
                    <th scope="col">Title</th>
                    <th scope="col">Venue</th>
                    <th scope="col">Time</th>
                    <th scope="col" class="txt-center">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">

                <?php
                $user_id = $_POST['user_id'];

                include "../util/connection.php";
                $sql =
                    "SELECT n.notice_id notice_id, u1.nick_name c_nick_name, u2.nick_name r_nick_name, u1.icon c_icon, u2.icon r_icon, u2.email r_email, message, substr(response_date_time, 1, 16) response_date_time, title, n.type type, status, substr(date_time, 1, 16) date_time, venue, description, n.email email, phone, image, substr(post_date_time, 1, 16) post_date_time 
                FROM user u1 
                LEFT JOIN notice n ON u1.id = n.user_id 
                LEFT JOIN response r ON n.notice_id = r.notice_id 
                LEFT JOIN user u2 ON r.user_id = u2.id 
                WHERE u1.id = '$user_id' ORDER BY post_date_time DESC";

                $result = mysqli_query($conn, $sql)
                    or die("Could not successfully run query.");
                mysqli_close($conn);

                if (mysqli_num_rows($result) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $notice_id = $row['notice_id'];
                        if (!isset($notice_id)) {
                            continue;
                        }
                        $count++;
                        $rowColor = $count % 2 == 0 ? "bg-light" : "";

                        $c_nick_name = $row['c_nick_name'];
                        $r_nick_name = $row['r_nick_name'];
                        $c_icon = $row['c_icon'] == "" ? "./data/default/icon.png" : "../" . $row['c_icon'];
                        $r_icon = $row['r_icon'] == "" ? "./data/default/icon.png" : "../" . $row['r_icon'];
                        $r_email = $row['r_email'];
                        $message = $row['message'];
                        $response_date_time = $row['response_date_time'];

                        $title = $row['title'];
                        $type = $row['type'];
                        $status = $row['status'];
                        $statusColor = $status == 'Completed' ? "bg-success text-light" : "";
                        $date_time = $row['date_time'];
                        $venue = $row['venue'];
                        $description = $row['description'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $image = $row['image'];
                        $post_date_time = $row['post_date_time'];

                        echo
                        "<tr class='$rowColor'>
                            <td class='txt-center vertical-middle $statusColor'>$status</td>
                            <td class='txt-center vertical-middle'>$type</td>
                            <td class='vertical-middle'>$title</td>
                            <td class='vertical-middle'>$venue</td>
                            <td class='vertical-middle'>$date_time</td>
                            <td class='txt-center vertical-middle'>
                                <a class='btn btn-outline-success' data-bs-toggle='collapse' href='#detail$notice_id' role='button' aria-expanded='false' aria-controls='collapseExample'>Detail</a>
                            </td>
                        </tr>";

                        echo
                        "<tr class='detail $rowColor'>
                            <td colspan='6'>
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
                                                    <div class='row'>";
                        if (isset($r_email)) {
                            echo
                            "<div class='col-md-6'>";
                        } else {
                            echo
                            "<div class='col-md-12'>";
                        }
                        echo
                        "<h3 class='card-title card-head'>Contact</h3>
                                                            <p class='card-text'>
                                                                <img id='icon' src='$c_icon'> <b id='nick_name'>$c_nick_name</b><br>
                                                                Email: $email<br>
                                                                Phone: $phone
                                                            </p>
                                                            <p class='card-text'><small class='text-muted'>Post at: $post_date_time</small></p>
                                                        </div>";

                        if (isset($r_email)) {
                            echo
                            "<div class='col-md-6'>
                                                            <h3 class='card-title card-head'>Response</h3>
                                                            <p class='card-text'>$message</p>
                                                            <p class='card-text'>
                                                                <img id='icon' src='$r_icon'> <b id='nick_name'>$r_nick_name</b><br>
                                                                Email: $r_email
                                                            </p>
                                                            <p class='card-text'><small class='text-muted'>Respond at: $response_date_time</small></p>
                                                        </div>";
                        }
                        echo "
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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