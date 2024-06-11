<?php 
    include('db/connect.php'); 
    include('Layout/header.php'); 

    $sql_data = "SELECT * FROM expenses";
    $query_data = mysqli_query($conn,$sql_data);
    $data_result = mysqli_fetch_all($query_data,MYSQLI_ASSOC);
    // print_r($data_result );
    $sql_data2 = "SELECT * FROM catagory_e";
    $query_data2 = mysqli_query($conn,$sql_data2);
    $data_result2 = mysqli_fetch_all($query_data2,MYSQLI_ASSOC);
    // print_r($data_result2);
?>
