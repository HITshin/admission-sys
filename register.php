<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$Local_Address = ['Local_Address'];
$Local_City = ['Local_City'];
$Local_State = ['Local_State'];
$Local_Zip = ['Local_Zip'];
$Permeant_Address = ['Permeant_Address'];
$Permeant_City = ['Permeant_City'];
$Permeant_State = ['Permeant_State'];
$Permeant_Zip = ['Permeant_Zip'];
$Enrollmeant_No = ['Enrollmeant_No'];
$DTE_Id_No = ['DTE_Id_No'];
$Admission_Category = ['Admission_Category'];
$Admission_Centre = ['Admission_Centre'];
$Domicile_State = ['Domicile_State'];
$Date_Of_Birth = ['Date_Of_Birth'];
$Aadhar_Card_No = ['Aadhar_Card_No'];
$Father_PAN_Card_No = ['Father_PAN_Card_No'];
$Cast = ['Cast'];
$Religion =['Religion'];
$Gender = ['Gender'];
$Place_Of_Birth = ['Place_Of_Birth'];
$Student_Name =['Student_Name'];
$Student_Mobile_No = ['Student_Mobile_No'];
$Email = ['Email'];
$Student_Father_Name = ['Student_Father_Name'];
$Father_Mobile_No = ['Father_Mobile_No'];
$Father_Email_Address = ['Father_Email_Address'];
$Student_Mother_Name = ['Student_Mother_Name'];
$Mother_Mobile_No = ['Mother_Mobile_No'];
$Mother_Email_Address = ['Mother_Email_Address'];
$Student_Local_Guardian_Name = ['Student_Local_Guardian_Name'];
$Guardian_Mobile_No = ['Guardian_Mobile_No'];
$Guardian_Email_Address = ['Guardian_Email_Address'];
$Select_Branch = ['Select_Branch'];



if (!empty($username) || !empty($password)  || !empty($confirm_password)  || !empty($Local_Address)  || !empty($Local_City)  || !empty($Local_State)  || !empty($Local_Zip)  || !empty($Permeant_Address)  || !empty($Permeant_City)  || !empty($Permeant_State)  || !empty($Permeant_Zip)  || !empty($Enrollmeant_No)  || !empty($DTE_Id_No)  || !empty($Admission_Category)  || !empty($Admission_Centre)  || !empty($Domicile_State)  || !empty($Date_Of_Birth)  || !empty($Aadhar_Card_No)  || !empty($Father_PAN_Card_No)  || !empty($Cast)  || !empty($Religion)  || !empty($Gender)  || !empty($Place_Of_Birth)  || !empty($Student_Name)  || !empty($Student_Mobile_No)  || !empty($Email)  || !empty($Student_Father_Name)  || !empty($Father_Mobile_No)  || !empty($Father_Email_Address)  || !empty($Student_Mother_Name)  || !empty($Mother_Mobile_No)  || !empty($Mother_Email_Address)  || !empty($Student_Local_Guardian_Name)  || !empty($Guardian_Mobile_No)  || !empty($Guardian_Email_Address)  || !empty($Select_Branch))
 {
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "login";

  $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
  if (mysqli_connect_error()) {
    die('connection Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
  } else {
    $SELECT = "SELECT Email from register Where Email = ? Limit 1";
    $INSERT = "INSERT into register ( username , password, confirm_password , Local_Address ,Local_City , Local_State ,Local_Zip ,Permeant_Address ,Permeant_City ,Permeant_State ,Permeant_Zip  , Enrollmeant_No ,DTE_Id_No , Admission_Category , Admission_Centre ,Domicile_State , Date_Of_Birth , Aadhar_Card_No , Father_PAN_Card_No ,Cast ,Religion ,Gender , Place_Of_Birth , Student_Name , Student_Mobile_No , Student_Email_Address , Student_Father_Name , Father_Mobile_No ,Father_Email_Address , Student_Mother_Name , Mother_Mobile_No , Mother_Email_Address ,Student_Local_Guardian_Name ,Guardian_Mobile_No ,Guardian_Email_Address ,Select_Branch )values( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";

    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->bind_result($Email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum == 0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssisssiissssiissssssississississ", $username, $password, $confirm_password, $Local_Address, $Local_City, $Local_State, $Local_Zip, $Permeant_Address, $Permeant_City, $Permeant_State, $Permeant_Zip, $Enrollmeant_No, $DTE_Id_No, $Admission_Category, $Admission_Centre, $Domicile_State, $Date_Of_Birth, $Aadhar_Card_No, $Father_PAN_Card_No, $Cast, $Religion, $Gender, $Place_Of_Birth, $Student_Name, $Student_Mobile_No, $Email, $Student_Father_Name, $Father_Mobile_No, $Father_Email_Address, $Student_Mother_Name, $Mother_Mobile_No, $Mother_Email_Address, $Student_Local_Guardian_Name, $Guardian_Mobile_No, $Guardian_Email_Address, $Select_Branch);
      $stmt->execute();
      echo "Sucessful Registeration";
    } else {
      echo "someone already register using this email";
    }
  }
}
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
            <input type="text" class="form-control" name="username" required id="inputEmail4" placeholder="Email">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" name="password" required id="inputPassword4" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword4">Confirm Password</label>
          <input type="password" class="form-control" name="confirm_password" required id="inputPassword" placeholder="Confirm Password">
        </div>


        <div class="form-group">
          <label for="inputLocal Address">Local Address </label>
          <input type="text" class="form-control" name="Local_Address" required id="inputLocal Address" placeholder="Local Address">
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputLocal City">Local City</label>
            <input type="text" class="form-control" name="Local_City" required id="inputLocalCity">
          </div>
          <div class="form-group col-md-4">
            <label for="inputLocal State">Local State</label>
            <select id="inputLocal State" class="form-control" name="Local_State" required>
              <option selected>Select</option>
              <option>Maharastra</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputLocal Zip">Local Zip</label>
            <input type="text" class="form-control" id="inputLocal Zip" name="Local_Zip" required>
          </div>

        </div>
        <div class="form-group">
          <label for="inputPermeant  Address">Permeant Address </label>
          <input type="text" class="form-control" id="inputPermeant  Address" placeholder="Permeant  Address" name="Permeant_Address" required>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPermeant  City">Permeant City</label>
            <input type="text" class="form-control" id="inputPermeant  City" name="Permeant_City" required>
          </div>
          <div class="form-group col-md-4">
            <label for="inputPermeant  State">Permeant State</label>
            <select id="inputPermeant  State" class="form-control" name="Permeant_State" required>
              <option selected>Select</option>
              <option>Maharastra</option>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="inputPermeant  Zip">Permeant Zip</label>
            <input type="text" class="form-control" id="inputPermeant  Zip" name="Permeant_Zip" required>
          </div>


          <div class="form-group col-md-4">
            <label for="inputEnrollment No">Enrollment No. </label>
            <input type="text" class="form-control" id="inputEnrollment No" placeholder="Enter your Enrollment No" name="Enrollmeant_No" required>
          </div>


          <div class="form-group col-md-4">
            <label for="inputDTE Id No">DTE Id No. </label>
            <input type="text" class="form-control" id="inputDTE Id No" placeholder="Enter your DTE Id No" name="DTE_Id_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputAdmission Category">Admission Category </label>
            <input type="text" class="form-control" id="inputAdmission Category" placeholder="Enter your Admission Category" name="Admission_Category" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputAdmission Centre">Admission Centre </label>
            <input type="text" class="form-control" id="inputAdmission Centre" placeholder="Enter your Admission Centre" name="Admission_Centre" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputDomicile State">Domicile State </label>
            <input type="text" class="form-control" id="inputDomicile State" placeholder="Enter your Domicile State" name="Domicile_State" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputDate Of Birth">Date Of Birth </label>
            <input type="text" class="form-control" id="inputDate Of Birth" placeholder="Enter your Date Of Birth" name="Date_Of_Birth" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputAadhar Card No.">Aadhar Card No. </label>
            <input type="text" class="form-control" id="inputAadhar Card No." placeholder="Enter your Aadhar Card No" name="Aadhar_Card_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather's PAN Card No.">Fathers PAN Card No. </label>
            <input type="text" class="form-control" id="inputFather's PAN Card No." placeholder="Enter your Father's PAN Card No" name="Father_PAN_Card_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputCast">Cast</label>
            <input type="text" class="form-control" id="inputCast" placeholder="Enter your Cast" name="Cast" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputReligion">Religion</label>
            <input type="text" class="form-control" id="inputReligion" placeholder="Enter your Religion" name="Religion" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputGender">Gender</label>
            <select id="inputGender" class="form-control" name="Gender" required>
              <option selected>Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="form-group col-md-4">
            <label for="inputPlace Of Birth">Place Of Birth</label>
            <input type="text" class="form-control" id="inputPlace Of Birth" placeholder="Enter your Place Of Birth" name="Place_Of_Birth" required>
          </div>




          <div class="form-group col-md-4">
            <label for="inputStudent  Name<e">Student Name</label>
            <input type="text" class="form-control" id="inputStudent  Name<" placeholder="Enter your Name" name="Student_Name" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputStudent Mobile No">Student Mobile No</label>
            <input type="text" class="form-control" id="inputStudent Mobile No" placeholder="Enter Your Mobile No" name="Student_Mobile_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputStudent Email Address">Student Email Address</label>
            <input type="text" class="form-control" id="inputStudent Email Address" placeholder="Enter Your Email Address" name="Email" required>
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Father Name<e">Student Father Name</label>
            <input type="text" class="form-control" id="inputStudent Father Name<" placeholder="Enter your Father Name" name="Student_Father_Name" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather Mobile No">Father Mobile No</label>
            <input type="text" class="form-control" id="inputFather Mobile No" placeholder="Enter Your Father Mobile No" name="Father_Mobile_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputFather Email Address">Father Email Address</label>
            <input type="text" class="form-control" id="inputFather Email Address" placeholder="Enter Your Father E-Mail Address" name="Father_Email_Address" required>
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Mother Name<e">Student Mother Name</label>
            <input type="text" class="form-control" id="inputStudent Mother Name<" placeholder="Enter your Mother Name" name="Student_Mother_Name" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputMother Mobile No">Mother Mobile No</label>
            <input type="text" class="form-control" id="inputMother Mobile No" placeholder="Enter Your Mother Mobile No" name="Mother_Mobile_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputMother Email Address">Mother Email Address</label>
            <input type="text" class="form-control" id="inputMother Email Address" placeholder="Enter Your Mother E-Mail Address" name="Mother_Email_Address" required>
          </div>


          <div class="form-group col-md-4">
            <label for="inputStudent Local Guardian Name<e">Student Local Guardian Name</label>
            <input type="text" class="form-control" id="inputStudent Local Guardian Name<" placeholder="Enter your Local Guardian Name" name="Student_Local_Guardian_Name" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputGuardian Mobile No">Guardian Mobile No</label>
            <input type="text" class="form-control" id="inputGuardian Mobile No" placeholder="Enter Your Local Guardian Mobile No" name="Guardian_Mobile_No" required>
          </div>

          <div class="form-group col-md-4">
            <label for="inputGuardian Email Address">Guardian Email Address</label>
            <input type="text" class="form-control" id="inputGuardian Email Address" placeholder="Enter Your Local Guardian  E-Mail Address" name="Guardian_Email_Address" required>
          </div>

          <div class="form-group col-md-2">
            <label for="inputSelect Branch">Select Branch</label>
            <select id="inputSelect Branch" class="form-control" name="Select_Branch" required>
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
              <input type="file" class="form-control-file" id="Upload your PhotoFormControlFile1" name="Upload_your_Photo">
            </div>
          </form>

          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload 10th OR 12th Result</label>
              <input type="file" class="form-control-file" id="Upload 10th OR 12th ResultFormControlFile1" name="Upload_10th_OR_12th_Result">
            </div>
          </form>

          <form>
            <div class="form-group">
              <label for="exampleFormControlFile1">Upload Diploma Result</label>
              <input type="file" class="form-control-file" id="Upload Diploma ResultControlFile1" name="Upload_Diploma_Result">
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