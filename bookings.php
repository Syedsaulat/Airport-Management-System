<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

require_once('dbconnect.php');

$username = $_SESSION['username'];

// SQL query to retrieve booked flights for the logged-in user
$sql = "SELECT * FROM `booked_flights` WHERE username = '$username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        .result-container {
            text-align: center;
            margin-top: 200px; 
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- MENU -->
    <style>
        .navbar-custom .navbar-nav-first>li>a:hover,
        .navbar-custom .navbar-nav-first>li.active>a {
            color: #fff !important;
            background-color: #000 !important;
        }

        .navbar-custom {
            border-color: #000 !important;
            border: none !important;
        }
    </style>

    <section class="navbar custom-navbar navbar-fixed-top navbar-custom" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-nav-first">
                    <li><a href="flights.html">Flights</a></li>
                    <li class="active"><a href="bookings.php">Bookings</a></li>
                    <li><a href="profile.html">Profile</a></li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Display Booked Flights Table -->
    <div class="container result-container" style="margin-top: 5px; margin-bottom: 80px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Flight ID</th>
                    <th>Ticket Number</th>
                    <th>Price</th>
                    <th>Seat Number</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["flight_id"]; ?></td>
                        <td><?php echo $row["ticket_number"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><?php echo $row["seat_number"]; ?></td>
                        <td><?php echo $row["class"]; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>
