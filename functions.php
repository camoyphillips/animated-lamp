<?php
session_start();

function secured() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

function connectDB() {
    $host = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'traffic_data';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function loginUser($username, $password) {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }

    return false;
}

function logoutUser() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}
