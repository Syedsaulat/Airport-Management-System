<?php

session_start();


require_once('dbconnect.php');

// Check if the form fields are not empty
if (isset($_POST['fname']) && isset($_POST['pass'])) {
    // Get the username and password from the form
    $u = $_POST['fname'];
    $p = $_POST['pass'];

    // Query to check if the username and password exist in the 'users' table
    $sqlu = "SELECT * FROM users WHERE username = '$u' AND password = '$p'";
    
    // Query to check if the username and password exist in the 'admins' table
    $sqla = "SELECT * FROM admins WHERE admin_id = '$u' AND password = '$p'";
    
    $result = mysqli_query($conn, $sqlu);
    $result1 = mysqli_query($conn, $sqla);

    
    if (mysqli_num_rows($result) != 0) {
        
        $_SESSION["username"] = $u;

        header("Location: flights.html");
        exit();
    } 
    
    elseif (mysqli_num_rows($result1) != 0) {
        
        $_SESSION["username"] = $u;

        header("Location: admin_home.html");
        exit();
    } else {
        
        echo "Username or Password is wrong";
        
    }
}

// Close the database connection
mysqli_close($conn);
?>