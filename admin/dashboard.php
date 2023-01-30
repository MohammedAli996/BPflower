<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
?>
<!doctype html>
<html>

<head>
<meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.gstatic.com">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Flower Power| Admin Change Password</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0" />
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Admin Stye -->
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="./css/header.css">

</head>
<body>
<!-- navigation menu start  -->
<?php include('includes/leftbar.php'); ?>
<!-- navigation menu end  -->
<section class="home-section">
    <div class="home-content">
        <i class="bx bx-menu" ></i>
        <span class="text">Dashboard</span>
    </div>
    <div class="blocks wrapper">
        <div class="block">
            <div class="heading">
            Reg Users
            </div>
            <div> 
                <?php
                    $sql = "SELECT id from users ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $regusers = $query->rowCount();
                    ?>
            </div>
            <div class="num"><?php echo htmlentities($regusers); ?></div>
            <a href="regusers.php" class="arrow">Full Detail <i class="fa fa-arrow-right"></i></a>
        </div>
            <div class="block">
                <div class="heading">
                Listed Brands
                </div>
                <div> 
                    <?php
                        $sql3 = "SELECT id from tblbrands ";
                        $query3 = $dbh->prepare($sql3);
                        $query3->execute();
                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                        $brands = $query3->rowCount();
                    ?>
                </div>
                <div class="num"><?php echo htmlentities($brands); ?></div>
                <a href="manage-brands.php" class="arrow">Full Detail <i class="fa fa-arrow-right"></i></a>
            </div>
        <div class="block">
            <div class="heading">
                Listed orders
            </div>
            <div>
                <?php
                $sql3 = "SELECT id from orders ";
                $query3 = $dbh->prepare($sql3);
                $query3->execute();
                $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                $brands = $query3->rowCount();
                ?>
            </div>
            <div class="num">
                <?php echo htmlentities($brands); ?>
            </div>
            <a href="manage-brands.php" class="arrow">
                Full Detail <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="blocks wrapper">
            <div class="block">
                <div class="heading">
                    contact  Users
                </div>
                <div>
                    <?php
                        $sql = "SELECT id from contactus ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $regusers = $query->rowCount();
                    ?>
                </div>
                <div class="num">
                    <?php echo htmlentities($regusers); ?>
                </div>
                <a href="contactus.php" class="arrow">
                    Full Detail <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
</section>
</body>
<script src="js/main.js"></script>
</html>
<?php } ?>