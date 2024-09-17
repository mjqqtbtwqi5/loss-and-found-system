<?php require "../util/const.php"; ?>
<?php require "$SERVER_ROOT/page/common/header.php"; ?>
<?php
include "../util/connection.php";
$sql = "SELECT
    SUM(IF(age < 10,1,0)) as 'Under 10',
    SUM(IF(age BETWEEN 10 and 29,1,0)) as '10 - 29',
    SUM(IF(age BETWEEN 30 and 49,1,0)) as '30 - 49',
    SUM(IF(age BETWEEN 50 and 69,1,0)) as '50 - 69',
    SUM(IF(age > 70,1,0)) as 'Greater than 70' 
    FROM 
    (SELECT TIMESTAMPDIFF(YEAR, birthday, CURDATE()) age FROM user u, notice n WHERE u.id = n.user_id) a;";

$result = mysqli_query($conn, $sql)
    or die("Could not successfully run query.");
mysqli_close($conn);
$row = mysqli_fetch_assoc($result);
$under10 = $row['Under 10'];
$between1029 = $row['10 - 29'];
$between3049 = $row['30 - 49'];
$between5069 = $row['50 - 69'];
$greater70 = $row['Greater than 70'];
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });

    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['Under 10', <?php echo $under10;?>],
            ['Between 10 and 29', <?php echo $between1029;?>],
            ['Between 30 and 49', <?php echo $between3049;?>],
            ['Between 50 and 69', <?php echo $between5069;?>],
            ['Greater than 70', <?php echo $greater70;?>]
        ]);

        var options = {
            'title': 'Statistics of the number of notices in different age ranges amonng users.',
            'width': 1000,
            'height': 1000
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<script defer src="<?php echo $URL_ROOT; ?>/js/nav-control.js"></script>
</head>

<body>
    <?php require "$SERVER_ROOT/admin/nav.php"; ?>

    <div class="container container-md" id="chart_div">
    </div>
</body>

</html>