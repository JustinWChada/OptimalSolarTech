<?php

$OstMiscellaneaConn = new mysqli("localhost", "root", "", "ost_miscellanea");

if ($OstMiscellaneaConn->connect_error) {
    die("Connection failed: " . $OstMiscellaneaConn->connect_error);
}

?>