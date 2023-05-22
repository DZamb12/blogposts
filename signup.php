<?php 
require_once __DIR__ . '/vendor/autoload.php';
?>


<!-- html code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href=" <?= '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css';  ?>"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <title>Sign Up</title>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="login.php">FishBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
        <a class="nav-link" href="login.php">Login </span></a>
      </li>
      <li class="nav-item">
      <li class="nav-item active">
        <a class="nav-link" href="signup.php">Signup <span class="sr-only">(current)</a>
      </li>
    </ul>
    <span class="navbar-text">
      Your Book, Your Story.
    </span>
  </div>
</nav>

<body>
    <h2>Sign Up here!</h2>
    <div class="container">
        <div class="row">
            <form method="POST" action="saveuser.php">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="">
                </div>

                <label for="firstname" class="form-label">First Name</label>
                <div class=" mb-2">
                    <input type="text" class="form-control" name="firstname" id="">
                </div>

                <label for="lastname" class="form-label">Last Name</label>
                <div class=" mb-2">
                    <input type="text" class="form-control" name="lastname" id="">
                </div>

                <label for="email" class="form-label">Email Address</label>
                <div class=" mb-2">
                    <input type="email" class="form-control" name="email" id="">
                </div>

                <label for="password" class="form-label">Password</label>
                <div class=" mb-2">
                    <input type="password" class="form-control" name="password" id="">
                </div>

                <label for="repassword" class="form-label">Re-enter Password</label>
                <div class=" mb-2">
                    <input type="password" class="form-control" name="repassword" id="">
                </div>

                <button type="submit" class="btn btn-success">Sign Up</button>
                <p>Already created an account? <a href="login.php">Login</a> </p>
            </form>
        </div>
    </div>

</body>
</html>


