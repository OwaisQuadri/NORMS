<?php
session_start();
require 'config.php';
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (!$connection) {
    $_SESSION["message"] = "Connection Failed";
    header("location: error.html");
} else {
    if (!isset($_POST['fname'])) {
        $_SESSION["message"] = "No Data Found!";
        header("location: index.php");
    } else {





        $first_name = mysqli_real_escape_string($connection, $_POST['fname']);
        $last_name = mysqli_real_escape_string($connection, $_POST['lname']);
        $phone_num = mysqli_real_escape_string($connection, $_POST['pn']);
        $st = mysqli_real_escape_string($connection, $_POST['st']);
        $postal = mysqli_real_escape_string($connection, $_POST['postal']);
        $country = mysqli_real_escape_string($connection, $_POST['country']);
        $prov = mysqli_real_escape_string($connection, $_POST['prov']);
        $city = mysqli_real_escape_string($connection, $_POST['city']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $dln = mysqli_real_escape_string($connection, $_POST['dln']);
        $pickup = mysqli_real_escape_string($connection, $_POST['pickup']);
        $dropoff = mysqli_real_escape_string($connection, $_POST['dropoff']);
        $ccn = mysqli_real_escape_string($connection, $_POST['ccn']);
        $cvv = mysqli_real_escape_string($connection, $_POST['cvv']);
        $expiry = mysqli_real_escape_string($connection, $_POST['expiry']);
        $currVehicle = mysqli_real_escape_string($connection, $_POST['vehicleID']);
        $currVehicleName = mysqli_real_escape_string($connection, $_POST['vehicleName']);
        $cost = mysqli_real_escape_string($connection, $_POST['cost']);


        $st_arr = mb_split(' ', $st, $limit = 2);
        $st_num = $st_arr[0];
        $st_name = $st_arr[1];
        $sql = "INSERT INTO Customers(First_Name,last_name,street,street_num,city,province,country,postal_code,email,cell_num,drivers_license_num) VALUES ('$first_name','$last_name','$st_name',$st_num,'$city','$prov','$country','$postal','$email','$phone_num','$dln');";
        mysqli_query($connection, $sql);
        $sql2 = "SELECT * FROM Customers WHERE First_Name='$first_name' AND Last_Name='$last_name';";
        $query = mysqli_query($connection, $sql2);
        if ($row = $query->fetch_assoc()) {
            $cNum = $row['Customer_ID'];
        }

        $sql3 = "INSERT INTO Rentals(price,pick_up,drop_off,pick_up_location,drop_off_location,Pick_Up_Time,Drop_Off_Time,Customer_ID,Vehicle_ID) VALUES ($cost,'$pickup','$dropoff',1,1,'00:00:00','00:00:00',$cNum,$currVehicle);";
        mysqli_query($connection, $sql3);
        $sql4 = "INSERT INTO Payment(Card_Num,Card_Type,Card_Expiry,Security_code,Customer_ID,Price) VALUES ('$ccn','Visa','$expiry',$cvv,$cNum,$cost);";
        mysqli_query($connection, $sql4);
        $_SESSION["message"] = "$currVehicleName reserved successfully";
        header("location: index.php");
    }
}
