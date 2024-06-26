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

<div class="table-area">
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
</div>



<?php 
    // $title_item = [];
    // $title_item = $exp_data_each['title'];
    // $makeArray = [$title_item];
    // print_r($title_item);

    // foreach($makeArray as $each_item){
    //     print_r($each_item);
    //     echo "<br>";
    // }

//     // Declare an array and initialize it 
// $Array = array( "GFG1", "GFG2", "GFG3" ); 
  
// // Display the array elements 
// print_r($Array); 
  
// Use implode() function to join 
// comma in the array 
// $List = implode(', ', $makeArray); 
  
// Display the comma separated list 
    // print_r($List); 
?>


























<?php 
    } else {
        header('location: index.php');
    }
?>