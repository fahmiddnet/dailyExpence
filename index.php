<?php 
    include('Layout/header.php'); 
?>

<section class="login-area">
    <div class="container">
        <div class="col-12">
        <form action="auth/loginauth.php" method="POST">
            <div class="mb-3">
                <label for="Inputname" class="form-label">Name</label>
                <input type="text" name="login_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="login_password" class="form-control">
            </div>
            <button type="submit" name="login_submit" class="btn btn-primary">Log in</button>
            <a href="signup.php" class="btn btn-info">Sign up</a>
        </form>
        </div>
    </div>
</section>








<?php include('Layout/footer.php'); ?>