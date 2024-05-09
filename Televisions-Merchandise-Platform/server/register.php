<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db_connect.php';

    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $password, $email);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Now you can login and go shopping!'); window.location.href='../pages/login_page.php';</script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
