<?php include('db/connect.php'); ?>
<?php 
$userInfo = '';
$name = "";$user_name = ""; $user_pass = "";
if(isset($_POST['submitBtn'])){
    $userName = $_POST['userName'];
    // echo $userName; 
    $sql = "SELECT * FROM user WHERE user_name = '$userName'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        $userInfo = mysqli_fetch_assoc($result);
        $name = $userInfo["name"];
        $user_name = $userInfo["user_name"];
        $user_pass = $userInfo["user_password"];
    }
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
<body>
<div class="reset_pass">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <div class="card text-center">
                        <div class="card-header h5 text-white bg-primary">Password Retrive</div>
                        <div class="card-body px-5">
                            <p class="card-text py-2">
                                Enter your User name.
                            </p>
                            <form action="" method="post">
                                <div data-mdb-input-init class="form-outline">
                                    <input type="text" name="userName" class="form-control my-3" />
                                </div>
                                <input type="submit" name="submitBtn" class="btn btn-primary w-100">
                            </form>
                            <div class="d-flex justify-content-between mt-4">
                                <a class="btn btn-primary" href="index.php">Login</a>
                                <a class="btn btn-primary" href="signup.php">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="content">
                    <div class="card text-center">
                        <form>
                            <fieldset disabled>
                                <legend><?php echo $name ?> Your Details Here</legend>
                                <div class="mb-3 mx-5">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $name ?>">
                                </div>
                                <div class="mb-3 mx-5">
                                    <label class="form-label">User name</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $user_name ?>">
                                </div>
                                <div class="mb-3 mx-5">
                                    <label class="form-label">User Password</label>
                                    <input type="text" class="form-control" placeholder="<?php echo $user_pass ?>">
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>