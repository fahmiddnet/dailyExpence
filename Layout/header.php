<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <title>Daily expenses </title>
</head>
<body style="background-color:#edeff0">
<nav class="navbar navbar-expand-lg bg-info sticky-top mb-5" data-bs-theme="light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EXPENSES INFORMATION</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="catagory.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.php">Inforamtion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="expenses.php">expenses</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-danger" href="logout.php">Logout</a>
        </li>
      </ul>  
    </div>
    <form class="d-flex justify-content-end" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-primary" type="submit">Search</button>
    </form>
  </div>
</nav>
