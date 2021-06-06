<?php
$conn = new mysqli("localhost","root","","shelter_caps");

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>
