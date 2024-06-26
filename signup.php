<?php 

if(isset($_GET['emptyname']) || isset($_GET['emptyUsername']) || isset($_GET['errPass'])){
    $emptyresult = "provide valid info";
};

if(isset($_GET['msgUser_taken'])){
	$repeactUsername = "Database acces denite";
} else {
	$repeactUsername = '';
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

<body style="background-image:url('assets/image/blank.jpg'); background-repeat:no-repeat; background-position:50% 50%; background-size:cover;">
<section class="login-area">
    <div class="container">
        <div class="col-md-6 offset-md-3">
        <div class="card mt-5">
            <form action="auth/signupauth.php" method="POST" class="card-body cardbody-color py-lg-2 px-lg-5">
                <div class="text-center">
                    <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" alt="profile">
                </div>
                <div class="mb-2">
                    <label for="Inputname" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control <?php echo $emptyresult ? 'is-invalid' : null ?>">
                    <div class="invalid-feedback">
                        Please provide valid info.
                    </div>
                </div>
                <div class="mb-2">
                    <label for="Inputname" class="form-label">User Name</label>
                    <input type="text" name="userName" class="form-control <?php echo $emptyresult ? 'is-invalid' : null ?>">
                    <div class="invalid-feedback">
                        Please provide valid info.
                    </div>
			<?php  
				if($repeactUsername){
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  				<strong>Wait!</strong> You should use different user name.
  				<button type="button" class="btn-close btn-small" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
				} else {
					echo '<div class="form-text text-primary">User name must be unique.</div>';
					};

 			?>
                </div>
                <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="user_password" class="form-control <?php echo $emptyresult ? 'is-invalid' : null ?>">
                    <div class="invalid-feedback">
                        Please provide valid info.
                    </div>
                </div>
                <div class="text-center"><button type="submit" name="submit" class="btn btn-primary mb-3 w-100">Sign up</button> </div>
                <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                    Already have an account. 
                    <a href="index.php" class="fw-bold"> Login</a>
                </div>
            </form>
        </div>
        </div>
    </div>
</section>








<?php include('Layout/footer.php'); ?>