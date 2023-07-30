<?php
session_start();

require('connection.php');
require('essentials.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <?php
    include("links.php");
    ?>
    <style>
        #dashboard-menu {
            position: fixed;
            height: 100%;
            z-index: 11;
        }

        .custom-alert {
            position: fixed;
            top: 80px;
            right: 25px;
            z-index: 10;
        }

        @media screen and (max-width: 991px) {
            #dashboard-menu {
                position: fixed;
                height: auto;
                width: 100%;
            }

            #main-content {
                margin-top: 60px;

            }
        }
    </style>
</head>

<body>

    <?php
    require("inc/header.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <!-- add services section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title m-0">Request from Workers</h3>
                            <!-- <form class="d-flex" method="GET">
                                <input class="form-control me-2 shadow-none" type="search" name="cont" placeholder="Enter contact number" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                        echo $_GET['search'];
                                                                                                                                                    } ?>">
                                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                            </form> -->
                        </div>

                        <div class="row shadow p-3" id="team-data" style="width: 80%; margin:auto; margin-top: 30px;">
                            <?php

                            $user_id = $_SESSION['user_id'];

                            //echo $user_id;

                            //if (isset($_GET['search'])) {
                                $query = "SELECT `id`, `date`, `time`, `constructor_contact`,`worker_contact`, `service_name` FROM `booked_services` WHERE `constructor_contact` IN (SELECT `contact_number` FROM `register_constructor` WHERE `id` = '$user_id')";

                                $res = mysqli_query($con, $query);


                                while ($fetch = mysqli_fetch_assoc($res)) {
                                    $q2 = "SELECT `status` FROM `constructor_responses` WHERE `worker_contact` = '$fetch[worker_contact]'";

                                    $result = mysqli_query($con, $q2);

                                    if (mysqli_num_rows($result) > 0) {
                                        continue;
                                    }

                                    print_r('
                                <div class="card col-lg-4 p-3 me-4 my-3" style="width: 18rem;">
                                    <div class="card-body">');
                                    $q1 = "SELECT `name`,`contact_number`,`address` FROM `register_worker` WHERE `contact_number` = '$fetch[worker_contact]'";
                                    $res1 = mysqli_query($con, $q1);
                                    while ($fetch2 = mysqli_fetch_assoc($res1)) {
                                        echo <<< data
                                        <h5 class="card-title">$fetch2[name]</h5>
                                        <p>Address : $fetch2[address]
                                        </p>
                                        <h5> $fetch2[contact_number]</h5>
                                        data;
                                    }
                                    echo <<< data
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Service : $fetch[service_name]</li>
                                        <li class="list-group-item">Date :  $fetch[date]</li>
                                        <li class="list-group-item">Time : $fetch[time]</li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="row">
                                            <button type="button" class="btn btn-success shadow-none col-lg-4 me-3" data-bs-toggle="modal" data-bs-target="#acceptModal">Accept</button>
                                            <button type="submit" class="btn btn-danger shadow-none col-lg-4" data-bs-toggle="modal" data-bs-target="#rejectModal">Cancel</button>
                                        </div>
                                    </div>
                                    </div>
                            data;
                                }
                            //}
                            //?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <!-- pending payments section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title m-0">Pending Payments</h3>
                            <!-- <form class="d-flex" method="GET">
                                <input class="form-control me-2 shadow-none" type="search" name="cont" placeholder="Enter contact number" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                        echo $_GET['search'];
                                                                                                                                                    } ?>">
                                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                            </form> -->
                        </div>

                        <div class="row shadow p-3" id="team-data" style="width: 80%; margin:auto; margin-top: 30px;">
                            

                            <?php

                            $user_id = $_SESSION['user_id'];

                            //echo $user_id;

                            //if (isset($_GET['search'])) {

                                $query = "SELECT `sr_no`, `constructor_email`, `worker_email`, `work_start_time`,`work_end_time`, `work_start_date`, `work_end_date` FROM `work_agreement` WHERE `constructor_email` IN (SELECT `email` FROM `register_constructor` WHERE `id` = '$user_id')";

                                $res = mysqli_query($con, $query);


                                while ($fetch = mysqli_fetch_assoc($res)) {

                                    print_r('
                                <div class="card col-lg-4 p-3 me-4 my-3" style="width: 18rem;">
                                    <div class="card-body">');
                                    $q1 = "SELECT `name`,`contact_number`,`address` FROM `register_worker` WHERE `email` = '$fetch[worker_email]'";
                                    $res1 = mysqli_query($con, $q1);
                                    while ($fetch2 = mysqli_fetch_assoc($res1)) {
                                        echo <<< data
                                        <h5 class="card-title">$fetch2[name]</h5>
                                        <p>Address : $fetch2[address]
                                        </p>
                                        <h5> $fetch2[contact_number]</h5>
                                        data;
                                    }

                                    $q3 = "SELECT `charges` FROM `add_service` WHERE `contact_number` IN (SELECT `contact_number` FROM `register_constructor` WHERE `id` = '$_SESSION[user_id]')AND `work_date` = '$fetch[work_start_date]'";

                                    $res3 = mysqli_query($con, $q3);
                                    $fetch3 = mysqli_fetch_assoc($res3);

                                    echo <<< data
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Work start time : $fetch[work_start_time]</li>
                                        <li class="list-group-item">Work end time :  $fetch[work_end_time]</li>
                                        <li class="list-group-item">Work start date : $fetch[work_start_date]</li>
                                        <li class="list-group-item">Charges : ₹ $fetch3[charges]</li>
                                    </ul>
                                    <div class="card-body">
                                        <div class="row">
                                            <button type="button" class="btn btn-success shadow-none col-lg-6 m-auto" data-bs-toggle="modal" data-bs-target="#acceptModal">Pay Now</button>
                                        </div>
                                    </div>
                                    </div>
                            data;
                                }
                            //}
                            //?>
                            
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- accept modal -->
    <div class="modal fade" id="acceptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="crud_constructor.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>Service Acceptance Panel
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Arrival Date</label>
                            <input type="date" name="arrival_date" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Arrival Time</label>
                            <input type="time" name="arrival_time" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Contact Number</label>
                            <input type="number" name="constructor_contact" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number of Customer</label>
                            <input type="number" name="worker_contact" class="form-control shadow-none">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn shadow-none btn-success mx-auto" name="accept">ACCEPT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="crud_constructor.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>Service Rejection Panel
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Rejection Reason</span>
                                <textarea name="rejection_details" class="form-control shadow-none" aria-label="With textarea"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Contact Number</label>
                            <input type="number" name="constructor_contact" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number of Customer</label>
                            <input type="number" name="worker_contact" class="form-control shadow-none">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn shadow-none btn-danger mx-auto" name="reject">Reject</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</body>


<?php

if (isset($_POST['accept'])) {
    
    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }

    $date = date('Y-m-d',strtotime($_POST['arrival_date']));

    $query = "INSERT INTO `constructor_responses`(`status`, `arrival_date`, `arrival_time`,`constructor_contact`,`worker_contact`) VALUES ('1','$date','$_POST[arrival_time]','$_POST[constructor_contact]','$_POST[worker_contact]')";

    // $query = "INSERT INTO `service_provider_response`(`status`, `arrival_date`, `arrival_time`,`contact_number`,`customer_contact_number`) VALUES ('1','$_POST[arrival_date]','$_POST[arrival_time]','$_POST[contact_number]','$_POST[contact_number_customer]')";


    if (mysqli_query($con, $query)) {
        // alert('success', 'service accepted !!!');
        header("location: dashboard.php?success=accepted");
    } else {
        // alert('error', 'service acception failed!!!');
        header("location: dashboard.php?success=deleted");
    }
}

// if(isset($_POST['book_service']))
// {
//     foreach($_POST as $key => $value){
//         $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
//     }


//     $date = date('Y-m-d',strtotime($_POST['date']));
//     $query = "INSERT INTO `booked_services`(`date`, `time`, `email`, `service_provider_contact`, `service_name`) VALUES ('$date','$_POST[time]','$_POST[email]','$_POST[contact_number]','$_POST[service_name]')";

//     if (mysqli_query($con,$query)) {
//         header("location: services.php?success=booking_successfull");
//     }
//     else {
//         header("location: services.php?success=booking_failed");
//     }
// }

if (isset($_POST['reject'])) {

    $query = "INSERT INTO `constructor_responses`(`status`, `rejection_details`,`constructor_contact`,`worker_contact`) VALUES ('0','$_POST[rejection_details]','$_POST[constructor_contact]','$_POST[worker_contact]')";

    // $query = "INSERT INTO `service_provider_response`(`status`, `rejection_details`,`contact_number`,`customer_contact_number`) VALUES ('0','$_POST[rejection_details]','$_POST[contact_number]','$_POST[contact_number_customer]')";

    if (mysqli_query($con, $query)) {
        alert('error', 'service rejected !!!');
        header("location: dashboard.php?success=rejected");
    } else {
        alert('error', 'service rejection failed!!!');
        header("location: dashboard.php?success=rejection_failed");
    }
}

?>


</html>