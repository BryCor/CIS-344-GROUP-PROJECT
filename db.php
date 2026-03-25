<?php
// connect to database
$conn = mysqli_connect("localhost", "root", "", "pet_adoption_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>