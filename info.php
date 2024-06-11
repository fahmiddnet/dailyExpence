<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['password'])){ ?>
<?php include('db/connect.php'); include('Layout/header.php'); ?>




<section class="date-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Your data update is successfull</h2>
            </div>
        </div>
    </div>
</section>















<?php 
    include('Layout/footer.php');
    }else { header('location: index.php'); } ;
?>