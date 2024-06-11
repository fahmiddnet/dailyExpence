<?php 
session_start();
include('../db/connect.php');

if(isset($_POST['login_name']) && isset($_POST['login_password'])){
    function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    };

    $user_login_name = validation($_POST['login_name']);
    $user_login_pass = validation($_POST['login_password']);


    if(empty($user_login_name)){
        header('location: ../index.php');
        exit();
    }
    else if(empty($user_login_pass)){
        header('location: ../index.php');
        exit();
    } else {
        $login_sql = "SELECT * FROM user WHERE name ='$user_login_name' AND password ='$user_login_pass'";
        $user_result = mysqli_query($conn,$login_sql);
        // print_r($user_result);
        if(mysqli_num_rows($user_result) > 0){
            $user_info = mysqli_fetch_assoc($user_result);
            if($user_info['name'] === $user_login_name && $user_info['password'] === $user_login_pass){
                $_SESSION['id'] = $user_info['id'];
                $_SESSION['password'] = $user_info['password'];
                header("location: ../info.php");
            } else {
                header("location: ../index.php?errEmail_pass");
            }
        }
    }
}
 
?>