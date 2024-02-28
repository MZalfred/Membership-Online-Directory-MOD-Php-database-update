<?php

// Include the database connection file
require_once 'db.php';

// Calculate the date 14 days (2 weeks) from now
$targetDate = date('Y-m-d', strtotime('+14 days'));

// Calculate the date 14 days (2 weeks) from now
$targetDate = date('Y-m-d', strtotime('+14 days'));

// Prepare a SQL statement to select users whose memberships expire in 14 days
$stmt = $conn->prepare("SELECT email FROM members WHERE membership_expiry = ?");
$stmt->bind_param("s", $targetDate);
$stmt->execute();
$result = $stmt->get_result();

// Use PHPMailer or the mail() function for email sending
// For simplicity, this example uses mail()
while ($member = $result->fetch_assoc()) {
    $to = $member['email'];
    $subject = "Membership Renewal Reminder";
    $message = "Your membership is expiring soon. Please renew to continue enjoying our services.";
    $headers = "From: no-reply@yourdirectory.com";

    mail($to, $subject, $message, $headers);
}

$stmt->close();
$conn->close();
?>
