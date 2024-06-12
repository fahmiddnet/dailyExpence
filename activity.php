<?php include('db/connect.php');
// print_r($_POST);

    $catagoru_input_value = $_POST['item_catagory'];
    $show_catagory = "SELECT * FROM catagory_e WHERE catagory_name = '$catagoru_input_value'";
    $show_catagory_query = mysqli_query($conn,$show_catagory);
    $catagory_info = mysqli_fetch_assoc($show_catagory_query);
    $catagory_name = $catagory_info['catagory_name'];
    // print_r($catagory_name);


    // // if (mysqli_num_rows($show_date_query) > 0) {
    // //     $show_all_post = mysqli_fetch_all($show_date_query, MYSQLI_ASSOC);
    // //     // print_r($show_all_post);
    // //   } else {
    // //     // Handle the case where no posts were found or there was an error
    // //     echo "No posts found or an error occurred.";
    // //   }

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
        if($catagory_name === $catagoru_input_value ){
            header('location: catagory.php?cataoryErr');
            exit();
        } else {
            $sql = "INSERT INTO catagory_e (catagory_name) VALUES ('$catagory_input')";
            $sql_query = mysqli_query($conn,$sql);
            if($sql_query){
                header('location: catagory.php?msg');
                exit();
            } else{
                header('location: catagory.php?msgErr');
                exit();
            }
        }
    }else{
        header('location: catagory.php?msgdataBase');
        exit();
    }
}

?>