
<?php
    session_start();
    unset($_SESSION['loggedIn']);
    session_destroy();
    header('Location: prims.php');
    exit();
?>