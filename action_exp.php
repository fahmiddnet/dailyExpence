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




<!-- <div class="table-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead class="table-danger">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Title</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Catagory</th>
                            <th scope="col">note</th>
                            <th scope="col">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(empty($expenses_data)){ 
                            echo "<tr>
                                    <td colspan='6'> There is no data ________ Please enter yor data here: <a href='expenses.php' class='btn btn-primary'>Expenses </a></td>
                                  </tr>";
                        } else { 
                        ?>
                           <?php foreach($expenses_data as $exp_data_each): ?>
                                <tr>
                                    <td><?php echo $exp_data_each['date'] ?></td>
                                    <td><?php echo ((strlen($exp_data_each['title']) > 200) ? substr($exp_data_each['title'],0,200).'...': $exp_data_each['title'] ); ?></td>
				    <td><?php echo ((strlen($exp_data_each['amount']) > 200) ? substr($exp_data_each['amount'],0,200).'...': $exp_data_each['amount'] ); ?></td>
                                    <td><?php echo ((strlen($exp_data_each['catagory']) > 200) ? substr($exp_data_each['catagory'],0,200).'...': $exp_data_each['catagory'] ); ?></td>
				    <td><?php echo ((strlen($exp_data_each['note']) > 200) ? substr($exp_data_each['note'],0,200).'...': $exp_data_each['note'] ); ?></td>
                                    <td><?php echo $exp_data_each['user_id'] ?></td>
                                </tr>
                            <?php endforeach; ?>

                            <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->




<?php 
    session_start(); 
    if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ 
?>

<?php 
    include('db/connect.php'); 
    include('Layout/header.php'); 
?>

<?php 
    $user_info = $_SESSION['id'];
    $sql_data = "SELECT * FROM expenses WHERE user_id = '$user_info'";
    $sql_query = mysqli_query($conn,$sql_data);
    $expenses_data = mysqli_fetch_all($sql_query,MYSQLI_ASSOC);
    // print_r($expenses_data);

?>