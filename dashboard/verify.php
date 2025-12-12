<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['session_id']) || !isset($_SESSION['user_id'])) {
    header('Location: session_destroy.php');
    exit;
}

if(isset($_POST["cookie_session_id"])) {

    $cookie_session_id = $_POST['cookie_session_id'];
    $session_id = $_SESSION['session_id'];

    if($cookie_session_id != $session_id) {
        header('Location: session_destroy.php');
        exit;
    }
}