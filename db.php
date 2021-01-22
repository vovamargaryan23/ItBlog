<?php
$host = "miniblog";
$dbname = "miniblog";
$user = "root";
$pass = "root";

try {
    $db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
} catch (PDOException $e) {
    echo "Error Connecting DB" . $e->getMessage();
}
