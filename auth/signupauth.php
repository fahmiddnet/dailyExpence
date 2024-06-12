<?php 
    include('../db/connect.php');

    $input_user_name = $_POST['userName'];
    $usersql = "SELECT * FROM user WHERE user_name = '$input_user_name'";
    $query_sql = mysqli_query($conn,$usersql);
    $userData = mysqli_fetch_assoc($query_sql);
    $usernamefromdb = $userData['user_name'];
 
    $name = $userName = $password =  '';
    $nameErr = $userNameErr = $passErr =  '';

    if(isset($_POST['submit'])){
        //name validation
        if(empty($_POST['name'])){
            $nameErr = "Please provide valid name";
            header("location: ../signup.php?emptyname");
            exit();
        } else {
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_STRING);
        }
        //User name validation
        if(empty($_POST['userName'])){
            $userNameErr = "Please provide valid name";
            header("location: ../signup.php?emptyUsername");
            exit();
        } else {
            if( $usernamefromdb === $input_user_name){
                header("location: ../signup.php?msgUser_taken");
                exit();
            } else {
                $userName = filter_input(INPUT_POST,'userName',FILTER_SANITIZE_STRING);
            }
        }
        //User password validation
        if(empty($_POST['user_password'])){
            $passErr = "Please provide valid Password";
            header("location: ../signup.php?errPass");
            exit();
        } else {
            $password = filter_input(INPUT_POST,'user_password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        // pass data to the database
        if(empty($nameErr) && empty($userNameErr) && empty($passErr)){

            $loginSql = "INSERT INTO user (name, user_name, user_password) VALUES ('$name', '$userName', '$password')";
            if(mysqli_query($conn,$loginSql)){
                // success 
                header('Location: ../index.php?signupsucces');
                exit();
            }else {
                // Error 
                echo 'Error:' .mysqli_error($conn);
                // success 
                header('Location: ../signup.php');
                exit();
            }
        }
    }
    $conn->close();
?>