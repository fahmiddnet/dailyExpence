<?php  include('../db/connect.php');



if(isset($_POST['submit_exp_value'])){

    foreach($_POST['item_title'] as $key => $value){
    $newDate = $_POST['item_date'];
    $sql = "INSERT INTO expenses (date, title, amount, note) VALUES ('$newDate', :item_title, :item_amount, :item_note)"; 
    $stmt = $conn->prepare($sql);
    // print_r($stmt);
    $stmt-> execute([
        'item_title' => $_POST['item_title'][$key];
        'item_amount' => $_POST['item_amount'][$key];
        'item_note' => $_POST['item_note'][$key];
        // 'item_title' => $_POST['item_amount'][$key];
    ]);

}

    // $newDate = $_POST['item_date'];
    // $item_title = $_POST['item_title'];
    // $item_amount = $_POST['item_amount'];
    // $item_catagory = $_POST['item_catagory'];
    // $item_note = $_POST['item_note'];

    // print_r($newDate);
    // $item_title = $_POST['item_title'];
    // print_r($item_title);
    // foreach($item_title as $key => $title_each){
    //     print_r($title_each)$key;
    //     echo "<br>";
    // }
    // $item_amount = $_POST['item_amount'];
    // print_r($item_amount);
    // $item_catagory = $_POST['item_catagory'];
    // print_r($item_catagory);
    // $item_note = $_POST['item_note'];
    // print_r($item_note);

/*
    if(!empty($newDate)){
        $sql = "INSERT INTO expenses (date) VALUES ('$newDate')"; 
    }
    if(!empty($item_title)) {
        foreach($item_title as $item_title_each){
            $sql = "INSERT INTO expenses (title) VALUES ('$item_title_each')"; 
        }
    }
    if(!empty($item_amount)) {
        foreach($item_amount as $item_amount_each){
            $sql = "INSERT INTO expenses (amount) VALUES ('$item_amount_each')"; 
        }
    }
    if(!empty($item_catagory)) {
        foreach($item_catagory as $item_catagory_each){
            $sql = "INSERT INTO expenses (catagory) VALUES ('$item_catagory_each')"; 
        }
    }
    if(!empty($item_note)) {
        foreach($item_note as $item_note_each){
            $sql = "INSERT INTO expenses (note) VALUES ('$item_note_each')"; 
        }
    }
    $sql_query = mysqli_query($conn,$sql);

*/


}



?>