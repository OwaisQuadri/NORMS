<?php
session_start(); // Start the session

// If a message is passed here, then this block is used to display it
if (isset($_SESSION["message"])) {
    echo "<script type='text/javascript'> alert(" . "'" . $_SESSION["message"] . "'" . "); </script>";
}
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Internal Server Error</title>
</head>

<body>
    <h1>500 - Internal Server Error</h1>
    <p>mySQL database was unable to connect</p>
    <hr>
    <p><i>NORM'S Car Rental</i></p>
</body>

</html>