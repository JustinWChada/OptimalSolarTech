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
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Expires: 0');
header('Pragma: no-cache');

session_start();
session_destroy();
header('Location: ../pages/signin.php');
exit;

