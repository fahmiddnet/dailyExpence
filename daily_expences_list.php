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
    $sql_data = "SELECT catagory, SUM(amount) AS total_price FROM expenses WHERE user_id = '$user_info'  GROUP BY catagory";
    $result = mysqli_query($conn,$sql_data); 
    // Prepare data for Highchatts 
    $data = array();
    $data2 = array();
    $Total_cost_amount = 0;
    $currentMontTotalAmount = 0;
    // print_r($result2);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $data[] = array($row["catagory"], (int)$row["total_price"]);
            $Total_cost_amount +=$row["total_price"];
        }
    };
    // print_r($Total_cost_amount);

      // Encode data to JSON format
      $json_data = json_encode($data);
    //   print_r($json_data);

    $expenseAll_sql = "SELECT * FROM `expenses` WHERE user_id = '$user_info'";
    $All_data_result = mysqli_query($conn,$expenseAll_sql); 
    if (mysqli_num_rows($All_data_result) > 0) {
        while($all_data_row = mysqli_fetch_assoc($All_data_result)) {
                $dateString = $all_data_row['date'];
                // print_r($dateString);
                // Use DateTime object to parse the date and get month
                $dateObject = new DateTime($dateString);
                // print_r($dateObject);
                $dbmonth = $dateObject->format('m');  // 'm' format code for month (01-12)
                // echo "<br>";
                // print_r($dbmonth);
                $current_month = date('m');
                if($dbmonth === $current_month) {
                    $data2[] = array($all_data_row["catagory"], (int)$all_data_row["amount"]);
                    $currentMontTotalAmount += $all_data_row["amount"];
                };
        }
    }
    $json_data2 = json_encode($data2);

?>


<!-- START::Highchart area  -->
<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>
<script src="js/accessibility.js"></script>


<div class="heighchart-area">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>

            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container3"></div>
                </figure>
            </div>
            <div class="col-md-6">
                <figure class="highcharts-figure">
                    <div id="container4"></div>
                </figure>
            </div>

            

            <div class="col-md-6">
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
    credits:{
        enabled:false
    },
    tooltip: {
        valueSuffix: '💲'
    },
    subtitle: {
        text:
        'This month total expense: <?php echo $currentMontTotalAmount ?>$'
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
    title: {
        text: 'Current Month Expenses'
    },
    series: [{
        type: 'pie',
        name: 'Cost',
        colorByPoint: true,
            data: <?php echo $json_data2; ?>
    }]
});
Highcharts.chart('container2', {
    credits:{
        enabled:false
    },
    title: {
        text: 'Monthly Expenses'
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
                    fontSize: '0.7em',
                    textOutline: 'none',
                    opacity: 0.9
                }
            }]
        }
    },
    series: [{
        minPointSize: 10,
        innerSize: '20%',
        zMin: 0,
        name: 'Amount',
        borderRadius: 5,
        type: 'pie',
        colorByPoint: true,
            data: <?php echo $json_data; ?>
    }]
 });


Highcharts.chart('container3', {
    chart: {
        type: 'column'
    },
    credits:{
        enabled:false
    },
    title: {
        align: 'center',
        text: 'YOUR TOTAL AREA OF EXPENSES'
    },
    subtitle: {
        align: 'center',
        text: 'All data selected from your previews costing'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total Expenses'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '{point.y}$'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">Total {series.name} : <strong><?php echo $Total_cost_amount ?>$ </strong> </span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b>{point.y}$</b><br/>'
    },

    series: [
        {
            name: 'Amount',
            colorByPoint: true,
            data: <?php echo $json_data; ?>
        }
    ],
});


Highcharts.chart('container4', {
    chart: {
        type: 'area'
    },
    accessibility: {
        description: 'Image description: An area chart compares the nuclear ' +
            'stockpiles of the USA and the USSR/Russia between 1945 and ' +
            '2017. The number of nuclear weapons is plotted on the Y-axis ' +
            'and the years on the X-axis. The chart is interactive, and the ' +
            'year-on-year stockpile levels can be traced for each country. ' +
            'The US has a stockpile of 6 nuclear weapons at the dawn of the ' +
            'nuclear age in 1945. This number has gradually increased to 369 ' +
            'by 1950 when the USSR enters the arms race with 6 weapons. At ' +
            'this point, the US starts to rapidly build its stockpile ' +
            'culminating in 32,040 warheads by 1966 compared to the USSR’s 7,' +
            '089. From this peak in 1966, the US stockpile gradually ' +
            'decreases as the USSR’s stockpile expands. By 1978 the USSR has ' +
            'closed the nuclear gap at 25,393. The USSR stockpile continues ' +
            'to grow until it reaches a peak of 45,000 in 1986 compared to ' +
            'the US arsenal of 24,401. From 1986, the nuclear stockpiles of ' +
            'both countries start to fall. By 2000, the numbers have fallen ' +
            'to 10,577 and 21,000 for the US and Russia, respectively. The ' +
            'decreases continue until 2017 at which point the US holds 4,018 ' +
            'weapons compared to Russia’s 4,500.'
    },
    title: {
        text: 'Expenses Ration'
    },
    // subtitle: {
    //     text: 'Source: <a href="https://fas.org/issues/nuclear-weapons/status-world-nuclear-forces/" ' +
    //         'target="_blank">FAS</a>'
    // },
    xAxis: {
        allowDecimals: false,
        accessibility: {
            rangeDescription: 'Range: 1940 to 2017.'
        }
    },
    yAxis: {
        title: {
            text: 'Expenses'
        }
    },
    tooltip: {
        pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>' +
            'warheads in {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 1940,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'May 2024',
        data: [
            null, null, null, null, null, 2, 9, 13, 50, 170, 299, 438, 841,
            1169, 1703, 2422, 3692, 5543, 7345, 12298, 18638, 22229, 25540,
            28133, 29463, 31139, 31175, 31255, 29561, 27552, 26008, 25830,
            26516, 27835, 28537, 27519, 25914, 25542, 24418, 24138, 24104,
            23208, 22886, 23305, 23459, 23368, 23317, 23575, 23205, 22217,
            21392, 19008, 13708, 11511, 10979, 10904, 11011, 10903, 10732,
            10685, 10577, 10526, 10457, 10027, 8570, 8360, 7853, 5709, 5273,
            5113, 5066, 4897, 4881, 4804, 4717, 4571, 4018, 3822, 3785, 3805,
            3750, 3708, 3708
        ]
    }, {
        name: 'June 2024',
        data: [
            null, null, null, null, null, null, null, null, null,
            1, 5, 25, 50, 120, 150, 200, 426, 660, 863, 1048, 1627, 2492,
            3346, 4259, 5242, 6144, 7091, 8400, 9490, 10671, 11736, 13279,
            14600, 15878, 17286, 19235, 22165, 24281, 26169, 28258, 30665,
            32146, 33486, 35130, 36825, 38582, 40159, 38107, 36538, 35078,
            32980, 29154, 26734, 24403, 21339, 18179, 15942, 15442, 14368,
            13188, 12188, 11152, 10114, 9076, 8038, 7000, 6643, 6286, 5929,
            5527, 5215, 4858, 4750, 4650, 4600, 4500, 4490, 4300, 4350, 4330,
            4310, 4495, 4477
        ]
    }]
});


var date_input = document.getElementById('date_input');
date_input.valueAsDate = new Date();

date_input.onchange = function(){
   console.log(this.value);
}
</script>

<!-- END::Highchart area  -->
<?php include('Layout/footer.php'); ?>



<?php 
    mysqli_close($conn);
    } else {
        header('location: index.php');
    }
?>