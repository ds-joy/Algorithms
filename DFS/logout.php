
<?php
    session_start();
    unset($_SESSION['loggedIn']);
    session_destroy();
    header('Location: dfs.php');
    exit();
?>