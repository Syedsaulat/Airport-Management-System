<?php
require_once('dbconnect.php');

// Function to insert a new hangar
function insertHangar($conn, $hangar_id, $capacity) {
    $sql = "INSERT INTO hangar (hangar_id, hangar_capacity)
            VALUES ('$hangar_id', '$capacity')";

    if ($conn->query($sql) === TRUE) {
        echo "Hangar inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to delete a hangar
function deleteHangar($conn, $hangar_id) {
    $sql = "DELETE FROM hangar WHERE hangar_id = '$hangar_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Hangar deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Insert a new hangar
    if (isset($_POST["insert_hangar"])) {
        insertHangar($conn, $_POST["hangar_id"], $_POST["hangar_capacity"]);
    }

    // Delete a hangar
    if (isset($_POST["delete_hangar"])) {
        deleteHangar($conn, $_POST["delete_hangar_id"]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airlines Table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        section {
            padding: 40px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .form_design input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        .form_design input[type="submit"] {
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }

        .form_design input[type="submit"]:hover {
            background-color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>

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
                    <li><a href="admin_home.html">Profile</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li class="active"><a href="hangar.php">Hangars</a></li>
                    <li><a href="pilot.html">Pilots</a></li>
                    <li><a href="airlines.html">Airlines</a></li>
                    <li><a href="admin_tickets.html">Tickets</a></li>
                    <li><a href="booked_flights.html">Bookings</a></li>
                    <li><a href="#">Abir</a></li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- HANGAR TABLE SECTION -->
    <section id="section1">
        <div class="container">
            <div class="title">Hangars Table</div>

            <?php
            $result_hangar = $conn->query("SELECT * FROM hangar");
            if ($result_hangar->num_rows > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'><tr><th>Hangar ID</th><th>Capacity</th></tr>";
                while ($row = $result_hangar->fetch_assoc()) {
                    echo "<tr><td>" . $row["hangar_id"] . "</td><td>" . $row["hangar_capacity"] . "</td></tr>";
                }
                echo "</table>";
                echo "</div>";
            } else {
                echo "0 results";
            }
            ?>
        </div>
    </section>

    <!-- INSERT HANGAR SECTION -->
    <section id="section2">
        <div class="container">
            <div class="title">Add a New Hangar</div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form_design">
                <label for="hangar_id">Hangar ID:</label>
                <input type="text" name="hangar_id" required><br>
                <label for="hangar_capacity">Capacity:</label>
                <input type="number" name="hangar_capacity" required><br>
                <input type="submit" name="insert_hangar" value="Add to Database">
            </form>
        </div>
    </section>

    <!-- DELETE HANGAR SECTION -->
    <section id="section3">
        <div class="container">
            <div class="title">Delete Hangar</div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form_design">
                <label for="delete_hangar_id">Enter Hangar ID to Delete:</label>
                <input type="text" name="delete_hangar_id" required>
                <button type="submit" name="delete_hangar">Delete</button>
            </form>
        </div>
    </section>

    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>