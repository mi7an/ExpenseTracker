<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include("db_connection.php");
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $targeted_amount = $_POST["targamt"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, '@gmail.com') === false) {
        echo "Invalid email address. Please use a Gmail address.";
        exit(); 
    }

    if (strlen($password) < 5) {
        echo "Password must contain at least 5 characters.";
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (name, email, password, targeted_amount) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $targeted_amount);

    if ($stmt->execute()) {
        
        header("Location: index.html");
        exit(); 
    } else {
       
        echo "Registration failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>
