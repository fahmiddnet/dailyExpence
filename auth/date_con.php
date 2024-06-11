<?php 
session_start();
include('../db/connect.php');

if(isset($_POST['post_submit'])){

    $date_time = date('Y-m-d', strtotime($_POST['select_date']));
    $date_time_sql = "INSERT INTO date_time (expen_date) VALUES ('$date_time')";
    $sql_query = mysqli_query($conn,$date_time_sql);


    if($sql_query){
        $_SESSION['status'] = "Date value inserted";
        header('Location: ../expenses.php');
    } else {
        $_SESSION['status'] = "Date value inserting failed";
        header('Location: ../info.php');
    }

}

?>