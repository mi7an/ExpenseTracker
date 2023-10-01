<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    include("db_connection.php");

   
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $targeted_amount = mysqli_real_escape_string($conn, $_POST["targamt"]);

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $query = "INSERT INTO users (name, email, password, targeted_amount) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $targeted_amount);

    if ($stmt->execute()) {
        echo "<script>
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('targamt').value = '';
          </script>";
        
        echo "Registration successful. Redirecting...";
        header("Location: index.html");
        exit(); 
    } else {
        
        echo "Registration failed. Please try again.";
    }

    
    $stmt->close();
    $conn->close();
}
?>
