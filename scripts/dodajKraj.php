<?php
require_once "connect.php";
$kraj = $_POST['country'];
$sql = <<<justRandomSpecifier
INSERT INTO countries (country) VALUES ('$kraj');
justRandomSpecifier;

    $request = $conn->query($sql);

header("Location: ../4_db/w_domu.php");