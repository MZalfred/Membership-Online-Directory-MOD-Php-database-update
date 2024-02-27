<?php

// Include the database connection file
require_once 'db.php';

// Calculate the date 2 weeks from now
$two_weeks = date('Y-m-d', strtotime('+2 weeks'));

// Select members whose membership expires in 2 weeks
$query = "SELECT email FROM members WHERE membership_expiry = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $two_weeks);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $to = $row['email'];
    $subject = "Membership Renewal Reminder";
    $message = "Dear Member, your membership is due for renewal in two weeks. Please visit our site to renew.";
    $headers = "From: no-reply@yourdomain.com";

    mail($to, $subject, $message, $headers);
}

// Close the statement and database connection
$stmt->close();
$conn->close();

?>
