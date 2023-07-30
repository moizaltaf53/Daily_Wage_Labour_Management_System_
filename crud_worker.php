<?php

session_start();

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


    $query = "INSERT INTO `register_worker`(`name`, `email`, `contact_number`, `address`, `bank_account_number`, `bank_ifsc_code`, `password`) VALUES ('$_POST[name]','$_POST[email]','$_POST[number]','$_POST[address]','$_POST[bank_account_number]','$_POST[bank_ifsc_code]','$_POST[pass]')";

    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: services.php?success=added");
    } else {
        header("location: index.php?success=add_failed");
    }
}

if(isset($_POST['login']))
{
    // session_start();

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }

    $query = "SELECT `id`,`email`,`password` FROM `register_worker` WHERE `email` = '$_POST[email]' and `password` = '$_POST[password]'";
    $res = mysqli_query($con,$query);
    $fetch = mysqli_fetch_assoc($res);

    if ($fetch != NULL) {

        $_SESSION['user_id'] = $fetch['id'];

        echo $_SESSION['user_id'];

        header("location: services.php?success=login_successfully");
    }
    else {
        header("location: index.php?success=login_failed");
    }

}

if(isset($_POST['add_service']))
{
    session_start();

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }


    $date = date('Y-m-d',strtotime($_POST['work_date']));

    $query = "INSERT INTO `add_service`(`name`, `no_of_worker`, `contact_number`, `work_info`, `charges`,`work_date`,`work_start_time`,`work_end_time`,`work_address`) VALUES ('$_POST[name]','$_POST[no_of_worker]','$_POST[contact_number]','$_POST[work_info]','$_POST[charges]','$_POST[work_date]','$_POST[work_start_time]','$_POST[work_end_time]','$_POST[work_address]')";

    if (mysqli_query($con,$query)) {
        header("location: dashboard.php?success=service_added_successfull");
    }
    else {
        header("location: services.php?success=service_added_failed");
    }
}

if(isset($_POST['delete_service']))
{
    $id = $_POST['id'];
    $query = "DELETE  FROM `add_service` WHERE `sr_no`='$id'";
    if (mysqli_query($con, $query)) //firing a querry to database
    {
        header("location: worker_activities/add_services.php?success=deleted");
        //header("location: dashboard.php?success=deleted");
    } else {
        header("location: worker_activities/add_services?success=deletion_failed");
    }
}


if(isset($_POST['job_application']))
{
    // session_start();

    foreach($_POST as $key => $value){
        $_POST[$key] = mysqli_real_escape_string($con,$value); //escape extra unwanted characters from values
    }

    $q1 = "SELECT * FROM `register_worker` WHERE `id` = '$_SESSION[user_id]'";
    $r1 = mysqli_query($con,$q1);
    $f1 = mysqli_fetch_assoc($r1);

    // echo $$f1['contact_number'];

    $date = date('Y-m-d',strtotime($_POST['date']));

    $query = "INSERT INTO `booked_services`(`date`, `time`, `constructor_contact`, `worker_contact`) VALUES ('$date','$_POST[time]','$_POST[constructor_contact]','$f1[contact_number]')";

    if (mysqli_query($con,$query)) {
        header("location: services.php?success=booking_successfull");
    }
    else {
        header("location: services.php?success=booking_failed");
    }
}



?>