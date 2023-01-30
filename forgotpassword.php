<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['update']))
  {
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT EmailId FROM users WHERE EmailId=:email and ContactNo=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update users set Password=:newpassword where EmailId=:email and ContactNo=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}
?>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Power Flower | ForgetPassword</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/alib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!--Header-->
        <?php include('includes/header.php'); ?>
    <!-- /Header -->

<div class="wrapper">
        <div class="logo">
            <img src="assets/img/avatar.png" alt="">
        </div>
        <div class="text-center mt-4 name">
        Password Recovery
        </div>
        <form class="p-3 mt-3" method="post" onSubmit="return valid();">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-envelope"></span>
                <input type="email"  name="email" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-mobile-alt"></span>
                <input type="text"  name="mobile" placeholder="Mobile Number" maxlength="10" required="required">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="newpassword"" id="pwd" placeholder="New Password">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password"  name="confirmpassword" placeholder="Confirm Password" required="required">
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="terms_agree" required="Reset My Password">
                <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
            </div>
            <div class="form-group">
                <input  class="btn mt-3" type="submit" name="update" class="btn btn-block">
            </div>
            <br>
        <div class="text-center fs-6">
            <a href="#loginform" onclick="myFunction()">Login</a>
        </div>
        <div class="text-center">
                <p class="gray_text">For security reasons we don't store your password. Your password will be reset and a new one will be send.</p>
                <p><a href="#loginform" onclick="myFunction()" data-toggle="modal" data-dismiss="modal">
    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back to Login
</a></p>
        </div>
    </div>
<!-- Pills content -->
    <!--Footer -->
    <?php include('includes/footer.php'); ?>
    <!-- /Footer-->
    <!--LogIn-->
        <?php include('includes/login.php'); ?>
    <!--/LogIn-->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>