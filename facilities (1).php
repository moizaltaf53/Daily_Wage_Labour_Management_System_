<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TJ Hotel-FACILITIES</title>
    <?php require('inc/links.php'); ?>

</head>

<body class="bg-light">
    <?php require('inc/header.php'); ?>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-centre mt-3">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
            Quae placeat est quo quos? Blanditiis, ducimus ipsam!</p>
    </div>
    <div class="container">
        <div class="row">
            <?php 
               $rest=selectAll('facilities');
               $path=FEATURES_IMG_PATH;
               while($row=mysqli_fetch_assoc($rest)){
               echo<<<data
                   <div class="col-lg-4 col-md-6 mb-5 p-4">
                     <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                          <div class="d-flex align-items-center mb-2">
                                <img src="$path$row[icon]" width="40px">
        
                                <h5 class="m-0 ms-3">$row[name]</h5>
                           </div>
                                <p>
                                   $row[description]
                                </p>
                       </div>
                   </div>
                 data;
               }
            
            ?>
            
            <div class="col-lg-4 col-md-6 mb-5 p-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px">

                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Fugiat rerum amet dolorum necessitatibus modi! Eveniet, rem?

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 p-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px">

                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Fugiat rerum amet dolorum necessitatibus modi! Eveniet, rem?

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 p-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px">

                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Fugiat rerum amet dolorum necessitatibus modi! Eveniet, rem?

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 p-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px">

                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Fugiat rerum amet dolorum necessitatibus modi! Eveniet, rem?

                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-5 p-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                    <div class="d-flex align-items-center mb-2">
                        <img src="images/facilities/wifi.svg" width="40px">

                        <h5 class="m-0 ms-3">Wifi</h5>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Fugiat rerum amet dolorum necessitatibus modi! Eveniet, rem?

                    </p>
                </div>
            </div>


        </div>
    </div>
    </div>

    <!-- navigation bar -->



    <!-- footer -->


    <?php require('inc/footer.php'); ?>



    <!-- Swiper JS -->

</body>

</html>