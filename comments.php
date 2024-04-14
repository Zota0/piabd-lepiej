<?php
session_start(); // Start the session

// Include database connection
$config = parse_ini_file(__DIR__.'/config.cfg');
$mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to fetch comments from the database
function getComments() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM comments ORDER BY CREATIONDATE DESC");
    $comments = array();
    while ($row = $result->fetch_assoc()) {
        // Skip comment if DISPLAYNAME or CONTENT is empty
        if (!empty($row['DISPLAYNAME']) && !empty($row['CONTENT'])) {
            $comments[] = $row;
        }
    }
    return $comments;
}

// Function to add a new comment
function addComment($username, $comment) {
    global $mysqli;
    if (empty($username)) {
        $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'anonymous'; // Set username to 'anonymous' if not logged in
    }
    $stmt = $mysqli->prepare("INSERT INTO comments (DISPLAYNAME, CONTENT) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $comment);
    $stmt->execute();
    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    
    // Add comment to database
    addComment($username, $comment);

    // Redirect to the same page to prevent form resubmission
    header("Location: comments.php");
    exit;
}

// Fetch existing comments
$comments = getComments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add Comment</h2>
        <form action="comments.php" method="post">
            <input type="text" name="username_display" id='username_display' value='<?php echo $_SESSION['username']; ?>' readonly>
            <textarea name="comment" placeholder="Your comment" id='comment-textarea' required></textarea>
            <button type="submit">Add Comment</button>
        </form>
        
        <h2>Comments</h2>
        <div class="comments-container">
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?= htmlspecialchars($comment['DISPLAYNAME']) ?></strong> - <?= htmlspecialchars($comment['CONTENT']) ?></p>
                    <p class="timestamp"><?= htmlspecialchars($comment['CREATIONDATE']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
