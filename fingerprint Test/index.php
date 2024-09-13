<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "murja_fingerprint_test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suspect_id = $_POST["suspect_id"];
    $name = $_POST["name"];
    $command = escapeshellcmd("python capture_fingerprint.py '$suspect_id' '$name'");
    $output = shell_exec($command);
    echo "<pre>$output</pre>";
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<body>
    <h1>Register suspect</h1>
    <form method="post" action="index.php">
        <label for="suspect_id">Suspect ID:</label>
        <input type="text" id="suspect_id" name="suspect_id"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
