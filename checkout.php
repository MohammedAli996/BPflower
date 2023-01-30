<?php
session_start();
include('includes/config.php');
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['place_order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $address = $_POST['flat'].', '.$_POST['street'].', '.$_POST['City'].', '.$_POST['Country'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    $verify_cart = $dbh->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_cart->execute([$user_id]);

    if(isset($_GET['get_id'])){

        $get_product = $dbh->prepare("SELECT * FROM `postproducer` WHERE id = ? LIMIT 1");
        $get_product->execute([$_GET['get_id']]);
        if($get_product->rowCount() > 0){
            while($fetch_p = $get_product->fetch(PDO::FETCH_ASSOC)){
                $insert_order = $dbh->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, method, product_id, Price, qty) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
                $insert_order->execute([create_unique_id(), $user_id, $name, $number, $email, $address, $method, $fetch_p['id'], $fetch_p['Price'], 1]);
                header('location:orders.php');
            }
        }else{
            $warning_msg[] = 'Something went wrong!';
        }

    }elseif($verify_cart->rowCount() > 0){

        while($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)){

            $insert_order = $dbh->prepare("INSERT INTO `orders`(id, user_id, name, number, email, address, method, product_id, Price, qty) VALUES(?,?,?,?,?,?,?,?,?,?)");
            $insert_order->execute([create_unique_id(), $user_id, $name, $number, $email, $address, $method, $f_cart['product_id'], $f_cart['Price'], $f_cart['qty']]);

        }

        if($insert_order){
            $delete_cart_id = $dbh->prepare("DELETE FROM `cart` WHERE user_id = ?");
            $delete_cart_id->execute([$user_id]);
            header('location:orders.php');
        }

    }else{
        $warning_msg[] = 'Your cart is empty!';
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Power flower</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet" />
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="./assets/css/style.css" rel="stylesheet" />

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->
    <section class="checkout">
        <?php
$useremail=$_SESSION['login'];
$sql = "SELECT * from users where EmailId=:useremail";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
   <h1 class="heading">checkout summary</h1>

   <div class="row">

      <form action="" method="POST">
         <h3>billing details</h3>
         <div class="flex">
            <div class="box">
               <p>your name <span>*</span></p>
               <input type="text" name="name" value="<?php echo htmlentities($result->FullName);?>" required maxlength="50" placeholder="enter your name" class="input">
               <p>your number <span>*</span></p>
               <input type="number"  value="<?php echo htmlentities($result->ContactNo);?>" name="number" required maxlength="10" placeholder="enter your number" class="input" min="0" max="9999999999">
               <p>your email <span>*</span></p>
               <input type="email" name="email" value="<?php echo htmlentities($result->EmailId);?>" required maxlength="50" placeholder="enter your email" class="input">
               <p>payment method <span>*</span></p>
               <select name="method" class="input" required>
                  <option value="ideal">ideal</option>
                  <option value="creditcard">credit card</option>
                  <option value="Paypal">Paypal</option>
               </select>
               <p>address type <span>*</span></p>
               <select name="address_type" class="input" required> 
                  <option value="home">home</option>
                  <option value="office">office</option>
               </select>
            </div>
            <div class="box">
               <p>address line 01 <span>*</span></p>
               <input type="text" name="flat" value="<?php echo htmlentities($result->Address);?>" required maxlength="50" placeholder="e.g. flat & building number" class="input">
               <p>city name <span>*</span></p>
               <input type="text" name="city" value="<?php echo htmlentities($result->City);?>" required maxlength="50" placeholder="enter your city name" class="input">
               <p>country name <span>*</span></p>
               <input type="text" name="country" value="<?php echo htmlentities($result->Country);?>" required maxlength="50" placeholder="enter your country name" class="input">
            </div>
         </div>
          <?php }
} ?>
         <input type="submit" value="place order" name="place_order" class="btnn">
      </form>

      <div class="summary">
         <h3 class="title">cart items</h3>
         <?php
         $grand_total = 0;
         if(isset($_GET['get_id'])){
             $select_get = $dbh->prepare("SELECT * FROM `postproducer` WHERE id = ?");
             $select_get->execute([$_GET['get_id']]);
             while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="flex">
            <img src="uploaded_files/<?= $fetch_get['Vimage1']; ?>" class="image" alt="">
            <div>
               <h3 class="name"><?= $fetch_get['name']; ?></h3>
               <p class="Price"><i class="fa-solid fa-euro-sign"></i> <?= $fetch_get['Price']; ?> x 1</p>
            </div>
         </div>
         <?php
             }
         }else{
             $select_cart = $dbh->prepare("SELECT * FROM `cart` WHERE user_id = ?");
             $select_cart->execute([$user_id]);
             if($select_cart->rowCount() > 0){
                 while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                     $select_products = $dbh->prepare("SELECT * FROM `postproducer` WHERE id = ?");
                     $select_products->execute([$fetch_cart['product_id']]);
                     $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                     $sub_total = ($fetch_cart['qty'] * $fetch_product['Price']);

                     $grand_total += $sub_total;
                     
         ?>
         <div class="flex">
            <img src="uploaded_files/<?= $fetch_product['Vimage1']; ?>" class="image" alt="">
            <div>
               <h3 class="name"><?= $fetch_product['BrandName']; ?></h3>
               <p class="Price"><i class="fa-solid fa-euro-sign"></i> <?= $fetch_product['Price']; ?> x <?= $fetch_cart['qty']; ?></p>
            </div>
         </div>
         <?php
                 }
             }else{
                 echo '<p class="empty">your cart is empty</p>';
             }
         }
         ?>
         <div class="grand-total"><span>grand total :</span><p><i class="fa-solid fa-euro-sign"></i> <?= $grand_total; ?></p></div>
      </div>

   </div>

</section>
    <!--Footer-->
    <?php include('includes/footer.php'); ?>

    <!--LogIn-->
    <?php include('includes/login.php'); ?>
    <!--/LogIn-->

    <!-- Back to Top -->
    <a href="#" class="btn-primary btn-lg-square rounded-circle back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
    <!--alert-->
    <?php include('includes/alert.php'); ?>
    <!-- /alert -->
</body>

</html>