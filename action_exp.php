<?php 

// print_r($_POST);


$con = new PDO('mysql:host=localhost;dbname=expenses_pretest', 'root', '');
$date_t = $_POST['item_date'];

foreach ($_POST['item_title'] as $key => $value ){
    $sql = 'INSERT INTO `items` (`date`,`title`, `amount`, `catagory`, `note`) VALUES (:date_t, :title, :amount, :catagory, :note)';
    $stmt = $con->prepare($sql);
    $stmt->execute([
        'date_t' => $date_t,
        'title' => $value,
        'amount' => $_POST['item_amount'][$key],
        'catagory' => $_POST['item_catagory'][$key],
        'note' => $_POST['item_note'][$key]
    ]);
}

echo 'Item inserted successfully';

?>