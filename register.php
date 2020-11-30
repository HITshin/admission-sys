<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Username cannot be blank";
  } else {
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set the value of param username
      $param_username = trim($_POST['username']);

      // Try to execute this statement
      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) == 1) {
          $username_err = "This username is already taken";
        } else {
          $username = trim($_POST['username']);
        }
      } else {
        echo "Something went wrong";
      }
    }
  }

  mysqli_stmt_close($stmt);


  // Check for password
  if (empty(trim($_POST['password']))) {
    $password_err = "Password cannot be blank";
  } elseif (strlen(trim($_POST['password'])) < 5) {
    $password_err = "Password cannot be less than 5 characters";
  } else {
    $password = trim($_POST['password']);
  }

  // Check for confirm password field
  if (trim($_POST['password']) !=  trim($_POST['confirm_password'])) {
    $password_err = "Passwords should match";
  }


  // If there were no errors, go ahead and insert into the database
  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Set these parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

      // Try to execute the query
      if (mysqli_stmt_execute($stmt)) {
        header("location: login.php");
      } else {
        echo "Something went wrong... cannot redirect!";
      }
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
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

  <title>Registration</title>
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

  <div class="container">
    <!--container start-->
    <!--header start-->
    <div class="header">
      <img src="logo.png" width="500" height="100">
      <div class="userarea">
        <!--userarea start-->
        <form action="https://www.google.com/search" method="get">
          <input type="text" name="q" class="search" placeholder="search Here">
          <input type="submit" name="submit" class="submit" value="Search">
        </form>
      </div>
      <!--userarea end-->
    </div>
    <!--header end-->


    <div class="container mt-4">
      <h3>Register Here:</h3>
      <hr>
      <form action="" method="post">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Username</label>
            <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Email">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword4">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" id="inputPassword" placeholder="Confirm Password">
        </div>


        <div class="form-group">
          <label for="inputLocal Address">Local Address </label>
          <input type="text" class="form-control" id="inputLocal Address" placeholder="Local Address">
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputLocal City">Local City</label>
            <input type="text" class="form-control" id="inputLocalCity">
          </div>
          <div class="form-group col-md-4">
            <label for="inputLocal State">Local State</label>
            <select id="inputLocal State" class="form-control">
              <option selected>Select</option>
              <option>Maharastra</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputLocal Zip">Local Zip</label>
            <input type="text" class="form-control" id="inputLocal Zip">
          </div>

        </div>
        <div class="form-group">
          <label for="inputPermeant  Address">Permeant  Address </label>
          <input type="text" class="form-control" id="inputPermeant  Address" placeholder="Permeant  Address">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPermeant  City">Permeant  City</label>
            <input type="text" class="form-control" id="inputPermeant  City">
          </div>
          <div class="form-group col-md-4">
            <label for="inputPermeant  State">Permeant  State</label>
            <select id="inputPermeant  State" class="form-control">
              <option selected>Select</option>
              <option>Maharastra</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputPermeant  Zip">Permeant  Zip</label>
            <input type="text" class="form-control" id="inputPermeant  Zip">
          </div>


          <div class="form-group col-md-4">
            <label for="inputEnrollment No">Enrollment No. </label>
            <input type="text" class="form-control" id="inputEnrollment No" placeholder="Enter your Enrollment No">
          </div>


          <div class="form-group col-md-4">
            <label for="inputDTE Id No">DTE Id No. </label>
            <input type="text" class="form-control" id="inputDTE Id No" placeholder="Enter your DTE Id No">
          </div>

          <div class="form-group col-md-4">
            <label for="inputAdmission Category">Admission Category </label>
            <input type="text" class="form-control" id="inputAdmission Category" placeholder="Enter your Admission Category">
          </div>

          <div class="form-group col-md-4">
            <label for="inputAdmission Centre">Admission Centre </label>
            <input type="text" class="form-control" id="inputAdmission Centre" placeholder="Enter your Admission Centre">
          </div>

          <div class="form-group col-md-4">
            <label for="inputDomicile State">Domicile State </label>
            <input type="text" class="form-control" id="inputDomicile State" placeholder="Enter your Domicile State">
          </div>

          <div class="form-group col-md-4">
            <label for="inputDate Of Birth">Date Of Birth </label>
            <input type="text" class="form-control" id="inputDate Of Birth" placeholder="Enter your Date Of Birth">
          </div>

          <div class="form-group col-md-4">
            <label for="inputAadhar Card No.">Aadhar Card No. </label>
            <input type="text" class="form-control" id="inputAadhar Card No." placeholder="Enter your Aadhar Card No.">
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather's PAN Card No.">Father's PAN Card No. </label>
            <input type="text" class="form-control" id="inputFather's PAN Card No." placeholder="Enter your Father's PAN Card No.">
          </div>

          <div class="form-group col-md-4">
            <label for="inputCast">Cast</label>
            <input type="text" class="form-control" id="inputCast" placeholder="Enter your Cast">
          </div>

          <div class="form-group col-md-4">
            <label for="inputReligion">Religion</label>
            <input type="text" class="form-control" id="inputReligion" placeholder="Enter your Religion">
          </div>

          <div class="form-group col-md-4">
            <label for="inputGender">Gender</label>
            <select id="inputGender" class="form-control">
              <option selected>Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="inputPlace Of Birth">Place Of Birth</label>
            <input type="text" class="form-control" id="inputPlace Of Birth" placeholder="Enter your Place Of Birth">
          </div>




          <div class="form-group col-md-4">
            <label for="inputStudent  Name<e">Student Name</label>
            <input type="text" class="form-control" id="inputStudent  Name<" placeholder="Enter your Name">
          </div>

          <div class="form-group col-md-4">
            <label for="inputStudent Mobile No">Student Mobile No</label>
            <input type="text" class="form-control" id="inputStudent Mobile No" placeholder="Enter Your Mobile No">
          </div>

          <div class="form-group col-md-4">
            <label for="inputStudent E-Mail Address">Student E-Mail Address</label>
            <input type="text" class="form-control" id="inputStudent E-Mail Address" placeholder="Enter Your E-Mail Address">
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Father Name<e">Student Father Name</label>
            <input type="text" class="form-control" id="inputStudent Father Name<" placeholder="Enter your Father Name">
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather Mobile No">Father Mobile No</label>
            <input type="text" class="form-control" id="inputFather Mobile No" placeholder="Enter Your Father Mobile No">
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather E-Mail Address">Father E-Mail Address</label>
            <input type="text" class="form-control" id="inputFather E-Mail Address" placeholder="Enter Your Father E-Mail Address">
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Mother Name<e">Student Mother Name</label>
            <input type="text" class="form-control" id="inputStudent Mother Name<" placeholder="Enter your Mother Name">
          </div>

          <div class="form-group col-md-4">
            <label for="inputMother Mobile No">Mother Mobile No</label>
            <input type="text" class="form-control" id="inputMother Mobile No" placeholder="Enter Your Mother Mobile No">
          </div>

          <div class="form-group col-md-4">
            <label for="inputMother E-Mail Address">Mother E-Mail Address</label>
            <input type="text" class="form-control" id="inputMother E-Mail Address" placeholder="Enter Your Mother E-Mail Address">
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Local Guardian Name<e">Student Local Guardian Name</label>
            <input type="text" class="form-control" id="inputStudent Local Guardian Name<" placeholder="Enter your Local Guardian Name">
          </div>

          <div class="form-group col-md-4">
            <label for="inputGuardian Mobile No">Guardian Mobile No</label>
            <input type="text" class="form-control" id="inputGuardian Mobile No" placeholder="Enter Your Local Guardian Mobile No">
          </div>

          <div class="form-group col-md-4">
            <label for="inputGuardian E-Mail Address">Guardian E-Mail Address</label>
            <input type="text" class="form-control" id="inputGuardian E-Mail Address" placeholder="Enter Your Local Guardian  E-Mail Address">
          </div>

          <div class="form-group col-md-2">
            <label for="inputSelect Branch">Select Branch</label>
            <select id="inputSelect Branch" class="form-control">
              <option selected>Select</option>
              <option>Computer Engineering</option>
              <option>Electrical Engineering</option>
              <option>Electronics & Telecommunication Engineering</option>
              <option>Mechanical Engineering</option>
            </select>
          </div>


          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload your Photo</label>
              <input type="file" class="form-control-file" id="Upload your PhotoFormControlFile1">
            </div>
          </form>

          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload 10th OR 12th Result</label>
              <input type="file" class="form-control-file" id="Upload 10th OR 12th ResultFormControlFile1">
            </div>
          </form>

          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload Diploma Result</label>
              <input type="file" class="form-control-file" id="Upload Diploma ResultControlFile1">
            </div>
          </form>













          <button type="submit" class="btn btn-primary">Sign in</button>
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
        </div>
        <!--col-4-->

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
        </div>
        <!--col-4-->

      </div>
      <!--row-->


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