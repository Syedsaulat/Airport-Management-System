<?php
// First of all, we need to connect to the database
require_once('dbconnect.php');

// We need to check if the input in the form textfields is not empty
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['passport']) && isset($_POST['nid']) && isset($_POST['date_of_birth']) && isset($_POST['city']) && isset($_POST['country']) && isset($_POST['phone_no']) && isset($_POST['email']) && isset($_POST['password'])){
    // Store form inputs in variables
    $f = $_POST['first_name'];
    $l = $_POST['last_name'];
    $u = $_POST['username'];
    $p1 = $_POST['passport'];
    $n = $_POST['nid'];
    $d = $_POST['date_of_birth'];
    $c1 = $_POST['city'];
    $c2 = $_POST['country'];
    $p2 = $_POST['phone_no'];
    $e = $_POST['email'];
    $p3 = $_POST['password'];

    // Check if the username already exists in the admin_id column of the admins table
    $checkSql = "SELECT * FROM admins WHERE admin_id = '$u'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username already exists in the admins table. Please choose a different username.";
    } else {
        // Write the query to insert data into the users table
        $sql = "INSERT INTO users VALUES ('$f', '$l', '$u', '$p1', '$n', '$d', '$c1', '$c2', '$p2', '$e', '$p3')";
        
        // Execute the query 
        $result = mysqli_query($conn, $sql);
        
        // Check if the insertion is successful
        if(mysqli_affected_rows($conn)){
            //echo "Inserted Successfully";
            header("Location: login.html");
        } else {
            //echo "Insertion Failed";
            header("Location: signup.html");
        }
    }
}
?>