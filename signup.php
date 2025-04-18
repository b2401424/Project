<?php
require "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];
    $gender = $_POST["gender"];

    $usernameError = $emailError = $passwordError = $lengthError = "";

    // Check if username already exists using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $usernameError = "Username already taken. Please choose another one.";
    }
    $stmt->close();

    // Check if email already exists using a prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $emailError = "This email is already taken.";
    }
    $stmt->close();

    if(strlen($password) < 8) {
        $lengthError = "Password must be at least 8 characters long.";
    } else if($password !== $confirmPassword) {
        $passwordError = "Passwords do not match.";
    }

    // If no errors, register user into the database using a prepared statement
    if($usernameError == '' && $emailError == '' && $passwordError == '' && $lengthError == '') {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, fullName, email, tel, gender) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $hash, $fullName, $email, $tel, $gender);
        if($stmt->execute()) {
            header("Location: login.php");
            exit();
        } 
        else {
            echo "Error: " .$conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpUniMasterclass Sign Up</title>
    <link href="formStyle.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>HelpUniMasterclass Sign Up</h2>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <?php if(isset($usernameError)) {
                echo "<p class='error'>$usernameError</p>"; }
            ?>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <?php if(isset($lengthError)) {
                echo "<p class='error'>$lengthError</p>"; }
            ?>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
            <?php if(isset($passwordError)) {
                echo "<p class='error'>$passwordError</p>"; }
            ?>

            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <?php if(isset($emailError)) {
                echo "<p class='error'>$emailError</p>"; }
            ?>
            
            <label for="tel">Phone Number:</label>
            <input type="tel" id="tel" name="tel">
            
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            
            <input type="submit" value="Sign up">
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </form>
    </div>
</body>
</html>