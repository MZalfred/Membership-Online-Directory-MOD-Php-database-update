<?php

require_once 'db.php';

$payload = @file_get_contents('php://input');
$event = null;

try {
    $event = json_decode($payload);
} catch(Exception $e) {
    http_response_code(400);
    exit();
}

// Verify the event by checking its type or using a verify function provided by the payment gateway
if ($event->type == 'payment_intent.succeeded') {
    $memberEmail = $event->data->object->customer_email;
    $newExpiryDate = date('Y-m-d', strtotime('+1 year')); // Set new expiry date to one year from now

    // Update member's expiry date in the database
    $stmt = $conn->prepare("UPDATE members SET membership_expiry = ? WHERE email = ?");
    $stmt->bind_param("ss", $newExpiryDate, $memberEmail);
    $stmt->execute();
}

http_response_code(200);

?>