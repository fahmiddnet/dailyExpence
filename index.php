<?php 
    // include('Layout/header.php'); 


    if(isset($_GET['Provide_valid_info'])){
        $validinfo = "valid info or not";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <title>Daily expenses </title>
</head>
<body style="background-image:url('assets/image/red-berries.jpg'); background-repeat:no-repeat; background-position:50% 50%; background-size:cover;">
<section class="login-area">
    <?php 
    if(isset($_GET['signupsucces'])){
        echo '<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>';
        };
    ?>
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card mt-5">
                <form action="auth/loginauth.php" method="POST" class="card-body cardbody-color p-lg-5">
                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                            width="200px" alt="profile">
                    </div>
                    <div class="mb-3">
                        <label for="Inputname" class="form-label" >User Name</label>
                        <input type="text" name="login_user_name" class="form-control <?php echo $validinfo ? 'is-invalid' : null ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid info.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" >Password</label>
                        <input type="password" name="login_password" class="form-control <?php echo $validinfo ? 'is-invalid' : null ?>" required>
                        <div class="invalid-feedback">
                            Please provide a valid info.
                        </div>
                        <div  class="form-text mb-2 text-dark">
                            <a href="forget_pass.php" class="fw-bold">Forget password</a>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit" name="login_submit" class="btn btn-primary px-5 mb-5 w-100">Log in</button> </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                        Not Registered? 
                        <a href="signup.php" class="fw-bold"> Create an Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>








<?php include('Layout/footer.php'); ?>