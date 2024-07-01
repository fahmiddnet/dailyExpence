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
    $varOpt_month ='';
    $varOpt_year = '';
    $data = array();
    $date_of_month = array(); 
    $date_of_year = array(); 
    if(isset($_POST['daySubmit'])){
        $varOpt = $_POST['taskOption'];
    };
    if(isset($_POST['monthSubmit'])){
        $varOpt_month = $_POST['taskOption_month'];
    };
    if(isset($_POST['yearSubmit'])){
        $varOpt_year = $_POST['taskOption_year'];
    };
    // print_r($varOpt);
    // print_r($date);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $dateString[] = $row['date'];
            $dateString_value = $row['date'];
            if(!$varOpt){
                $varOpt = $dateString_value;
            };
            if(!$varOpt_month){
                $varOpt_month = $dateString_value;
            };
            if(!$varOpt_year){
                $varOpt_year = $dateString_value;
            };
        }
        /*=========================================
        START::FIlter by day
        ===========================================*/
        $filter_sql_day = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE date = '$varOpt' AND user_id = '$user_info'  GROUP BY catagory";
        $filter_res = mysqli_query($conn,$filter_sql_day); 
            if (mysqli_num_rows($filter_res) > 0) {
                while($filter_row = mysqli_fetch_assoc($filter_res)) {
                    $data[] = array($filter_row["catagory"], (int)$filter_row["total_price"]);
                }
            } 
        /*=========================================
        END::FIlter by day 
        ===========================================*/

        /*=========================================
        START::FIlter by month 
        ===========================================*/
        $selected_month = date('m', strtotime($varOpt_month));
        $selected_year = date('Y', strtotime($varOpt_month));
        

        $filter_month = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$selected_year' AND MONTH(date) = '$selected_month' AND user_id = '$user_info' GROUP BY catagory";
        $filter_m_res = mysqli_query($conn,$filter_month); 
        // print_r($filter_res);
        if (mysqli_num_rows($filter_m_res) > 0) {
            while($filter_m_row = mysqli_fetch_assoc($filter_m_res)) {
                // print_r($filter_row);
                $date_of_month[] = array($filter_m_row["catagory"], (int)$filter_m_row["total_price"]);
            }
        };

        /*=========================================
        START::FIlter by month 
        ===========================================*/

        /*=========================================
        START::FIlter by year 
        ===========================================*/
        $selected_only_year = date('Y', strtotime($varOpt_year));
        $filter_year = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE YEAR(date) = '$selected_only_year' AND user_id = '$user_info' GROUP BY catagory";
        $filter_y_res = mysqli_query($conn,$filter_year); 
        // print_r($filter_res);
        if (mysqli_num_rows($filter_y_res) > 0) {
            while($filter_y_row = mysqli_fetch_assoc($filter_y_res)) {
                // print_r($filter_row);
                $date_of_year[] = array($filter_y_row["catagory"], (int)$filter_y_row["total_price"]);
            }
        };

        /*=========================================
        START::FIlter by year
        ===========================================*/

    };

    

      mysqli_close($conn);
      // Encode data to JSON format
      $json_data = json_encode($data);
      $json_month_data = json_encode($date_of_month);
      $json_year_data = json_encode($date_of_year);
    //   print_r($json_data);
    

?>


<!-- START::Highchart area  -->
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/accessibility.js"></script>


<div class="heighchart-area">
    <div class="container">
        <div class="row">

            <!-- START::FIlter by day section  -->
            <div class="col-md-6">
                <form method="POST" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Day</label>
                    <select class="form-select" name="taskOption" aria-label="Multiple select example">
                        <?php foreach(array_unique($dateString) as $day_item): ?>
                        <option <?php if($varOpt === $day_item) echo"selected";?>  
                            value="<?php echo $day_item ?>">
                                <!--Selected view item -->
                            <?php
                            $day_of_date= strtotime($day_item);
                            $date_day_value = date('l jS F Y', $day_of_date);
                            echo $date_day_value ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="daySubmit" value="Filter" class="btn btn-info">
                </form>

                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
             <!-- END::Filter by day section  -->

             <!-- START::FIlter by month section  -->
            <div class="col-md-6">
                <form method="POST" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Month</label>
                    <select class="form-select" name="taskOption_month" aria-label="Multiple select example">
                        <?php foreach(array_unique($dateString) as $date_month_item): ?>
                        <option <?php if($varOpt_month === $date_month_item) echo"selected";?>  
                            value="<?php echo $date_month_item ?>">
                                <!--Selected view item -->
                            <?php
                            $yrdata= strtotime($date_month_item);
                            $date_month_value = date('F Y', $yrdata);
                            echo $date_month_value ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="monthSubmit" value="Filter" class="btn btn-info">
                </form>

                <figure class="highcharts-figure">
                    <div id="container2"></div>
                </figure>
            </div>
            <!-- END::FIlter by month section  -->


            <!-- START::FIlter by Yearly section  -->
            <div class="col-md-6">
                <form method="POST" class="d-flex justify-content-between align-items-center gap-3">
                    <label class="btn btn-secondary disabled">Year</label>
                    <select class="form-select" name="taskOption_year" aria-label="Multiple select example">
                        <?php foreach(array_unique($dateString) as $date_year_item): ?>
                        <option <?php if($varOpt_year === $date_year_item) echo"selected";?>  
                            value="<?php echo $date_year_item ?>">
                                <!--Selected view item -->
                            <?php
                            $data_year= strtotime($date_year_item);
                            $date_year_value = date('Y', $data_year);
                            echo $date_year_value ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" name="yearSubmit" value="Filter" class="btn btn-info">
                </form>

                <figure class="highcharts-figure">
                    <div id="container3"></div>
                </figure>
            </div>
            <!-- END::FIlter by yearly section  -->

        </div>
    </div>
</div>



<script type="text/javascript">

/*=========================================
START::FIlter by day
===========================================*/
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

/*=========================================
END::FIlter by day 
===========================================*/

/*=========================================
START::FIlter by month 
===========================================*/
Highcharts.chart('container2', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '<?php 
                            $yrdata = strtotime($varOpt_month);
                            $date_month_value = date('F Y', $yrdata);
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
            data: <?php echo  $json_month_data; ?>
    }]
});

/*=========================================
END::FIlter by month 
===========================================*/


/*=========================================
START::FIlter by year 
===========================================*/
Highcharts.chart('container3', {
    chart: {
        type: 'pie'
    },
    title: {
        text: '<?php 
                            $year_d = strtotime($varOpt_year);
                            $date_year_value = date('Y', $year_d);
                            echo $date_year_value ?> Expenses'
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
            data: <?php echo  $json_year_data; ?>
    }]
});

/*=========================================
END::FIlter by Year 
===========================================*/




</script>






<!-- END::Highchart area  -->


<!-- Footer area  -->
<?php include('Layout/footer.php'); ?>


<!-- If session not working  -->
<?php 
    } else {
        header('location: index.php');
    }
?>
