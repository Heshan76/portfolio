<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('db_config.php'); // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        // Redirect with error message
        header("Location: contact_form.php?error=" . urlencode("All fields are required"));
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect with error message
        header("Location: contact_form.php?error=" . urlencode("Invalid email format"));
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contact_form_data (name, email, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        // Provide detailed error information
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to thank you page
        header("Location: thank_you.html");
    } else {
        // Redirect with error message
        header("Location: contact_form.php?error=" . urlencode("Could not submit the form. Please try again later. " . $stmt->error));
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


