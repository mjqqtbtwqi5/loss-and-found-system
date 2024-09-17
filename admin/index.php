<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<link rel="stylesheet" href="<?php echo $URL_ROOT; ?>/css/admin/users.css">
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/admin/nav.php"; ?>
    <?php

    $sql = "SELECT u.id user_id, u.nick_name, notice_created, notice_responded FROM user u 
        LEFT JOIN (SELECT COUNT(*) notice_created, n.user_id user_id FROM notice n GROUP BY n.user_id) n ON u.id = n.user_id 
        LEFT JOIN (SELECT COUNT(*) notice_responded, r.user_id user_id FROM response r GROUP BY r.user_id) r ON u.id = r.user_id 
        WHERE u.type = 'user' ORDER BY u.nick_name ASC";

    ?>
    <div class="container container-md">
        <table class="table table-bordered table-hover table-striped" id="tb-users">
            <colgroup>
                <col span="1">
                <col span="1" style="width: 19%;">
                <col span="1" style="width: 21%;">
            </colgroup>
            <thead>
                <tr>
                    <th scope="col">Nick Name</th>
                    <th scope="col" class="txt-right">Notices Created</th>
                    <th scope="col" class="txt-right">Notices Responed</th>
                </tr>
            </thead>
            <tbody>

                <?php

                include "../util/connection.php";
                $sql = "SELECT u.id user_id, u.nick_name, notice_created, notice_responded FROM user u 
                LEFT JOIN (SELECT COUNT(*) notice_created, n.user_id user_id FROM notice n GROUP BY n.user_id) n ON u.id = n.user_id 
                LEFT JOIN (SELECT COUNT(*) notice_responded, r.user_id user_id FROM response r GROUP BY r.user_id) r ON u.id = r.user_id 
                WHERE u.type = 'user' ORDER BY u.nick_name ASC";

                $result = mysqli_query($conn, $sql)
                    or die("Could not successfully run query.");
                mysqli_close($conn);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $user_id = $row['user_id'];
                        $nick_name = $row['nick_name'];
                        $notice_created = isset($row['notice_created']) ? $row['notice_created'] : "0";
                        $viewCreatedNotices = isset($row['notice_created']) ? "" : "disabled";
                        $notice_responded = isset($row['notice_responded']) ? $row['notice_responded'] : "0";

                        echo
                        "<tr>
                            <td class='vertical-middle'>$nick_name</td>
                            <td class='txt-right vertical-middle'>
                                <form action='./user-notices.php' method='POST'>
                                    <input type='hidden' name='user_id' value='$user_id' />
                                    <input type='hidden' name='nick_name' value='$nick_name' />
                                    <button type='submit' class='btn btn-link' $viewCreatedNotices>$notice_created</button>
                                </form>
                            </td>
                            <td class='txt-right vertical-middle'>$notice_responded</td>
                        </tr>";
                    }
                }
                ?>
        </table>
    </div>
</body>

</html>