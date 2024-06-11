<?php include('db/connect.php');


// print_r($_POST);

$expDate = $exp_title = $exp_amount = $exp_catagory = $exp_note = '';
$expDateErr = $exp_titleErr = $exp_amountErr = $exp_catagoryErr = $exp_noteErr = '';

if(isset($_POST['item_date'])){
    // validation date 
    if(empty($_POST['item_date'])){
        $expDateErr = "Please Enter Valid date";
    } else {
        $expDate = $_POST['item_date'];
    }
    // validation title
    if(empty($_POST['item_title'])){
        $exp_titleErr = "Please Enter Valid date";
    } else {
        $exp_title = $_POST['item_title'];
    }
    // validation Amount 
    if(empty($_POST['item_amount'])){
        $exp_amountErr = "Please Enter Valid date";
    } else {
        $exp_amount = $_POST['item_amount'];
    }
    // validation Catagory 
    if(empty($_POST['item_catagory'])){
        $exp_catagoryErr = "Please Enter Valid date";
    } else {
        $exp_catagory = $_POST['item_catagory'];
    }
    // validation Note 
    if(empty($_POST['item_note'])){
        $exp_noteErr = "Please Enter Valid date";
    } else {
        $exp_note = $_POST['item_note'];
    }
    if(empty($expDateErr) && empty($exp_titleErr) && && empty($exp_amountErr) && empty($exp_catagoryErr) && empty($exp_noteErr)){
        $sql = "INSERT INTO expenses (date, title, amount, catagory , note) VALUES ('$expDate[]', '$exp_title[]', '$exp_amount[]', '$exp_catagory[]', '$exp_note[]')";
        $sql_query = mysqli_query($conn,$sql);

        if($sql_query){
            // success 
            header('Location: ../index.php?DataSubmited');
        }else {
            // Error 
            echo 'Error:' .mysqli_error($conn);
        }
    }
}

// foreach($_POST['item_title'] as $key => $value){
//     $sql = "INSERT INTO expenses (date, title, amount, note) VALUES (:item_date, :item_title, :item_amount, :item_note)"; 
//     $stmt = $conn->prepare($sql);
//     print_r($stmt);
//     // $stmt-> execute([
//     //     'item_date' => $_POST['item_date'];
//     //     'item_title' => $value;
//     //     'item_amount' => $_POST['item_amount'][$key];
//     //     'item_note' => $_POST['item_note'][$key];
//     //     // 'item_title' => $_POST['item_amount'][$key];
//     // ]);

// }

?>