<?php session_start(); if(isset($_SESSION['id']) && isset($_SESSION['password'])){ ?>
<?php include('db/connect.php'); include('Layout/header.php'); ?>




<section class="date-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="auth/date_con.php" method="POST">
                    <div class="form-group mb-4">
                        <label class="form-control-label">date</label>
                        <input type="date" name="select_date" class="form-control" required>
                    </div>
                    <div class="col-lg-12 loginbttm">
                        <div class="col-lg-6 login-btm login-button">
                            <button type="submit" name="post_submit" class="btn btn-primary">Send date</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>















<?php 
    include('Layout/footer.php');
    }else { header('location: index.php'); } ;
?>