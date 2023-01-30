<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,FullName FROM users WHERE EmailId=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['fname']=$results->FullName;
$currentpage=$_SERVER['REQUEST_URI'];
echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>
<div class="wrapper" id="loginform"  style="display:none"> 
        <div class="logo">
            <img src="assets/img/avatar.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            Login
        </div>
        <form class="p-3 mt-3" method="post">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email"  name="email" placeholder="Email address*">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password"  name="password" placeholder="Password*">
            </div>
            <div class="form-group checkbox">
                <input type="checkbox" id="terms_agree" required="required" checked="">
                <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
            </div>
            <button type="submit" name="login" value="Login" class="btn mt-3">Login</button>
        </form>
        <div class="text-center fs-6">
            <a href="forgotpassword.php">Forget password?</a> or <a href="registration.php">Sign up</a>
        </div>
</div>
<script>
   function myFunction() {

   document.getElementById("loginform").style.display = '';
   }
   </script>