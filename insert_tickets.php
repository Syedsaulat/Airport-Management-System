<?php
require_once('dbconnect.php');

// Insertion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['flight_id']) && isset($_POST['ticket_number']) && isset($_POST['price']) && isset($_POST['seat_number']) && isset($_POST['class'])) {
    $u = $_POST['ticket_number'];
    $p = $_POST['flight_id'];
    $c = $_POST['price'];
    $a = $_POST['seat_number'];
    $d = $_POST['class'];

    $sql = "INSERT INTO tickets VALUES ('$u', '$p', '$c', '$a', '$d')";
    $result = $conn->query($sql);

	$updatesql = "UPDATE flights SET capacity = capacity+1, booked = booked WHERE flight_id = '$p'";
	$conn->query($updatesql);


    if ($result === TRUE) {
        // Insertion successful
        header("Location: admin_tickets.html");
    } else {
        echo "Insertion Failed: " . $conn->error;
    }
}

// Deletion
if (isset($_GET['ticket_number'])) {
    $ticketNumber = $_GET['ticket_number'];

    // SQL query to delete a row from the "tickets" table based on the ticket_number
    $sql = "DELETE FROM tickets WHERE ticket_number = '$ticketNumber'";

	$sql0 = "SELECT * FROM tickets WHERE ticket_number = '$ticketNumber'";
	$resultCheckTicket = $conn->query($sql0);
	if ($resultCheckTicket->num_rows > 0) {
		$row = $resultCheckTicket->fetch_assoc();
		$flightId = $row['flight_id'];
		$updatesql = "UPDATE flights SET capacity = capacity-1, booked = booked WHERE flight_id = '$flightId'";
		$conn->query($updatesql);
	}

	$result = $conn->query($sql);

    if ($result === TRUE) {
        // Deletion successful
        header("Location: admin_tickets.html");
    } else {
        echo "Error deleting row: " . $conn->error;
    }
} 

$conn->close();
?>