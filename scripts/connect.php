<?php
$conn = new mysqli("localhost","root","","firma");
// echo "db";
echo $conn->connect_errno;