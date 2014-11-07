<?php
/**
 * Created by PhpStorm.
 * User: rayfa_000
 * Date: 10/30/2014
 * Time: 2:34 PM
 */
session_start();
// Create connection
$link = mysqli_connect("engr-cpanel-mysql.engr.illinois.edu","uicookbo_develop","password","uicookbo_main");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Sanitize incoming username and password
$identity = filter_var($_GET['identityToken'], FILTER_SANITIZE_STRING);
$password = filter_var($_GET['password'], FILTER_SANITIZE_STRING);
$password = hash('sha256', $password);

// Determine whether an account exists matching this username and password
$statement = $link->prepare("SELECT email FROM users WHERE ( username = ? OR email = ?) and password = ?");

// Bind the input parameters to the prepared statement
$statement->bind_param('sss', $identity, $identity, $password);

// Execute the query
$statement->execute();

// Store the result so we can determine how many rows have been returned
$statement->store_result();

if ($statement->num_rows == 1) {
    $statement->bind_result($value);
    $result = $statement->fetch();
    $_SESSION['userEmail'] = $value;
    $statement->free_result();
    $statement->close();
    header("Location: home.php");
    return;
}
$statement->free_result();
$statement->close();
header("Location: signin.php?status=fail");