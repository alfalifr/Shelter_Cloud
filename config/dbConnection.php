<?php
$conn = new mysqli("localhost","shelter_dev","dev_shelter","shelter_caps");

if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>
