<?php
session_start();
include('db.php');

$admin_email = "admin@example.com";
$admin_password = "adminpassword";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if admin credentials match
    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['user_id'] = "admin";
        $_SESSION['role'] = "admin";
        header("Location: admin_dashboard.php");
        exit;
    }

    // Prepare SQL for normal users
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "<script>alert('Invalid credentials. Try again!'); window.location.href='login.php';</script>";
        }
        $stmt->close();
    } else {
        die("SQL Error: " . $conn->error);
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
