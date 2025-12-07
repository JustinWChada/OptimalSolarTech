<?php

$OstUsersConn = new mysqli("localhost", "root", "", "ost_users");

if ($OstUsersConn->connect_error) {
    die("Connection failed: " . $OstUsersConn->connect_error);
}

?>