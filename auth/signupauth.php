<?php 
    include('../db/connect.php');

    $name = $password = '';
    $nameErr = $passErr = '';

    if(isset($_POST['submit'])){
        //name validation
        if(empty($_POST['name'])){
            $nameErr = "Please provide valid name";
            header("location: ../signup.php");
        } else {
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        }
        //password validation
        if(empty($_POST['password'])){
            $passErr = "Please provide valid Password";
            header("location: ../signup.php");
        } else {
            $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        //pass data to the database
        if(empty($nameErr) && empty($passErr)){

            $loginSql = "INSERT INTO user (name,password) VALUES ('$name', '$password')";
            if(mysqli_query($conn,$loginSql)){
                // success 
                header('Location: ../index.php?signupsucces');
            }else {
                // Error 
                echo 'Error:' .mysqli_error($conn);
                // success 
                header('Location: ../signup.php');
            }
        }
    }
?>