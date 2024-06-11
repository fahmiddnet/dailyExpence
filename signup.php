<?php 
    include('Layout/header.php'); 
?>

<section class="login-area">
    <div class="container">
        <div class="col-12">
        <form action="auth/signupauth.php" method="POST">
            <div class="mb-3">
                <label for="Inputname" class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign up</button>
            <a href="index.php" class="btn btn-info">Login</a>
        </form>
        </div>
    </div>
</section>








<?php include('Layout/footer.php'); ?>