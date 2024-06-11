<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['password'])){ ?>

<?php
include('Layout/header.php');
include('db/connect.php');


    // $show_sql = "SELECT * FROM date_time WHERE id=(SELECT max(id) FROM date_time);";
    // $show_date_query = mysqli_query($conn,$show_sql);
    // // print_r($show_date_query);


    // $show_catagory = "SELECT * FROM catagory_e";
    // $show_catagory_query = mysqli_query($conn,$show_catagory);
    // $show_all_catagory = mysqli_fetch_all($show_catagory_query,MYSQLI_ASSOC);
    // // print_r($show_all_catagory);

    // if (mysqli_num_rows($show_date_query) > 0) {
    //     $show_all_post = mysqli_fetch_all($show_date_query, MYSQLI_ASSOC);
    //     // print_r($show_all_post);
    //   } else {
    //     // Handle the case where no posts were found or there was an error
    //     echo "No posts found or an error occurred.";
    //   }
?>

<section class="expeses-item">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="activity.php" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Catagory</label>
                                    <input type="text" name="item_catagory" class="form-control" required>
                                    <div id="catagoryHelp" class="form-text">Please Write a catagory name.</div>
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