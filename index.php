<?php
 include 'functions/visitors.php';
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container mt-5 pt-5">
        <div class="row">
          <div class="col-12 col-sm-7 col-md-4 m-auto">
            <div class="card border-0 shadow">
              <div class="card-body">
                <h3 class="text-center mb-4">Login</h3>
                <?php
                if(isset($_POST['submit'])){
                if(empty($_POST['username']) || empty($_POST['password'])){
                ?>
                <div class="alert alert-danger mt-3 col-ms-4">
                  <p>Please fill in all fields.</p>
                </div>
                <?php
                   }else{
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $userData = GetUsernameAndPassword($username, $password);
                    if(count($userData) > 0){
                        $_SESSION['username'] = $username;
                        header('Location: dashboard.php');
                    }else{
                ?>
                <div class="alert alert-danger mt-3 col-ms-4">
                  <p>Invalid username or password.</p>
                </div>
                <?php
                    }
                   }
                } 
                ?>

                <form action="" method = "POST">
                  <input type="text" name="username" id="Username" class="form-control my-4 py-2" placeholder="Username" />
                  <input type="password" name="password" id="Password" class="form-control my-4 py-2" placeholder="Password" />
                  <div class="text-center mt-3">
                    <button class="btn btn-primary" name= "submit">Login</button>
                    <input type="reset" class="btn btn-secondary" value="Reset" />
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</body>
</html>




