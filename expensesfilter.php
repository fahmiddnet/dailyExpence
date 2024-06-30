<?php 
    session_start(); 
    if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ 
        $user_info = $_SESSION['id'];
?>

<?php 
    include('db/connect.php'); 
    include('Layout/header.php'); 
?>

<?php 
    $sql_data = "SELECT * FROM expenses WHERE user_id = '$user_info'";
    $result = mysqli_query($conn,$sql_data); 
    // Prepare data for Highchatts 
    $varOpt = '';
    $data = array();
    if(isset($_POST['taskOption'])){
        $varOpt = $_POST['taskOption'];
    };
    // print_r($varOpt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $dateString[] = $row['date'];
            $dateString_value = $row['date'];
            if(!$varOpt){
                $varOpt = $dateString_value;
            };
        }
        // print_r($user_date);
        $filter_sql_data = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE date = '$varOpt' AND user_id = '$user_info'  GROUP BY catagory";
        $filter_res = mysqli_query($conn,$filter_sql_data); 
            if (mysqli_num_rows($filter_res) > 0) {
                while($filter_row = mysqli_fetch_assoc($filter_res)) {
                    $data[] = array($filter_row["catagory"], (int)$filter_row["total_price"]);
                }
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


<div class="heighchart-area">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <form method="POST">
                    <select class="form-select" name="taskOption" aria-label="Multiple select example">
                        <?php foreach(array_unique($dateString) as $date_month_item): ?>
                        <option <?php if($varOpt === $date_month_item) echo"selected";?>  
                            value="<?php echo $date_month_item ?>">
                                <!--Selected view item -->
                            <?php
                            $yrdata= strtotime($date_month_item);
                            $date_month_value = date('l jS F Y', $yrdata);
                            echo $date_month_value ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="btn btn-primary mt-2">
                </form>

                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>

            <div class="col-md-6">
                <form method="POST">
                    <select class="form-select" name="taskOption" aria-label="Multiple select example">
                        <?php foreach(array_unique($dateString) as $date_month_item): ?>
                        <option <?php if($varOpt === $date_month_item) echo"selected";?>  
                            value="<?php echo $date_month_item ?>">
                                <!--Selected view item -->
                            <?php
                            $yrdata= strtotime($date_month_item);
                            $date_month_value = date('l jS F Y', $yrdata);
                            echo $date_month_value ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="btn btn-primary mt-2">
                </form>

                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>

        </div>
    </div>
</div>



<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '<?php 
                            $yrdata = strtotime($varOpt);
                            $date_month_value = date('l jS F Y', $yrdata);
                            echo $date_month_value ?> Expenses'
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
Highcharts.chart('container2', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '<?php 
                            $yrdata = strtotime($varOpt);
                            $date_month_value = date('l jS F Y', $yrdata);
                            echo $date_month_value ?> Expenses'
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

<?php 

    } else {
        header('location: index.php');
    }
?>
