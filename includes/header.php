<header>
 <!-- Navbar Start -->
 <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
           
            
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">Power<span class="text-secondary">flow</span>er</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About Us</a>
                    <a href="product.php" class="nav-item nav-link">Products</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="feature.php" class="dropdown-item">Our Features</a>
                            <a href="testimonial.php" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                    
                    <div class="nav-item dropdown">
                        <a href="#loginform" onclick="myFunction()" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><small class="fa fa-user text-body"></small>
                        <?php
                            $email = $_SESSION['login'];
                            $sql = "SELECT FullName FROM users WHERE EmailId=:email ";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':email', $email, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                            foreach ($results as $result) {

                                echo htmlentities($result->FullName);
                            }
                        } ?></a>
                        <div class="dropdown-menu m-0">
                            <ul>
                            <?php if ($_SESSION['login']) { ?>
                                <li><a href="profile.php">Profiel instellingen</a></li>
                                <li><a href="update-password.php">Vernieuw wachtwoord</a></li>
                                <li><a href="orders.php">Mijn boeking</a></li>
                                <li><a href="logout.php">Sign Out</a></li>
                                <?php } else { ?>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Profiel
                                        instellingen</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Vernieuw
                                        wachtwoord</a>
                                </li>
                                <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Mijn boeking</a></li>
                                <?php } ?>
                            </li>
                            </ul>
                                
                        <li><a href="#loginform" data-toggle="modal" data-dismiss="modal">Afmelden</a></li>
                        </div>
                        
                    </div>
                    <?php
                    $count_cart_items = $dbh->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_items = $count_cart_items->rowCount();
                    ?>
                    <a href="cart.php" class="nav-item nav-link">cart<span><?= $total_cart_items; ?></span></a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
</header>