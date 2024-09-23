<?php
session_start();

$connection = new mysqli('localhost', 'root', '', 'car_rental');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>
