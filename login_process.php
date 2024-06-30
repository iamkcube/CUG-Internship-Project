<?php
session_start();

// Include database connection script
include 'db_connect.php';

// Retrieve form data
$user_email = $_POST['email'];
$user_password = $_POST['password'];
// Hash the password using SHA-256
$hashed_password = hash('sha256', $user_password);

// Prepare and execute SQL statement
$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_email, $hashed_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();
    // Set session variable
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    // Redirect based on role
    if ($user['role'] == 'admin') {
        header("Location: admin-page.html");
    } else if ($user['role'] == 'dealer') {
        header("Location: dealer-page.html");
    } else {
        // Unexpected role
        echo "Error: Unexpected role.";
    }
} else {
    // Invalid credentials
    $_SESSION['errorMessage'] = "Invalid email or password! Please try again.";
    header("Location: login.php");
    exit();
}

// Close connections
$stmt->close();
$conn->close();
?>
