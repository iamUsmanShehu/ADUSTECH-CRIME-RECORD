<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_attendance_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $name = $_POST["name"];
    $command = escapeshellcmd("python capture_fingerprint.py '$student_id' '$name'");
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thumbprint Attendance System</title>
</head>
<body>
    <h1>Register Student</h1>
    <form method="post" action="index.php">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
