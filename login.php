<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include("db_connection.php");

    
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $query = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            header("Location: dashboard.html");
            exit(); 
        } else {
            
            echo "Invalid password. Please try again.";
        }
    } else {
        
        echo "User not found. Please register first.";
    }

    
    $stmt->close();
    $conn->close();
}
?>
