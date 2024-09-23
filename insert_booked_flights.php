<?php
require_once('dbconnect.php');

// Insertion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['busername']) && isset($_POST['bflight_id']) && isset($_POST['bticket_number']) && isset($_POST['bprice']) && isset($_POST['bseat_number']) && isset($_POST['bclass'])) {
    $u = $_POST['busername'];
    $p = $_POST['bflight_id'];
    $c = $_POST['bticket_number'];
	$a = $_POST['bprice'];
	$b = $_POST['bseat_number'];
	$d = $_POST['bclass'];

    $sql = "INSERT INTO booked_flights VALUES ('$u', '$p', '$c', '$a', '$b', '$d')";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Insertion successful
        header("Location: booked_flights.html");
    } else {
        echo "Insertion Failed: " . $conn->error;
    }
}

// Deletion
if (isset($_GET['bticket_number'])) {
    $ticketNumber = $_GET['bticket_number'];

    // SQL query to delete a row from the "booked_flights" table based on the ticket_number
    $sql = "DELETE FROM booked_flights WHERE ticket_number = '$ticketNumber'";

	$sql0 = "SELECT * FROM booked_flights WHERE ticket_number = '$ticketNumber'";
	$resultCheckTicket = $conn->query($sql0);
	if ($resultCheckTicket->num_rows > 0) {
		$row = $resultCheckTicket->fetch_assoc();
		$flightId = $row['flight_id'];
		$price = $row['price'];
		$seatNumber = $row['seat_number'];
		$class = $row['class'];

		$sql1 = "INSERT INTO tickets VALUES ('$ticketNumber', '$flightId', '$price', '$seatNumber', '$class')";
		$conn->query($sql1);

		$sql2 = "UPDATE flights SET capacity = capacity, booked = booked - 1 WHERE flight_id = '$flightId'";
		$conn->query($sql2);

		// echo "Booking canceled successfully!";
	}

	$result = $conn->query($sql);

    if ($result === TRUE) {
        // Deletion successful
        header("Location: booked_flights.html");
    } else {
        echo "Error deleting row: " . $conn->error;
    }
} 

$conn->close();
?>