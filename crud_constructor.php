<?php

require("connection.php");
require("essentials.php");
require("links.php");


function image_upload($img)
{
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111,99999).$img['name'];

    $new_loc = UPLOAD_SRC.$new_name;

    if(!move_uploaded_file($tmp_loc,$new_loc))
    {
        header("location: index.php?alert=img_upload");
        exit;
    }
    else
    {
        return $new_name;
    }
}

if(isset($_POST['register']))
{

    // print_r($_FILES['image']);
    // exit;


    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }

    // $imgpath = image_upload($_FILES['image']);


    $query = "INSERT INTO `register_constructor`(`name`, `email`, `contact_number`, `photo`, `password`) VALUES ('$_POST[name]','$_POST[email]','$_POST[number]','$_POST[image]','$_POST[pass]')";

    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: dashboard.php?success=added");
    } else {
        header("location: index.php?success=add_failed");
    }
}

if(isset($_POST['login']))
{
    //this line
    session_start();

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }

    $query = "SELECT * FROM `register_constructor` WHERE `email` = '$_POST[email]' and `password` = '$_POST[password]'";
    $res = mysqli_query($con,$query);
    $fetch = mysqli_fetch_assoc($res);

    if ($fetch != NULL) {
        //this line
        $_SESSION['user_id'] = $fetch['id'];

        header("location: dashboard.php?success=login_successfully");
    }
    else {
        header("location: index.php?success=login_failed");
    }

}

if(isset($_POST['add_service']))
{
    session_start();

    $user_id = $_SESSION['user_id'];

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    } 

    // $query = "INSERT INTO `add_service`(`name`, `no_of_worker`, `contact_number`, `work_info`, `charges`, `work_date`, `work_start_time`, `work_end_time`,`work_address`) VALUES ('$_POST[name]','$_POST[no_of_worker]','$_POST[contact_number]','$_POST[work_info]','$_POST[charges]','$_POST[work_date]','$_POST[work_start_time]','$_POST[work_end_time]','$_POST[work_address]')";

    $query = "INSERT INTO `add_service`(`name`, `no_of_worker`, `contact_number`, `work_info`, `charges`, `work_date`, `work_start_time`, `work_end_time`,`work_address`) SELECT `name`,'$_POST[no_of_worker]',`contact_number`,'$_POST[work_info]','$_POST[charges]','$_POST[work_date]','$_POST[work_start_time]','$_POST[work_end_time]','$_POST[work_address]'  FROM `register_constructor` WHERE `id` = '$user_id'";

    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: worker_activities/add_services.php?success=added");
    } else {
        header("location: add_services.php?success=add_failed");
    }
}



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


if(isset($_POST['startwork']))
{
    session_start();

    $user_id = $_SESSION['user_id'];

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    } 

    // $query = "INSERT INTO `add_service`(`name`, `no_of_worker`, `contact_number`, `work_info`, `charges`, `work_date`, `work_start_time`, `work_end_time`,`work_address`) VALUES ('$_POST[name]','$_POST[no_of_worker]','$_POST[contact_number]','$_POST[work_info]','$_POST[charges]','$_POST[work_date]','$_POST[work_start_time]','$_POST[work_end_time]','$_POST[work_address]')";

    $query = "INSERT INTO `work_agreement`(`constructor_email`, `worker_email`, `work_start_time`, `work_start_date`) SELECT `email`,'$_POST[worker_email]','$_POST[work_start_time]','$_POST[work_start_date]' FROM `register_constructor` WHERE `id` = '$user_id'";

    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: worker_activities/verify.php?success=added");
    } else {
        header("location: worker_activities/verify.php?success=add_failed");
    }
}

if(isset($_POST['endwork']))
{
    session_start();

    $user_id = $_SESSION['user_id'];

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    } 

    // echo $_POST['work_end_time'];

    $query = "UPDATE `work_agreement` SET `work_end_time` = '$_POST[work_end_time]', `work_end_date` = '$_POST[work_end_date]' WHERE `worker_email` = '$_POST[worker_email]' AND `constructor_email` = (SELECT `email` FROM `register_constructor` WHERE `id` = '$user_id')";

    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: worker_activities/verify.php?success=added");
    } else {
        header("location: worker_activities/verify.php?success=add_failed");
    }
}


if(isset($_POST['constructor_complaint']))
{
    session_start();

    $user_id = $_SESSION['user_id'];

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    } 

    // echo $_POST['work_end_time'];

    $q1 = "SELECT * FROM `register_worker` WHERE `contact_number` = '$_POST[worker_contact]'";

    $r1 = mysqli_query($con,$q1);

    $f1 = mysqli_fetch_assoc($r1);

    // $query = "INSERT INTO `constructor_complaint`(`constructor_name`, `constructor_email`, `constructor_contact`, `worker_name`, `worker_email`, `worker_contact`, `complaint_info` SELECT `name`,'email',`contact_number`,'$f1[name]','$f1[email]','$_POST[work_date]','$_POST[work_start_time]','$_POST[work_end_time]','$_POST[work_address]'  FROM `register_constructor` WHERE `id` = '$user_id'";

    $query = "INSERT INTO `constructor_complaint`(`constructor_name`, `constructor_email`, `constructor_contact`, `worker_name`, `worker_email`, `worker_contact`, `complaint_info`) SELECT `name`, `email`, `contact_number`,'$f1[name]','$f1[email]','$f1[contact_number]','$_POST[complaint_info]' FROM `register_constructor` WHERE `id` = '$user_id'";

    if (mysqli_query($con, $query))
    {
        header("location: worker_activities/add_complaint.php?success=added");
    } 
    else {
        header("location: worker_activities/add_complaint.php?success=add_failed");
    }
}

?>