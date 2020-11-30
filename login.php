<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: welcome.php");
                            
                        }
                    }

                }

    }
}    


}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="Style.css">
  </head>
  <body bgcolor="black">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Lokmanya Tilak College of Engineering</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>

      
     
    </ul>
  </div>
</nav>

<div class="container"><!--container start-->
  	<!--header start-->
  	<div class="header">
  	<img src="logo.png" width="500" height="100">
    <div class="userarea"><!--userarea start-->
      <form action="https://www.google.com/search" method="get">
            <input type="text" name="q" class="search" placeholder="search Here">
            <input type="submit" name="submit" class="submit" value="Search">
       </form>
    </div><!--userarea end-->
  	</div>
    <!--header end-->

<div class="container mt-4">
<h3>Login Here:</h3>
<hr>

<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Keep me login </label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


</div>

   


<!--map and address-->
<div class="footer">
   <!--map-->
   <br>
  <div class="row">
  <div class="col-6">
      <h3 class="head">COLLEGE LOCATION</h3>
      <br>
      <div class="map">
      	<img src="map.png" width="170" height="170">
      </div>
  </div><!--col-4-->

  <div class="col-4">
       <h3 class="head">COLLEGE ADDRESS</h3>
       <br>
       <div class="para">
      	<p>Postal Code: 400709</p>
        <p>022 2754 1005</p>
        <p>principal.ltce@ltjss.net</p>
        <p>Monday - Friday:</p>
        <p> 9:00 AM - 5:00 PM</p>
    </div>
  </div><!--col-4-->

</div><!--row-->


  <div class="clearfix">  
  </div>
</div>
 
 
<!--map and address end-->


  <footer class="copyright text-center">
    &copy;2020 |<a href="https://ltce.in/"> Lokmanya Tilak College of Engineering </a>| All Rights Reserved
    
  </footer>
              
  </div>
  <!--container end-->



  </body>
</html>
