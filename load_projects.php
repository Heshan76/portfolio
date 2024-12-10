<!-- load_project.php -->
<?php
include('db_config.php'); // Include your database configuration file

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch projects
$sql = "SELECT * FROM projects";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    // Fetch all projects into an associative array
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
} else {
    echo "No projects found.";
}

// Close the database connection
$conn->close();

// Return the projects as JSON
echo json_encode($projects);
?>
