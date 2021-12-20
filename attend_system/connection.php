<?php

$conn = new mysqli('localhost', 'root', '0000', 'attendsys');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// set character
mysqli_set_charset($conn, "utf8");

?>