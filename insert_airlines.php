<?php
require_once('dbconnect.php');

// Insertion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $airline_name = $_POST['airline_name'];
    $no_of_planes = $_POST['no_of_planes'];
    $no_of_pilots = $_POST['no_of_pilots'];

    // SQL query to insert a new row into the "airlines" table
    $insertSql = "INSERT INTO airlines (airline_name, no_of_planes, no_of_pilots) VALUES ('$airline_name', '$no_of_planes', '$no_of_pilots')";
    $result = $conn->query($insertSql);

    if ($result === TRUE) {
        // Insertion successful
        header("Location: airlines.html");
    } else {
        echo "Error inserting row: " . $conn->error;
    }
} else {
    echo "Form data not submitted.";
}

// Deletion
if(isset($_GET['airline_name'])) {
    $airline_name = $_GET['airline_name'];

    // SQL query to delete a row from the "airlines" table based on the airline_name
    $deleteSql = "DELETE FROM airlines WHERE airline_name = '$airline_name'";
    $result = $conn->query($deleteSql);

    if ($result === TRUE) {
        // Deletion successful
        header("Location: airlines.html");
    } else {
        echo "Error deleting row: " . $conn->error;
    }
} 

// Close connection
$conn->close();
?>