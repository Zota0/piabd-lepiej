

<?php
    $config = parse_ini_file(__DIR__.'/config.cfg');
    $mysqli = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);


    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }


    $username = $_POST['username'];


    $sql = "SELECT * FROM account WHERE username = '$username'";


    $result = $mysqli->query($sql);


    if ($result->num_rows > 0) {
        echo "true";
    } else {
        echo "false";
    }


    $mysqli->close();
?>
