<?php  include('../db/connect.php');

// print_r($_POST['item_amount'][0]);
$newDate = 
$item_title = 
$item_amount =
$item_catagory = 
$item_note = "";

$newDateErr = 
$item_titleErr = 
$item_amountErr =
$item_catagoryErr = 
$item_noteErr = "";

if(isset($_POST['submit_exp_value'])){
    //VALIDATION DATE
   if(empty($_POST['item_date'])){
    $newDateErr = "Err data";
   } else {
    $newDate = filter_input(INPUT_POST,'item_date');
   };
   //VALIDATION TITLE
   $input_title = $_POST['item_title'];
   foreach($input_title as $title_each){
    if(empty($title_each)){
        $item_titleErr = "Err data";
        // print_r($item_titletErr);
    } else {
        $item_title .= $title_each . ",";
        // print_r($item_title);
        // echo "<br>";
    };
   };
    //VALIDATION AMOUNT
    $input_amount = $_POST['item_amount'];
    foreach($input_amount as $title_each){
     if(empty($title_each)){
         $item_amountErr = "Err data";
        //  print_r($item_amountErr);
     } else {
         $item_amount .= $title_each . ",";
        //  print_r($item_amount);
     };
    };

    //VALIDATION CATAGORY
    $input_catagory = $_POST['item_catagory'];
    foreach($input_catagory as $title_each){
     if(empty($title_each)){
        $item_catagoryErr = "Err data";
        //  print_r($item_catagoryErr);
     } else {
        $item_catagory .= $title_each . ",";
        //  print_r($item_catagory);
     };
    };

    //VALIDATION NOTE
    $input_note = $_POST['item_note'];
    foreach($input_note as $title_each){
     if(empty($title_each)){
        $item_noteErr = "Err data";
        //  print_r($item_noteErr);
     } else {
        $item_note .= $title_each . ",";
        //  print_r($item_note);
     };
    };

    if(empty($newDateErr) && empty($item_titleErr) && empty($item_amountErr) && empty($item_catagoryErr) && empty($item_noteErr) ){
        $sql = "INSERT INTO expenses (date, title, amount, catagory,note) VALUES ('$newDate','$item_title','$item_amount','$item_catagory','$item_note')"; 
        $sql_query = mysqli_query($conn,$sql);
        if($sql_query){
            header('location: ../expenses.php?msg');
        } else{
            header('location: ../expenses.php?msgErr');
        }
    }else{
        header('location: ../expenses.php?msgdataBase');
    }
}


?>