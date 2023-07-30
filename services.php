<?php
require("links.php");
require("connection.php");
require("essentials.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        .custom-alert {
            position: fixed;
            top: 80px;
            right: 25px;
            z-index: 10;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="#">GovWorkerHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-flex">
                <button type="button" onclick="window.location.href='http://localhost/online_services/trace_service.php';" class="btn btn-outline-dark shadow-none me-5">
                    Trace Job Application
                </button>
                <button type="button" class="btn btn-outline-dark shadow-none me-5" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    Feedback
                </button>
                <button type="button" onclick="logout()" class="btn btn-outline-dark shadow-none">
                    Log Out
                </button>
            </div>
        </div>
    </nav>

<script>
    function logout() {
    // Make an AJAX call to the PHP script
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'inc/logout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        // Redirect to the desired location
        window.location.href = 'http://localhost/online_services/index.php';
    };
    xhr.send();
}
</script>

    <!-- feedback modal -->
    <div class="modal fade" id="feedbackModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>Feedback Panel
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Your Email :</label>
                            <input type="email" name="email" class="form-control shadow-none" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Feedback Type : </label>
                            <input type="text" name="f_type" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Feedback : </label> <br>
                            <textarea name="d_desc" cols="50" rows="5" require></textarea>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none" name="f_submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="my-5 px-4">
        <h1 class="fw-bold h-font text-center"> <span class="text-primary">AVAILABLE</span> <span class="text-danger"> JOBS </span></h1>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            <b><span class="text-primary">We are having four services. But stay connected. We</span><span class="text-danger">
                    will enlarge our servicess to fullfill your wish !</span></b>
        </p>
    </div>

    <!-- available jobs -->
    <div class="container-fluid shadow" style="width: 80%; margin-top:160px;">
        <div class="container">
            <div class="row d-flex justify-content-evenly">

                <?php

                $query = "SELECT * FROM `add_service`";
                $res = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($res)) {
                    echo <<< data
                    <div class="col-lg-3 col-md-6 mb-5 p-4">
                    <div class="card border border-danger" style="width: 18rem;">
                        <div class="card-body">
                            <h4 class="card-title"> <b>$fetch[name]</b></h4>
                            <p class="card-text">
                            
                            <div class="exp my-1 mt-3">
                                <b>Work Info : </b> : $fetch[work_info]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Work Address : </b> : $fetch[work_address]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Contact Number : </b> : $fetch[contact_number]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Number of wrkers : </b> : $fetch[no_of_worker]
                            </div>
                            <div class="qual my-1">
                                <b>Work Date</b> : $fetch[work_date]
                            </div>
                            <div class="charg my-1">
                                <b>Work Start Time : </b> : $fetch[work_start_time]
                            </div>
                            <div class="charg my-1">
                                <b>Work End Time : </b> : $fetch[work_end_time]
                            </div>
                            <div class="charg my-1">
                                <b>Charges : </b> : ₹ $fetch[charges]
                            </div>
                            </p>
                            <div class="form p-3">
                                <form action="crud_worker.php" method="post">
                                    <input type="hidden" name="constructor_contact" value="$fetch[contact_number]">
                                    <input type="hidden" name="date" value="$fetch[work_date]">
                                    <input type="hidden" name="time" value="$fetch[work_start_time]">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-sm shadow-none btn-outline-dark" name="job_application">APPLY NOW</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                data;
                }
                ?>

            </div>
        </div>
    </div>

    <!-- for plumbers -->
    <!-- <div class="container-fluid shadow" style="width: 80%; margin-top:160px;">
        <div class="px-4">
            <br>
            <h2 class="d-block my-3 fw-bold h-font text-center text-danger">Plumbers</h2>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-evenly">

                <?php

                $query = "SELECT `sr_no`, `name`, `service_name`, `contact_number`, `image`, `work_info`, `experience`, `qualification`, `charges` FROM `add_service` WHERE `service_name` = 'Plumber'";
                $res = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($res)) {
                    echo <<< data
                    <div class="col-lg-3 col-md-6 mb-5 p-4">
                    <div class="card bg-danger text-white border border-primary" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"> <b>$fetch[name]</b></h5>
                            <p class="card-text">
                            <div class="work-info">
                                $fetch[work_info]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Experience</b> : $fetch[experience] years
                            </div>
                            <div class="qual my-1">
                                <b>Qualification</b> : $fetch[qualification]
                            </div>
                            <div class="charg my-1">
                                <b>Charges</b> : ₹ $fetch[charges]
                            </div>
                            <div class="charg my-1">
                                <b>Contact</b> : +91$fetch[contact_number]
                            </div>
                            </p>
                            <div class="form bg-primary p-3">
                                <form action="crud.php" method="post">
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Date : </label>
                                        <input class="col-lg-7" type="date" name="date" required id="">
                                    </div>
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Time : </label>
                                        <input class="col-lg-7" type="time" name="time" required id="">
                                    </div>
                                    <div class="row d-flex my-1 mb-3">
                                        <label class="col-lg-4" for="">Email : </label>
                                        <input class="col-lg-7" type="email" name="email" required id="">
                                    </div>
                                    <input type="hidden" name="contact_number" value="$fetch[contact_number]">
                                    <input type="hidden" name="service_name" value="$fetch[service_name]">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-sm shadow-none btn-outline-dark" name="book_service">BOOK
                                            SERVICE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                data;
                }
                ?>

            </div>
        </div>
    </div> -->

    <!-- for carpenters -->
    <!-- <div class="container-fluid shadow" style="width: 80%; margin-top:160px;">
        <br>
        <div class="px-4">
            <h2 class="d-block my-3 fw-bold h-font text-center text-primary">Carpenters</h2>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-evenly">

                <?php

                $query = "SELECT `sr_no`, `name`, `service_name`, `contact_number`, `image`, `work_info`, `experience`, `qualification`, `charges` FROM `add_service` WHERE `service_name` = 'Carpenters'";
                $res = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($res)) {
                    echo <<< data
                    <div class="col-lg-3 col-md-6 mb-5 p-4">
                    <div class="card bg-primary text-white border border-danger" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"> <b>$fetch[name]</b></h5>
                            <p class="card-text">
                            <div class="work-info">
                                $fetch[work_info]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Experience</b> : $fetch[experience] years
                            </div>
                            <div class="qual my-1">
                                <b>Qualification</b> : $fetch[qualification]
                            </div>
                            <div class="charg my-1">
                                <b>Charges</b> : ₹ $fetch[charges]
                            </div>
                            <div class="charg my-1">
                                <b>Contact</b> : +91$fetch[contact_number]
                            </div>
                            </p>
                            <div class="form bg-danger p-3">
                                <form action="crud.php" method="post">
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Date : </label>
                                        <input class="col-lg-7" type="date" name="date" required id="">
                                    </div>
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Time : </label>
                                        <input class="col-lg-7" type="time" name="time" required id="">
                                    </div>
                                    <div class="row d-flex my-1 mb-3">
                                        <label class="col-lg-4" for="">Email : </label>
                                        <input class="col-lg-7" type="email" name="email" required id="">
                                    </div>
                                    <input type="hidden" name="contact_number" value="$fetch[contact_number]">
                                    <input type="hidden" name="service_name" value="$fetch[service_name]">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-sm shadow-none btn-outline-dark" name="book_service">BOOK
                                            SERVICE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                data;
                }
                ?>

            </div>
        </div>
    </div> -->

    <!-- for electricians -->
    <!-- <div class="container-fluid shadow" style="width: 80%; margin-top:160px;">
        <div class="px-4">
            <br>
            <h2 class="d-block my-3 fw-bold h-font text-center text-dark">Electricians</h2>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-evenly">

                <?php

                $query = "SELECT `sr_no`, `name`, `service_name`, `contact_number`, `image`, `work_info`, `experience`, `qualification`, `charges` FROM `add_service` WHERE `service_name` = 'Electrician'";
                $res = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($res)) {
                    echo <<< data
                    <div class="col-lg-3 col-md-6 mb-5 p-4">
                    <div class="card bg-secondary text-white border border-white" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"> <b>$fetch[name]</b></h5>
                            <p class="card-text">
                            <div class="work-info">
                                $fetch[work_info]
                            </div>
                            <div class="exp my-1 mt-3">
                                <b>Experience</b> : $fetch[experience] years
                            </div>
                            <div class="qual my-1">
                                <b>Qualification</b> : $fetch[qualification]
                            </div>
                            <div class="charg my-1">
                                <b>Charges</b> : ₹ $fetch[charges]
                            </div>
                            <div class="charg my-1">
                                <b>Contact</b> : +91$fetch[contact_number]
                            </div>
                            </p>
                            <div class="form bg-info p-3">
                                <form action="crud.php" method="post">
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Date : </label>
                                        <input class="col-lg-7" type="date" name="date" required id="">
                                    </div>
                                    <div class="row d-flex my-1">
                                        <label class="col-lg-4" for="">Time : </label>
                                        <input class="col-lg-7" type="time" name="time" required id="">
                                    </div>
                                    <div class="row d-flex my-1 mb-3">
                                        <label class="col-lg-4" for="">Email : </label>
                                        <input class="col-lg-7" type="email" name="email" required id="">
                                    </div>
                                    <input type="hidden" name="contact_number" value="$fetch[contact_number]">
                                    <input type="hidden" name="service_name" value="$fetch[service_name]">
                                    <div class="d-flex justify-content-evenly">
                                        <button type="submit" class="btn btn-sm shadow-none btn-outline-dark" name="book_service">BOOK
                                            SERVICE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                data;
                }
                ?>

            </div>
        </div>
    </div> -->

    <?php
        require("inc/footer.php");
        ?>
    <?php

    if(isset($_POST['f_submit']))
    {

        if($_POST['email']==NULL or $_POST['f_type']==NULL or $_POST['f_desc']==NULL)
        {
            alert('error','feedback not submitted');
            exit;
        }
        $query = "INSERT INTO `customer_feedback`(`email`, `f_type`, `f_desc`) VALUES ('$_POST[email]','$_POST[f_type]','$_POST[f_desc]')";

        if(mysqli_query($con,$query))
        {
            alert('success','feedback submitted');
        }
        else
        {
            alert('error','feedback not submitted');
        }
    }

    ?>
</body>

</html>