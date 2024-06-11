<?php  include('../db/connect.php');



if(isset($_POST['submit_exp_value'])){
    $newDate = $_POST['item_date'];
    $item_title = $_POST['item_title'];
    $item_amount = $_POST['item_amount'];
    $item_catagory = $_POST['item_catagory'];
    $item_note = $_POST['item_note'];

    if(!empty($_POST['item_title'])) {
        $title_res = "";
        foreach($_POST['item_title'] as $item_title_each){
            $title_res .= $item_title_each .",";
        }
    }
    if(!empty($item_amount)) {
        $amount_res = "";
        foreach($item_amount as $item_amount_each){
            $amount_res .= $item_amount_each .",";
        }
    }
    if(!empty($item_catagory)) {
        $catagory_res = "";
        foreach($item_catagory as $item_catagory_each){
            $catagory_res .= $item_catagory_each .",";
        }
    }
    if(!empty($item_note)) {
        $note_res = "";
        foreach($item_note as $item_note_each){
            $note_res .= $item_note_each .",";
            }
    }
    $sql = "INSERT INTO expenses (date, title, amount, catagory,note) VALUES ('$newDate','$title_res','$amount_res','$catagory_res','$note_res')"; 
    $sql_query = mysqli_query($conn,$sql);



}



?>