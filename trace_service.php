<?php
require("connection.php");
require("essentials.php");

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Service</title>
    <?php
    require("links.php");
    ?>
</head>

<body>

    <!-- for navbar -->
    <div class="container-fluid bg-secondary text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="mb-0 h-font">Online Services</h3>
        <div class="d-flex">
            <button type="button" onclick="window.location.href='http://localhost/online_services/services.php';" class="btn btn-outline-dark shadow-none text-white me-3">
                Back
            </button>
            <button type="button" onclick="window.location.href='http://localhost/online_services/index.php';" class="btn btn-outline-dark shadow-none text-white me-3">
                Log Out
            </button>
        </div>
    </div>

    <div class="container-fluid mt-4">


        <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 class="card-title m-0">Trace Your Booked Services Here</h3>
                            <form class="d-flex" method="GET">
                                <input class="form-control me-2 shadow-none" type="search" name="cont" placeholder="Enter contact number" value="<?php if (isset($_GET['search'])) {
                                                                                                                                                        echo $_GET['search'];
                                                                                                                                                    } ?>">
                                <button class="btn btn-outline-success" type="submit" name="search">Search</button>
                            </form>
                        </div>

                        <div class="row shadow p-3" id="team-data" style="width: 80%; margin:auto; margin-top: 30px;">
                            <?php
                                $query = "SELECT * FROM `constructor_responses` WHERE `worker_contact` IN(SELECT `contact_number` FROM `register_worker` WHERE `id` = '$_SESSION[user_id]');
                                
                                $res = mysqli_query($con, $query);


                                while ($fetch = mysqli_fetch_assoc($res)) {
                                    $q = "SELECT `sr_no`, `name`, `service_name`, `contact_number`, `image`, `work_info`, `experience`, `qualification`, `charges` FROM `add_service` WHERE `contact_number` = '$fetch[contact_number]'";
                                    
                                    $r = mysqli_query($con,$q);
                                    if($fetch['status'] == '1')
                                    {
                                        while($f = mysqli_fetch_assoc($r))
                                        {
                                            echo <<< data
                                            <div class="card col-lg-4 me-4" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">$f[name]</h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><b>Status</b> : Accepted</h6>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><b>Contact Number</b> : +91$f[contact_number]</li>
                                                    <li class="list-group-item"><b>Service</b> : $f[service_name]</li>
                                                    <li class="list-group-item"><b>Charges per hour</b> : ₹$f[charges] </li>
                                                </ul>
                                            data;
                                        }
                                        echo <<< data
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><b>Arrival Date</b> : $fetch[arrival_date]</li>
                                                    <li class="list-group-item"><b>Arrival Time</b> : $fetch[arrival_time]</li>
                                                </ul>
                                            </div>
                                        </div>
                                        data;
                                    }
                                    else if($fetch['status'] == '0')
                                    {
                                        $q1 = "SELECT `sr_no`, `name`, `service_name`, `contact_number`, `image`, `work_info`, `experience`, `qualification`, `charges` FROM `add_service` WHERE `contact_number` = '$fetch[contact_number]'";
                                    
                                        $r1 = mysqli_query($con,$q);
                                        while($f1 = mysqli_fetch_assoc($r1))
                                        {
                                            echo <<< data
                                            <div class="card col-lg-4 me-4" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">$f1[name]</h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><b>Status</b> : Rejected</h6>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><b>Contact Number</b> : +91$f1[contact_number]</li>
                                                    <li class="list-group-item"><b>Service</b> : $f1[service_name]</li>
                                                    <li class="list-group-item"><b>Charges per hour</b> : ₹$f1[charges] </li>
                                                </ul>
                                            data;
                                        }
                                        echo <<< data
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><b>Rejection Cause</b> : $fetch[rejection_details]</li>
                                                </ul>
                                            </div>
                                        </div>
                                        data;
                                    }
                                }
                            ?>
                        </div>

                    </div>
                </div>


    </div>

</body>

</html>