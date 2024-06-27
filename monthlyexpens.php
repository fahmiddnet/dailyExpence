<?php
        $user_info = $_SESSION['id'];
?>

<?php 
    include('db/connect.php'); 
?>

<?php 
    $sql_data2 = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE user_id = '$user_info'  GROUP BY catagory";
    $result2 = mysqli_query($conn,$sql_data2); 
    // Prepare data for Highchatts 
    $data2 = array();
    // print_r($result2);
    if (mysqli_num_rows($result2) > 0) {
        while($row2 = mysqli_fetch_assoc($result2)) {
            // print_r($row);
            $data2[] = array($row2["catagory"], (int)$row2["total_price"]);
        }
    };

      mysqli_close($conn);
      // Encode data to JSON format
      $json_data2 = json_encode($data2);
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
        type: 'variablepie'
    },
    title: {
        text: 'Last Expenses',
        align: 'center'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> ' +
            '{point.name}</b><br/>' +
            'Area (square km): <b>{point.y}</b><br/>' +
            'Population density (people per square km): <b>{point.z}</b><br/>'
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'countries',
        borderRadius: 5,
        type: 'pie',
        colorByPoint: true,
            data: <?php echo $json_data2; ?>
    }]
});



  </script>

<!-- END::Highchart area  -->
<?php include('Layout/footer.php'); ?>
