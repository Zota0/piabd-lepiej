<?php
    session_start(); 

    
    $config = parse_ini_file(__DIR__.'/config.cfg');
    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database'], $config['port']);

    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    
    function getComments() {
        global $mysqli;
        $result = $mysqli->query("SELECT * FROM comments ORDER BY CREATIONDATE DESC");
        $comments = array();
        while ($row = $result->fetch_assoc()) {
            
            if (!empty($row['DISPLAYNAME']) && !empty($row['CONTENT'])) {
                $comments[] = $row;
            }
        }
        return $comments;
    }


    function addComment($username, $comment) {
        global $mysqli;
        if (empty($username)) {
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous';
        }
        $stmt = $mysqli->prepare("INSERT INTO comments (DISPLAYNAME, CONTENT) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $comment);
        $stmt->execute();
        $stmt->close();
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $comment = $_POST['comment'];
        
        
        addComment($username, $comment);

        
        header("Location: comments.php");
        exit;
    }



    
    $comments = getComments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentarze</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Dodaj swój komentarz</h2>
        <form action="comments.php" method="post">
            <input type="text" name="username_display" id='username_display' value='<?php echo $_SESSION['username']; ?>' readonly>
            <button type="button" name='LogOut_Btn' id='LogOut'>Wyloguj się</button>
            <textarea name="comment" placeholder="Twój komentarz..." id='comment-textarea' required></textarea>
            <button type="submit">Dodaj komentarz</button>
        </form>
        
        <h2>Comments</h2>
        <div class="comments-container">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?= htmlspecialchars($comment['DISPLAYNAME']) ?></strong> - <?= ($comment['CONTENT']) ?></p>
                    <p class="timestamp"><?= htmlspecialchars($comment['CREATIONDATE']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        const LogOut_Btn = document.getElementById('LogOut');
        LogOut_Btn.addEventListener('click', () => {
            sessionStorage.clear();
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>
