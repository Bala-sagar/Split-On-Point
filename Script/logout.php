<?php
    session_start();
    $_SESSION['regno'] = '';
    $_SESSION['name'] = '';
    header("Location: ../Pages/Login.html");
?>