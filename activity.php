<?php include('db/connect.php');
// print_r($_POST);

$catagory_input = "";
$catagory_inputErr = "";

if(isset($_POST['submit_catagory'])){
    // VALIDATION CATAGORY INPUT 
    if(empty($_POST['item_catagory'])){
        $catagory_inputErr = "Invalid data";
    } else {
        $catagory_input = filter_input(INPUT_POST,'item_catagory',FILTER_SANITIZE_STRING);
    }

    if(empty($catagory_inputErr)){
        // INSERT INTO `catagory_e` (`id`, `catagory_name`, `catagory_body`) VALUES (NULL, 'Reading', 'Reading book');
        $sql = "INSERT INTO catagory_e (catagory_name) VALUES ('$catagory_input')";
        $sql_query = mysqli_query($conn,$sql);
        if($sql_query){
            header('location: catagory.php?msg');
        } else{
            header('location: catagory.php?msgErr');
        }
    }else{
        header('location: catagory.php?msgdataBase');
    }
}

?>