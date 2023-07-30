<?php
require('links.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Work Portal</title>
</head>

<body bg-white>

    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">GovWorkerHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#1">Job Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#2">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#3">About</a>
                    </li>
                </ul>
                <!-- for constructor -->
                <div class="d-flex flex-column">
                    <h5 class="text-center">Constructor</h5>
                    <div class="d-flex" style="margin-right: 30px;">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#constructorloginModal">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#constructorregisterModal">
                            Register
                        </button>
                    </div>
                </div>
                <!-- for worker -->
                <div class="d-flex flex-column">
                    <h5 class="text-center">Worker</h5>
                    <div class="d-flex">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#workerloginModal">
                            Login
                        </button>
                        <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#workerregisterModal">
                            Register
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!--login modal for worker-->
    <div class="modal fade" id="workerloginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <form action="crud.php" method="post"> -->
                <form action="crud_worker.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>Worker Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control shadow-none" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none" name="login">LOGIN</button>
                            <a href="javascript:void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Register modal for worker -->
    <div class="modal fade" id="workerregisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <form action="crud.php" method="post"> -->
                <form action="crud_worker.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>Worker Registration
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 me-3 text-wrap lh-base">
                            Note : Provide your accurate bank details and contact information as it will be useful for further process.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" name="name">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none" aria-describedby="emailHelp" name="email">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shadow-none" name="number">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.webp,.svg" required>
                                </div>
                                <!-- <div class="col-md-12 p-0 shadow-none mb-3"> -->
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" rows="1" name="address"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Bank Account Number</label>
                                    <input type="number" class="form-control shadow-none" name="bank_account_number">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">IFSC Code</label>
                                    <input type="number" class="form-control shadow-none" name="bank_ifsc_code">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" name="pass">
                                </div>
                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none" name="register">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--login modal for constructor-->
    <div class="modal fade" id="constructorloginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <form action="crud_worker.php" method="post"> -->
                <form action="crud_constructor.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>Constructor Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control shadow-none" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none" name="login">LOGIN</button>
                            <a href="javascript:void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Register modal for constructor -->
    <div class="modal fade" id="constructorregisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- <form action="crud_worker.php" method="post"> -->
                <form action="crud_constructor.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>Constructor Registration
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark mb-3 me-3 text-wrap lh-base">
                            Note : Provide your accurate photo and contact information as it will be useful for further process.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" name="name">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none" aria-describedby="emailHelp" name="email">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control shadow-none" name="number">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.webp,.svg" required>
                                </div>
                                <!-- <div class="col-md-6 p-0 mb-3 mt-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Select Work</label>
                                        </div>
                                        <select class="custom-select" id="inputGroupSelect01" name="work">
                                            <option selected>Choose...</option>
                                            <option value="Painter">Painter</option>
                                            <option value="Plumber">Plumber</option>
                                            <option value="Carpenters">Carpenters</option>
                                            <option value="Electrician">Electrician</option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" name="pass">
                                </div>
                            </div>
                            <div class="text-center my-1">
                                <button type="submit" class="btn btn-dark shadow-none" name="register">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid px-lg-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="uploads/workers_bg.jpeg" class="d-block mx-auto opacity-50" style="width: 80%; height: 90%; opacity: 0.7;" />
                </div>
            </div>
        </div>
    </div>

    <!-- Job Categories -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font" id="1">OUR SERVICES</h2>
    <div class="container">
        <div class="row">

            <!-- General Labors -->
            <div class="col-lg-3 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="uploads/painter.jpg" style="height: 250px;" class="card-img-top" alt="room">
                    <div class="card-body bg-p">
                        <h3 class="text-center p-3">General Labors</h3>
                        <div class="rating mb-4 text-center p-2">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <!-- <div class="text-center">
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Book Now
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Plumber -->
            <div class="col-lg-3 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="uploads/plumber.jpg" style="height: 250px;" class="card-img-top" alt="room">
                    <div class="card-body">
                        <h3 class="text-center p-3">Plumber</h3>
                        <div class="rating mb-4 text-center p-2">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <!-- <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Book Now
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Carpenter -->
            <div class="col-lg-3 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="uploads/carpenter.jpg" style="height: 250px;" class="card-img-top" alt="room">
                    <div class="card-body">
                        <h3 class="text-center p-3">Carpenter</h3>
                        <div class="rating mb-4 text-center p-2">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <!-- <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Book Now
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Electrician -->
            <div class="col-lg-3 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="uploads/electrician.png" style="height: 250px;" class="card-img-top" alt="room">
                    <div class="card-body">
                        <h3 class="text-center p-3">Electrician</h3>
                        <div class="rating mb-4 text-center p-2">
                            <h5 class="mb-1">Rating</h5>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <!-- <div class="d-flex justify-content-evenly">
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Book Now
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Reach Us -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font" id="2">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
                <!-- <iframe class="w-100" height="320px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30237.690909465462!2d73.87592226404914!3d18.676943944253413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2c628ae2ec5f9%3A0x2b421cca670af934!2sAlandi%2C%20Pune%2C%20Maharashtra%20412105!5e0!3m2!1sen!2sin!4v1650548589044!5m2!1sen!2sin" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                <img src="uploads/Government_of_India_logo.svg" width="80%" alt="">
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Call Us</h5>
                    <a href="tel: +919130219601" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +919130219601
                    </a>
                    <br>
                    <a href="tel: +919130219601" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +919130219601
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4">
                    <h5>Follow Us</h5>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-twitter me-1"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="#" class="d-inline-block">
                        <span class="badge bg-light text-dark fs-6 p-2">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require("inc/footer.php") ?>

</body>

</html>