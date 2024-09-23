<?php
require_once('dbconnect.php');

session_start();

// checking if inputs are not empty
if (isset($_SESSION['username']) && isset($_POST['flight_id']) && isset($_POST['ticket_number']) && isset($_POST['price']) && isset($_POST['seat_number']) && isset($_POST['class'])) {
                
    $username = $_SESSION['username'];
    $flightId = $_POST['flight_id'];
    $ticketNumber = $_POST['ticket_number'];
    $price = $_POST['price'];
    $seat_number = $_POST['seat_number'];
    $class = $_POST['class'];
	
	// Perform SQL INSERT into booked_flights table
    $insertSql = "INSERT INTO booked_flights (username, flight_id, ticket_number, price, seat_number, class) VALUES ('$username', '$flightId', '$ticketNumber', '$price', '$seat_number', '$class')";
    $deletesql = "DELETE FROM tickets WHERE ticket_number = '$ticketNumber'";
    $updatesql = "UPDATE flights SET capacity = capacity, booked = booked+1 WHERE flight_id = '$flightId'";
    $conn->query($insertSql);
    $conn->query($deletesql);
    $conn->query($updatesql);
    

    // Close the MySQLi connection
    $conn->close();

    header("Location: bookings.php");
} else {

    echo 'Invalid data received.';
}

?>