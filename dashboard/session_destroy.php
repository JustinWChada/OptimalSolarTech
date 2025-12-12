<?php
if (!empty($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != $_SERVER['REQUEST_URI']) {
    http_response_code(403);
    $previousDir = dirname(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH));
    $currentDir = dirname($_SERVER['REQUEST_URI']);

    echo $previousDir;
    echo $currentDir;
    
    if ($previousDir !== $currentDir) {
        echo $_SERVER['REQUEST_URI'];
        exit('Forbidden Access');
    }
}

session_start();
session_destroy();
header('Location: ../pages/signin.php');
exit;

