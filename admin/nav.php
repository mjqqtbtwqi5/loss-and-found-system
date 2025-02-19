<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-success">Lost-and-Found System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL_ROOT;?>/admin/">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL_ROOT;?>/admin/notices-pending.php">Notices[Pending]</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL_ROOT;?>/admin/notices-completed.php">Notices[Completed]</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $URL_ROOT;?>/admin/statistics.php">System Statistics</a>
                </li>
            </ul>
            <form class="d-flex" action="<?php echo $URL_ROOT;?>/util/logout.php" method="POST">
                <button class="btn btn-outline-success" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>