<?php
session_start();
session_destroy();
session_start();

$_SESSION["success"] = "Wylogowanie powiodło się";
header("location: ../index.php");
exit();
