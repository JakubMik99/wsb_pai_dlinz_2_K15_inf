<?php
session_start();
print_r($_POST);
foreach($_POST as $key => $value){
    //echo "$key: $value<br>";
    if (empty($value)) {
        //echo "$key <br>";
        echo "<script>history.back();</script>";
        exit();
    }
}
require_once "./connect.php";
//$sql = "INSERT INTO users (id, city_id, firstName, lastName, bitthday) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[bitthday]');";
$sql = "UPDATE users SET city_id = $_POST[city_id], firstName = '$_POST[firstName]', lastName = '$_POST[lastName]', bitthday = '$_POST[bitthday]' WHERE users.id =$_SESSION[updateUserId]";
$conn->query($sql);
unset($_SESSION["updateUserId"]);
// echo $conn->affected_rows;
if ($conn->affected_rows==1) {
    $_SESSION["error"] = "Prawidłowo dodano rekord";
}else {
    $_SESSION["error"] = "Nie dodano rekordu";

}
//  header("location: ../4_db/5_db.php");
