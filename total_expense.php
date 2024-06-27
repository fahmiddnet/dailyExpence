<?php  $user_info = $_SESSION['id'];?>

<?php 
    include('db/connect.php'); 
 
?>

<?php 
    $sql_data = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE user_id = '$user_info'  GROUP BY catagory";
    $result = mysqli_query($conn,$sql_data); 
    // Prepare data for Highchatts 
    $data = array();
    // print_r($result2);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $data[] = array($row["catagory"], (int)$row["total_price"]);
        }
    };

      mysqli_close($conn);
      // Encode data to JSON format
      $json_data = json_encode($data);
    //   print_r($json_data);


?>


<!-- START::Highchart area  -->
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/accessibility.js"></script>


                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>

<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Total Expenses'
    },
    credits:{
        enabled:false
    },
    tooltip: {
        valueSuffix: '💲'
    },
    subtitle: {
        text:
        'Source:<a href="https://www.dnet.org.bd" target="_default">Idea</a>'
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
                enabled: true,
                distance: 20
            }, {
                enabled: true,
                distance: -40,
                format: '{point.percentage:.1f}%',
                style: {
                    fontSize: '1em',
                    textOutline: 'none',
                    opacity: 0.7
                }
            }]
        }
    },
    series: [{
        type: 'pie',
        name: 'Amount',
        colorByPoint: true,
            data: <?php echo $json_data; ?>
    }]
});


  </script>

<!-- END::Highchart area  -->
<?php include('Layout/footer.php'); ?>
