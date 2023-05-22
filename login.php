<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href=" <?= '/vendor/twbs/bootstrap/dist/css/bootstrap.min.css';  ?>"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>login</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="login.php">FishBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Signup</a>
      </li>
    </ul>
    <span class="navbar-text">
      Your Book, Your Story.
    </span>
  </div>
</nav>

<div>
<h1>
    Welcome to FishBook!
    <small>| Login Here</small>
</h1>
</div>

    <div class="container">
        <div class="row">
            <form action="authenticate.php" method="post">
                <div class="form-group mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="username" name="username" id="" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="" class="form-control">
                </div>

                <div class="form-group mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Login</button>
                <p>No account? Create an account <a href="signup.php">here.</a> </p>

        </div>
    </form>
</div>
</body>
</html>