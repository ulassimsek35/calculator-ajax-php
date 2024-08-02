<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=mycalculator;charset=utf8mb4", "root", "");
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}
?>
