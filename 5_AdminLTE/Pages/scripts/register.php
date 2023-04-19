<?php
session_start();
echo "<pre>";
print_r($_POST);
echo "</pre>";
foreach($_POST as $key => $value)
{
    if(empty($value)){
        $_SESSION["error"]= "Wypełnij wszystkie pola";
        echo "<script>history.back();</script>";
        exit(); 
    }
}
    if(!isset($_POST["terms"])){
        $_SESSION["error"]="Zaakceptuj regulamin";
        echo "<script>history.back();</script>";
        exit(); 
    }

    if($_POST["email1"]!=$_POST["email2"]){
        $_SESSION["error"]="Adresy email są różne od siebie";
        echo "<script>history.back();</script>";
        exit(); 
    }
    if($_POST["password1"]!=$_POST["password2"]){
        $_SESSION["error"]="Hasła są różne od siebie";
        echo "<script>history.back();</script>";
        exit(); 
    }
  //duplikacja adresu email
  
  require_once "./connect.php";
  $stmt= $conn->prepare("INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `bitthday`, `haslo`,`email`, `created_at`) VALUES (?, ?, ?,?, ?, ?, current_timestamp());");
  $pass = password_hash('$_POST["password1"]', PASSWORD_ARGON2ID);
  $stmt ->bind_param('isssss',$_POST["city_id"],$_POST["firstName"],$_POST["lastName"],$_POST["bitthday"],$pass ,$_POST["email1"]);
  $stmt->execute();
  if($stmt->affected_rows==1){
      $_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
    }else{
        $_SESSION["error"] = "Nie udało się dodać użytkownika";
    }
    header("location:../register.php");  
