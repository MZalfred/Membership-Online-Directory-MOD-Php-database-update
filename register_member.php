<?php
require_once 'db.php'; // Include your database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // Calculate membership start and expiry dates
    $membershipStart = date('Y-m-d'); // Set to current date
    $membershipExpiry = date('Y-m-d', strtotime('+1 year')); // Set to one year from today

    // Prepare SQL statement to prevent SQL injection
    // Updated to include membership_start and membership_expiry fields
    $stmt = $conn->prepare("INSERT INTO members (fullname, email, password, membership_start, membership_expiry, status) VALUES (?, ?, ?, ?, ?, 'active')");
    // Bind parameters including the dates
    $stmt->bind_param("sssss", $fullname, $email, $password, $membershipStart, $membershipExpiry);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
    // Close connection
    $conn->close();
}
?>

