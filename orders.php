<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
}else{
    setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
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
    <section class="orders">

        <h1 class="heading">my orders</h1>

        <div class="box-container">

            <?php
            $select_orders = $dbh->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
            $select_orders->execute([$user_id]);
            if($select_orders->rowCount() > 0){
                while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                    $select_product = $dbh->prepare("SELECT * FROM `postproducer` WHERE id = ?");
                    $select_product->execute([$fetch_order['product_id']]);
                    if($select_product->rowCount() > 0){
                        while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box" <?php if($fetch_order['status'] == 'canceled'){echo 'style="border:.2rem solid red";';}; ?>>
                <a href="view_order.php?get_id=<?= $fetch_order['id']; ?>">
                    <p class="date">
                        <i class="fa fa-calendar"></i><span>
                            <?= $fetch_order['date']; ?>
                        </span>
                    </p>
                    <img src="uploaded_files/<?= $fetch_product['Vimage1']; ?>" class="image" alt="" />
                       <h3><?= $fetch_product['BrandName']; ?></h3> 
                    
                    <p class="price">
                        <i class="fa-solid fa-euro-sign"></i><?= $fetch_order['Price']; ?> x <?= $fetch_order['qty']; ?>
                    </p>
                    <p class="status" style="color:<?php if($fetch_order['status'] == 'delivered'){echo 'green';}elseif($fetch_order['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>">
                        <?= $fetch_order['status']; ?>
                    </p>
                </a>
            </div>
            <?php
            }
         }
      }
   }else{
      echo '<p class="empty">no orders found!</p>';
   }
            ?>

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