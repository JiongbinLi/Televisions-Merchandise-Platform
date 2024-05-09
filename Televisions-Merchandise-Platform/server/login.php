<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db_connect.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']); 
    

    $sql = "SELECT id, username, password, email FROM users WHERE username = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                header("location: ../pages/index.php"); 
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with that username.";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
