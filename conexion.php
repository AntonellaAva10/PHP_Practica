<?php
    $con = new mysqli("localhost", "root", "", "deportes");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        echo "Connected successfully";
    }
    $con->set_charset("utf8");