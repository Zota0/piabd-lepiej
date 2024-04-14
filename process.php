<?php
session_start(); // Start the session

// Database connection and configuration
$config = parse_ini_file(__DIR__.'/config.cfg');
$mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SignUp function
// SignUp function
function signUp($username, $email, $phone, $password, $birthdate) {
    global $mysqli;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO account (username, email, phone, password, birthdate) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $birthdate);
    $stmt->execute();
    $stmt->close();
}

// LogIn function
function logIn($username, $password) {
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT password FROM account WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Set session variable
            return true; // Login successful
        }
    }
    return false; // Login failed
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    
    if ($action == "signup") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $birthdate = $_POST['birthdate'];

        // Sign up user
        signUp($username, $email, $phone, $password, $birthdate);
        
        // Redirect to login page
        header("Location: index.php");
        exit;
    } elseif ($action == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Check login
        if (logIn($username, $password)) {
            // Redirect to add comment page
            header("Location: comments.php");
            exit;
        } else {
            // Redirect back to login page with error message
            header("Location: index.php?error=1");
            exit;
        }
    }
}
?>
