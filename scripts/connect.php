<?php
$conn = new mysqli("localhost","root","","wsb");
// echo "db";
echo $conn->connect_errno;