<?php
session_start(); // Start the session

// If a message is passed here, then this block is used to display it
if (isset($_SESSION["message"])) {
    echo "<script type='text/javascript'> alert(" . "'" . $_SESSION["message"] . "'" . "); </script>";
}
unset($_SESSION['message']);

require "config.php";

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if (!$connection) {
    $_SESSION["message"] = "Unable to connect to database";
    header("location: error.html");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>
        NORM'S Car Rental
    </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">NORM'S</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#stats">Why Us?</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">NORM'S Car Rental</div>
            <div class="masthead-heading text-uppercase">We Make Your Drive Memorable</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#stats">Learn More</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="stats">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">WHY US?</h2>
                <h3 class="section-subheading text-muted">We are industry leaders in terms of overall customer support and satisfaction. We have a powerful and easy interface and offer great amazing vehicles for the best prices in the market. We are flexible, available 24/7, and determined to provide you with the best experience.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-user fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Users</h4>
                    <p class="text-muted">
                        Norm's Car Rental Services is a North American car rental company that
                        provides its services to
                        <?php
                        $sql = "SELECT COUNT(*) FROM Customers";
                        $query = mysqli_query($connection, $sql);
                        $numOfUsers;
                        while ($row = $query->fetch_assoc()) {
                            foreach ($row as $key => $value) {
                                $numOfUsers = $value;
                                echo "$value";
                            }
                        }
                        ?> customers accross the region.</p>

                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Volume</h4>
                    <p class="text-muted">
                        We are a very reliable and reusable service, our system is easy
                        to use! We believe that our total booking is a great way to show
                        our customer care, and with

                        <?php
                        $sql = "SELECT COUNT(*) FROM Rentals";
                        $query = mysqli_query($connection, $sql);
                        $ratio;
                        $numOfBookings;
                        while ($row = $query->fetch_assoc()) {
                            foreach ($row as $key => $value) {
                                $numOfBookings = $value;
                                $ratio = $numOfBookings / $numOfUsers;
                                $ratio_format_2dec = format_2dec($ratio);
                                echo " " . $value . " bookings and an average of " . $ratio_format_2dec;
                            }
                        }
                        ?> bookings per user we are trending in the right direction!
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Revenue</h4>
                    <p class="text-muted">
                        Our company has a strong revenue stream,
                        which is put towards enhancing customer experience.
                        We use our revenue to maintain and upgrade vehicles,
                        as well as continue to operate with the most affordable prices
                        in the market. We also take part in donating to
                        local charities and sponsor events within the community.<br>
                        Total Revenues:
                        <?php


                        $sql = "SELECT SUM(Price) FROM Rentals";
                        $query = mysqli_query($connection, $sql);
                        while ($row = $query->fetch_assoc()) {
                            foreach ($row as $key => $rev) {
                                echo format_money($rev);
                            }
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4" style="margin: 0 0 0 auto;">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-credit-card fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Affordability</h4>
                    <p class="text-muted">
                        We offer top of the line vehicles for affordable costs!
                        We have some of the best luxury car rental rates in the
                        market, and are willing to match the prices of our competitors
                        (conditions apply). Rent with us to ensure that you get
                        the best vehicle for the best value!<br>Here are the vehicles that
                        are priced below our average price of <?php
                                                                $sql = "SELECT AVG(price) FROM vehicle";
                                                                $query = mysqli_query($connection, $sql);
                                                                while ($row = $query->fetch_assoc()) {
                                                                    echo format_money($row['AVG(price)']);
                                                                }
                                                                ?>:
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">Make</td>
                                <td scope="col">Model</td>
                                <td scope="col">Price</td>
                            </tr>
                        </thead>
                        <tbody><?php
                                $sql = "SELECT * FROM belowAvgPrice";
                                $query = mysqli_query($connection, $sql);
                                while ($row = $query->fetch_assoc()) {
                                    echo "<tr scope='row'><td>" . $row['Make'] . "</td><td>" . $row['Model'] . "</td><td>$" . $row['Price'] . "</td></tr>";
                                }
                                ?>
                        </tbody>
                    </table>
                    </p>

                </div>
                <div class="col-md-4" style="margin: 0 auto;overflow: hidden scroll;max-height:700px;">
                    <a class="twitter-timeline" href="https://twitter.com/NormsCarRental/lists/1463734091048792064?ref_src=twsrc%5Etfw">A Twitter List by NormsCarRental</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <div class="col-md-4" style="margin: 0 auto 0 0;">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Vehicle Selections</h4>
                    <p class="text-muted">
                        What sets us apart from the rest is our wide selection of vehicles.
                        We offer vehicles such as the
                        <?php
                        $sql = "SELECT * FROM Vehicle";
                        $query = mysqli_query($connection, $sql);
                        while ($row = $query->fetch_assoc()) {
                            echo $row['Make'] . " " . $row['Model'] . ", ";
                        }
                        ?>and more!
                        Our inventory is always evolving and new vehicles
                        are added weekly.
                    </p>
                    <a class="btn btn-primary text-uppercase text-dark" style="border-color: var(--bs-dark);" href="#pricing">
                        Book Now!
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="pricing">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Pricing</h2>
                <h3 class="section-subheading text-muted">Our luxury cars can be rented at some of the best prices you can find! In fact, at NORM's we provide you with the best rates guarantee. This means that we will match or beat the price of any valid competitors in the market. Renting a car with us is simply the best idea for the best price.</h3>
            </div>
            <div class="row" style="margin:0.5rem auto">
                <?php
                $sql = "SELECT * FROM Vehicle";
                $query = mysqli_query($connection, $sql);
                while ($row = $query->fetch_assoc()) {
                    $yrmakemodel = $row['Yr'] . " " . $row['Make'] . " " . $row['Model'];
                    $col = $row['Color'];
                    switch ($col . " " . $yrmakemodel) {
                        case 'Black 2021 Audi RS7':
                            $id = "bl21AUrs7";
                            break;
                        case 'Silver 2019 BMW X5M':
                            $id = "si19BMWx5m";
                            break;
                        case 'Grey 2021 Mercedes Maybach S580':
                            $id = "gr21MEmay";
                            break;
                        case 'White 2020 Rolls Royce Ghost':
                            $id = "wh20RRgh";
                            break;
                        case 'Red 2021 Porsche Taycan Turbo':
                            $id = "re21POtt";
                            break;
                        case 'Black 2022 Lamborghini Aventador SVJ':
                            $id = "bl22LAsvj";
                            break;
                    }
                    $price = $row['Price'];


                    echo
                    '<div class="col-md-4 mb-2 mt-3">
                    <!-- Portfolio item 1-->
                        <div class="portfolio-item shadow pt-0 ">
                            <a class="portfolio-link"  data-bs-toggle="modal" href="#' . $id . '">
                            <img class="img card-img"  src="assets/img/inventory/' . $id . '.jpg" alt="..." />
                            <div class="portfolio-caption">
                                <div class="row p-2">
                                <div class="col-md-10">
                                <p class="portfolio-caption-heading">' . $col . " " . $yrmakemodel . '</p>
                                <p class="portfolio-caption-subheading text-muted">$' . $price . ' per day</p>
                                </div>
                                <div class="col-md-2 pr-2">
                                <div class="portfolio-hover justify-content-center">
                                    <div class="portfolio-hover-content mx-2"><i class="fas fa-plus fa-2x"></i></div>
                                </div>
                                </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="portfolio-modal modal fade" id="' . $id . '" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-0 m-0">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project details-->
                                <h2 class="text-uppercase">' . $col . " " . $yrmakemodel . '</h2><hr>
                                <img class="img-fluid d-block mx-auto" src="assets/img/inventory/' . $id . '.jpg" alt="..." />
                                <ul class="list-inline">
                                <li>
                                <strong>Condition: </strong>
                                ' . $row['vehicle_condition'] . '
                                </li>
                                <li>
                                <strong>Number of seats: </strong>
                                ' . $row['Seat_Num'] . '
                                </li>
                                <li>
                                        <strong>Mileage: </strong>
                                        ' . $row['Mileage'] . ' km
                                    </li>
                                    <li>
                                        <strong>Price: </strong>
                                        ' . format_money($price) . '
                                    </li>
                                </ul>
                                <div class="accordion mb-3" id="accordion"><div class="accordion-item">
                                <h2 class="accordion-header" id="header">
                                <button class="btn btn-primary btn-xl text-uppercase accordion-button collapsed"  type="button" data-bs-toggle="collapse" data-bs-target="#reserve" aria-expanded="true" aria-controls="reserve">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Reserve
                            </button>
                            </h2>
                            <div id="reserve" class="accordion-collapse collapse" aria-labelledby="header" data-bs-parent="#accordion" style="transition: 0.5s ease-in-out;">
                            <div class="container accordion-body">
                            <!-- get rental info: pickup,dropoff, calcualte vehicle price,location(dropdown), vehicle number card num-->
                            <form class="form-horizontal" action="reserve.php" method="POST">
                                <div class="form-group">
                                    <div class="row justify-content-center my-2"><label class="col-md-3 control-label text-end p-2" for="fname">Name:</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center my-3">
                                        <label class="col-md-3 control-label text-end p-2" for="email">Email:</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center my-3">
                                        <label class="col-md-3 control-label text-end p-2" for="pn">Phone #:</label>
                                        <div class="col-md-9">
                                            <input type="tel" class="form-control" id="pn" placeholder="XXX-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="pn" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row justify-content-center my-2">
                                        <label class="col-md-3 control-label text-end p-2" for="dln">Driver\'s License #:</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="dln" placeholder="X-" name="dln" required>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group">
                                    <div class="row justify-content-center my-2">
                                        <label class="col-md-2 control-label text-start px-3">Address:</label>
                                        <div class="col-md-10 "></div>
                                        </div><div class="row justify-content-center my-2">
                                            <div class="col-md-4 p-1"><input type="text" class="form-control" id="st" placeholder="Street Address" name="st" required ></div>
                                            <div class="col-md-2 p-1"><input type="text" class="form-control" id="city" placeholder="City" name="city" required ></div>
                                            <div class="col-md-2 p-1"><input type="text" class="form-control" id="prov" placeholder="Province/State" name="prov" required ></div>
                                            <div class="col-md-2 p-1"><input type="text" class="form-control" id="country" placeholder="Country" name="country" required ></div>
                                            <div class="col-md-2 p-1"><input type="text" class="form-control" id="postal" placeholder="PostalCode" name="postal" required ></div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="row justify-content-center my-2">
                                        <label class="col-md-3 control-label text-center p-2" for="pickup">Pickup Date:</label>
                                        <div class="col-md-3">
                                            <input type="date" class="form-control" id="pickup' . $id . '" placeholder="PICKUP" onchange="setPrice(\'' . $id . '\',' . $price . ')" name="pickup">
                                        </div>
                                        <label class="col-md-3 control-label text-center p-2" for="dropoff">Drop Date:</label>
                                        <div class="col-md-3">
                                            <input type="date" class="form-control" id="dropoff' . $id . '" placeholder="DROPOFF" onchange="setPrice(\'' . $id . '\',' . $price . ')" name="dropoff">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="row justify-content-center my-2">
                                        <label class="col-md-2 control-label text-center p-2" for="ccn">Card Details:</label>
                                        <div class="col-md-4">
                                        <input id="ccn" name="ccn" class="form-control" type="text" maxlength="16" placeholder="xxxx xxxx xxxx xxxx" required>
                                        </div>
                                        <div class="col-md-3">
                                        <input id="cvv" name="cvv" class="form-control" type="text" maxlength="3" placeholder="CVV" required>
                                        </div>
                                        <div class="col-md-3">
                                        <input id="expiry" name="expiry" type="date" class="form-control" placeholder="Expiry" required>
                                        </div>
                                        </div>
                                        </div>
                                        <br>
                                <div class="form-group">
                                <div class="row justify-content-end my-2">
                                
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="carName' . $id . '" name="vehicleName" readonly value="' . $col . ' ' . $yrmakemodel . '">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="hidden" class="form-control" id="carID' . $id . '" name="vehicleID" readonly value=' . $row['Vehicle_ID'] . '>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="numeric" class="form-control" id="price' . $id . '" name="cost" readonly value=0.00>
                                    </div>
                                <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary text-uppercase text-white" style="width:100%">Pay Now</button>
                                    </div></div>
                                </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            
                            </div>
                                

                                <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                    <i class="fas fa-times me-1"></i>
                                    Back
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- About-->
    <section class="page-section about" id="about">
        <div class="about-bg"></div>
        <div class="container">
            <div class="text-center p-3 " style="opacity: 1;">
                <h2 class="section-heading text-uppercase ">About</h2>
                <p class="text-dark" style="font-size: larger;">Nothing feels more exciting than being behind the
                    wheel of a luxurious vehicle. Driving around in an elegant
                    and powerful vehicle speaks class. Unfortunately,
                    not many individuals have the ability to experience
                    this due to the big price tag associated with these
                    machines. This is precisely why we founded a
                    modernized and revolutionary luxury car rental
                    business, NORM's. A car is nothing without a driver,
                    similarly, our customers are what drives us.
                    We put you in the driver seat so that you can
                    seamlessly rent a car of your dreams within minutes.
                    Our prices are the best in the market and our system
                    is powerful, easy to use, and very secure. Not only
                    do we offer some of the best prices in the market,
                    we are also very high on customer care and satisfaction.
                    We offer great flexibility and customer support is our top priority.</p>
            </div>
        </div>
    </section>
    <!-- Team-->
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                <h3 class="section-subheading text-muted">Our associates and operators share our goals and visions for the brand, and are keen on providing the best service to our valuable customers. Our team is committed to the success of the business while keeping customer satisfaction as the top priority.</h3>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/rod_blur.jpg" alt="..." onmouseover="mouseover(id,true)" onmouseout="mouseover(id,false)" id="rod" />
                        <h4>Rodaba Ebadi</h4>
                        <p class="text-muted">100708585</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/niv_blur.jpg" alt="..." onmouseover="mouseover(id,true)" onmouseout="mouseover(id,false)" id="niv" />
                        <h4>Nivetha Gnaneswaran</h4>
                        <p class="text-muted">100695935</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/mun_blur.jpg" alt="..." onmouseover="mouseover(id,true)" onmouseout="mouseover(id,false)" id="mun" />
                        <h4>Munazza Fahmeen</h4>
                        <p class="text-muted">100701595</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4" style="margin: 0 0 0 auto;">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/owa_blur.jpg" alt="..." onmouseover="mouseover(id,true)" onmouseout="mouseover(id,false)" id="owa" />
                        <h4>Owais Quadri</h4>
                        <p class="text-muted">100697281</p>
                    </div>
                </div>
                <div class="col-lg-4" style="margin: 0 auto 0 0;">
                    <div class="team-member">
                        <img class="mx-auto rounded-circle" src="assets/img/team/san_blur.jpg" alt="..." onmouseover="mouseover(id,true)" onmouseout="mouseover(id,false)" id="san" />
                        <h4>Sanzir Anarbaev</h4>
                        <p class="text-muted">100704172</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>

</html>