<html lang="en-SG">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <!--linh icon-->
    <link rel="icon" href="img/logo.png" />
    <link rel="stylesheet" href="{{asset('css/styleALL.css')}}" />
    

    <link rel="stylesheet" href="{{asset('css/NewArrival.css')}}" />
    <link rel="stylesheet" href="{{asset('css/styleCarousel.css')}}" />
    <link rel="stylesheet" href="{{asset('css/NavbarCSS.css')}}" />
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>

    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            background-color: #ffffff;
        }
    </style>
    <title>LinhVuShop</title>
</head>

<body>

    <nav class=hed>
        <!--social-links-and-phone-number----------------->
        <div class="social-call">
            <!--social-links--->
            <div class="social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <!--phone-number------>
            <div class="phone">
                <span>Call: +84 345291510</span>
            </div>
        </div>
        <!--menu-bar----------------------------------------->
        <div class="navigation">
            <!--logo------------>
            <a href="index.php" class="logo"><img src="AnhWeb/img/logo.png" /></a>
            <!--menu-icon------------->
            <div class="itog">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <!--menu----------------->
            <ul id="menu" class="menu">
                <li><a style="text-decoration: none;" href="index.php">Home</a></li>
                <li class="shop"><a style="text-decoration: none;" href="shop.php">SHOP</a></li>
                <li>
                    <a style="text-decoration: none;" href="#">TOP</a>
                    <!--lable---->
                    <span class="sale-lable">Sale</span>
                </li>
                <li><a style="text-decoration: none;" href="#">BOTTOM</a></li>
                <li><a style="text-decoration: none;" href="#">ACCESSORIES</a></li>
                <li><a style="text-decoration: none;" href="#">COLLECTION</a></li>
                <li><a style="text-decoration: none;" href="#">OTHER</a></li>
            </ul>
            <!--right-menu----------->
            <div class="right-menu">
                <a href="javascript:void(0);" class="search" style="text-decoration: none;">
                    <i class="fas fa-search"></i>
                </a>
                <a href="cart.php" style="text-decoration: none;margin-right: 25px">
                    <i class="fas fa-shopping-cart">
                        <?php
                        // session_start();
                        if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])) {
                            echo ('<span class="num-cart-product">
                                     0
                                </span>');
                        } else {
                            echo ('<span class="num-cart-product">
                                     ' . sizeof($_SESSION['cart']) . '
                                </span>');
                        }
                        ?>

                    </i>
                </a>
                <?php
                if (!isset($_SESSION['account']) && empty($_SESSION['account'])) {
                    echo ('<a href="login.php"style="text-decoration: none;" class="user">
                                <i class="far fa-user"></i> LOGIN
                          </a>');
                } else {
                ?>
                    <div class="ml-0">
                        <i class="dropdown">
                            <button class="btn btn-secondary " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php
                                if ($_SESSION['account']['role_id'] != 1) {
                                    echo ('<li><a class="dropdown-item" href="manage">ManageProfile</a></li>');
                                } elseif ($_SESSION['account']['role_id'] == 1) {
                                    echo ('<li><a class="dropdown-item" href="ManagerProduct.php">Manage Product</a></li>
                                        <li><a class="dropdown-item" href="#">Manage Account</a></li>
                                        <li><a class="dropdown-item" href="Manage">Manage Order</a></li>');
                                }
                                ?>
                                <?php
                                if ($_SESSION['account']['role_id'] != 1) {
                                    echo ('<li><a class="dropdown-item" href="#">Order detail</a></li>');
                                }
                                ?>
                                <li><a class="dropdown-item" href="logout.php">LOGOUT</a></li>
                            </ul>
                        </i>
                    </div>

                <?php
                }
                ?>
            </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <div class="footer">
        <footer class="page-footer bg-dark" style="position:relative;
    bottom:0;">
            <div class="containter text-center text-md-left mt-5">
                <div class="row justify-content-center">
                    <div class="col-sm-2 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">ABOUT US</h6>
                        <hr class="bg-success mb-4 mt0 d-inline-block mx-auto" style="width: 140px; height: 2px" />
                        <p class="mt-2 text-light">
                            Chúng tôi tự tin và cam kết mang đến các sản phẩm có chất lượng và giá thành hợp lí nhất.
                        </p>
                    </div>
                    <div class="col-sm-3 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">ADDRESS</h6>
                        <hr class="bg-success mb-4 mt0 d-inline-block mx-auto" style="width: 140px; height: 2px" />
                        <ul class="list-unstyled">
                            <li class="my-2">
                                <a href="#" style="text-decoration: none; color: white">Địa chỉ: HH3A, Khu đô thị Linh Đàm, Hoàng Mai, Hà Nội</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2 mx-auto mb-4">
                        <h6 class="text-uppercase font-weight-bold">CONTACT</h6>
                        <hr class="bg-success mb-4 mt0 d-inline-block mx-auto" style="width: 140px; height: 2px" />
                        <ul class="list-unstyled">
                            <li class="my-2">
                                <a href="#" style="text-decoration: none; color: white">Ms Thanh: </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <p class="text-light text-center">
                &copy; Copyright © 2021 LINH. Powered by LINH
            </p>
        </footer>
    </div>
    <script src="{{asset('js/navbar.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
</body>

</html>