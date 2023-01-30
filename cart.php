<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}
if(isset($_POST['update_cart'])){

    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $update_qty = $dbh->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);

    $success_msg[] = 'Cart quantity updated!';

}
if(isset($_POST['delete_item'])){

$cart_id = $_POST['cart_id'];
$cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

$verify_delete_item = $dbh->prepare("SELECT * FROM `cart` WHERE id = ?");
$verify_delete_item->execute([$cart_id]);

if($verify_delete_item->rowCount() > 0){
    $delete_cart_id = $dbh->prepare("DELETE FROM `cart` WHERE id = ?");
    $delete_cart_id->execute([$cart_id]);
    $success_msg[] = 'Cart item deleted!';
}else{
    $warning_msg[] = 'Cart item already deleted!';
}

}
if(isset($_POST['empty_cart'])){

    $verify_empty_cart = $dbh->prepare("SELECT * FROM `cart` WHERE user_id = ?");
$verify_empty_cart->execute([$user_id]);

if($verify_empty_cart->rowCount() > 0){
    $delete_cart_id = $dbh->prepare("DELETE FROM `cart` WHERE user_id = ?");
    $delete_cart_id->execute([$user_id]);
    $success_msg[] = 'Cart emptied!';
}else{
    $warning_msg[] = 'Cart already emptied!';
}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Power flower</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="assets/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./assets/css/style.css" rel="stylesheet">
    
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
    <section class="products">

        <h1 class="heading">shopping cart</h1>

        <div class="box-container">
            <?php
                $grand_total = 0;
                $select_cart = $dbh->prepare("SELECT * FROM `cart` WHERE user_id= ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){

                 $select_products = $dbh->prepare("SELECT * FROM `postproducer` WHERE id = ?");
                $select_products->execute([$fetch_cart['product_id']]);
                if($select_products->rowCount() > 0){
                $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);

            ?>
            <form action="" method="POST" class="box">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>" />
                <img src="uploaded_files/<?= $fetch_product['Vimage1']; ?>" class="image" alt="" />
                <h3 class="name"><?= $fetch_product['BrandName']; ?></h3>
                <div class="flex">
                    <p class="Price"><i class="fa-solid fa-euro-sign"></i><?= $fetch_cart['Price']; ?></p>
                    <input type="number" name="qty" required min="1" value="<?= $fetch_cart['qty']; ?>" max="99" maxlength="2" class="qty" />
                    <button type="submit" name="update_cart" class="fa-solid fa-pen-to-square""></button>
                </div>
                <p class="sub-total">sub total : <span><i class="fa-solid fa-euro-sign"></i><?= $sub_total = ($fetch_cart['qty'] * $fetch_cart['Price']); ?></span></p>
                <input type="submit" value="delete" name="delete_item" class="delete-btn" onclick="return confirm('delete this item?');" />
            </form>
            <?php
                $grand_total += $sub_total;
                }else{
                    echo '<p class="empty">product was not found!</p>';
                }
                }
                }else{
                    echo '<p class="empty">your cart is empty!</p>';
                }
            ?>
            </div>
            <?php if($grand_total != 0){ ?>
            <div class="cart-total">
                <p>grand total : <span><i class="fa-solid fa-euro-sign"></i><?= $grand_total; ?></span></p>
                <form action="" method="POST">
                    <input type="submit" value="empty cart" name="empty_cart" class="delete-btn" onclick="return confirm('empty your cart?');" />
                </form>
                <a href="checkout.php" class="btnn">proceed to checkout</a>
            </div>
            <?php } ?>
    </section>
    <br>
            <!--Footer-->
            <?php include('includes/footer.php'); ?>
            <!--LogIn-->
            <?php include('includes/login.php'); ?>

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
                <i class="bi bi-arrow-up"></i>
            </a>


            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="assets/lib/wow/wow.min.js"></script>
            <script src="assets/lib/easing/easing.min.js"></script>
            <script src="assets/lib/waypoints/waypoints.min.js"></script>
            <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


            <!-- Template Javascript -->
            <script src="assets/js/main.js"></script>
            <script src="assets/js/script.js"></script>
    <!--alert-->
    <?php include('includes/alert.php'); ?>
    <!-- /alert -->
</body>
</html>