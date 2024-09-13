<?php
$command = escapeshellcmd("python verify_fingerprint.py");
$output = shell_exec($command);
echo "<pre>$output</pre>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Thumbprint</title>
</head>
<body>
    <h1>Verify Suspect</h1>
    <form method="post" action="verify.php">
        <input type="submit" value="Verify">
    </form>
</body>
</html>
