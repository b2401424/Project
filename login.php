<?php
require "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Checks if credentials are valid using a prepared statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } else {
            $invalidInput = "Invalid username or password!";
        }
    } else {
        $invalidInput = "Invalid username or password!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpUniMasterclass Login</title>
    <link href="formStyle.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>HelpUniMasterclass Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if(isset($invalidInput)) {
                echo "<p class='error'>$invalidInput</p>"; }
            ?>
            
            <input type="submit" value="Log in">
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </form>
    </div>
</body>
</html>