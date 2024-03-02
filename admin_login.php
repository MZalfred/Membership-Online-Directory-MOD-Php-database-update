<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // This is a simple example; in a real scenario, use prepared statements
    $result = $conn->query("SELECT * FROM admin_users WHERE username = '$username'");

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Successful login
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
            exit;
        }
    }

    echo "Invalid login credentials.";
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Login">
</form>
