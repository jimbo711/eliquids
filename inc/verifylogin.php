<?php

include 'connect.php';

// Get user input
$username = $_POST['username'];
$password = $_POST['password'];

// change chars from html to equiv
$username = htmlspecialchars($username);

// prevent sql injection
$username = mysqli_real_escape_string($conn, $username);

// approved yes/no
$approved = false;

// query all rows from users table
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql) 
        or die("users query failed: ".mysqli_error($conn));
// Make them into an array and loop through
while ($row=mysqli_fetch_array($result)) {
    // store values from DB
    $stored_username = $row['user_email'];
    $stored_password = $row['user_pwd'];

    // Verify password
    $correctpass = password_verify($password, $stored_password);

    // If username entered matches with a row in DB
    //      AND password has been verified
    if ($username == $stored_username && $correctpass) {
        $approved = true;
    }
}

// Once approved, take user to homepage
if ($approved) {
    // Also create a login cookie
    setcookie("login", true, time() + (86400), "/"); // 86400 = 1 day
    header('Location: ../index.php');
} else {
    // Otherwise, back to the login page.
    header('Location: ../login.php');
}

?>