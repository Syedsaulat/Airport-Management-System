<?php
// First of all, we need to connect to the database
require_once('dbconnect.php');

// We need to check if the input in the form textfields is not empty
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['admin_id']) && isset($_POST['password'])){
    
    $f = $_POST['first_name'];
    $l = $_POST['last_name'];
    $a = $_POST['admin_id'];
    $p = $_POST['password'];
    
    // Check if the admin_id already exists in the users table
    $checkSql = "SELECT * FROM users WHERE username = '$a'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "Username already exists in the users table. Please choose a different username.";
    } else {
        // Write the query to insert data into the admins table
        $sql = "INSERT INTO admins VALUES ('$f', '$l', '$a', '$p')";
        
        // Execute the query 
        $result = mysqli_query($conn, $sql);
        
        // Check if the insertion is successful
        if(mysqli_affected_rows($conn)){
            // echo "Inserted Successfully";
            header("Location: login.html");
        } else {
            echo "Insertion Failed";
            // header("Location: admin_signup.php");
        }
    }
}
?>