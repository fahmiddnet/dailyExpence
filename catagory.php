<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['user_password'])){ ?>

<?php
include('Layout/header.php');
include('db/connect.php');

if(isset($_GET['msg'])){
    $succesCatagory= "success";
}
if(isset($_GET['cataoryErr'])){
    $catagoryInfo_err = "Already stroed";
}
?>

<section class="expeses-item">
    <div class="container">
        <?php 
        if(!empty($succesCatagory)){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Succesfully created  <strong>catagory</strong>. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        };
        if(empty($catagoryInfo_err)){
        } else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                       Already have this  <strong>catagory</strong>!!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
        
        ?>
        <div class="row">
            <div class="col-12">
                <form action="activity.php" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Create new catagory</label>
                                    <input type="text" name="item_catagory" class="form-control" placeholder="Write new catagory name" required>
                                    <div id="catagoryHelp" class="form-text">Create name must relevent</div>
                                </div>
                            </div>
                        </div>
                    <button type="submit" name="submit_catagory" class="btn btn-primary mb-5">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>




<?php 
    include('Layout/footer.php');
    }else { header('location: index.php'); } ;
?>