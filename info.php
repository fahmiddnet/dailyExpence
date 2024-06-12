<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ ?>
<?php include('db/connect.php'); include('Layout/header.php'); ?>
<?php

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM user WHERE id = '$user_id'";
$sql_query = mysqli_query($conn, $sql);
$user_info = mysqli_fetch_assoc($sql_query);
$user_name = $user_info['name'];

?>
<section class="date-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Welcome <span class="text-success fw-bold text-uppercase"><?php echo $user_name ?></span>. We All happy to see you!!</h2>
            </div>
        </div>
    </div>
</section>















<?php 
    include('Layout/footer.php');
    }else { header('location: index.php'); } ;
?>