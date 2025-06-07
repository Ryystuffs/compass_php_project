<?php

$host = "localhost";
$dbname = "compass"; 
$username = "root";
$password = ""; 
 
$mysqli = new mysqli(hostname: $host, 
                    username: $username, 
                    password: $password, 
                    database: $dbname);

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_errno);
} 

return $mysqli;
?>