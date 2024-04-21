
<title>Czekaj, wylogowywanie się...</title>
<h1>Czekaj, wylogowywanie się...</h1>

<?php


    session_destroy();
    session_unset();
    header('location:index.php');


?>