<?php
// Χρήση προεπιλεγμένης θύρας (3306)
$conn = new mysqli('localhost', 'root', '', 'edutafly_eshop_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
