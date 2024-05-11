<?php
    session_start(); 

    
    $config = parse_ini_file(__DIR__.'/config.cfg');
    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database'], $config['port']);

    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    
    function signUp($username, $email, $phone, $password, $birthdate) {
        global $mysqli;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $mysqli->prepare("INSERT INTO account (username, email, phone, password, birthdate) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $birthdate);
        $stmt->execute();
        $stmt->close();
    }

    
    function logIn($username, $password) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT password FROM account WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username; 
                return true; 
            }
        }
        return false; 
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST['action'];
        
        if ($action == "signup") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $birthdate = $_POST['birthdate'];

            
            signUp($username, $email, $phone, $password, $birthdate);
            
            
            header("Location: index.php");
            exit;
        } elseif ($action == "login") {
            $username = $_POST['LogInUsername'];
            $password = $_POST['LogInPassword'];
            
            
            if (logIn($username, $password)) {
                
                header("Location: comments.php");
                exit;
            } else {
                
                header("Location: index.php?error=1");
                exit;
            }
        }
    }
?>
