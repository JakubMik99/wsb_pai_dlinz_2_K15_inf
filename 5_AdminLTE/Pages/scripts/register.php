<?php
session_start();
require_once "./connect.php";

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
    if(!isset($_POST["plec"])){
        $_SESSION["error"]="Wybierz płeć";
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
  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt -> bind_param("s",$_POST["email1"]);
  $stmt ->execute();
  $result =$stmt->get_result();
  if ($result->num_rows !=0) {
      $_SESSION["error"] = "Adres email $_POST[email1] jest już zajęty";
      echo "<script>history.back();</script>";
      exit();
    }
    if ($_POST["plec"]=="w") {
        $gender = "woman";
        $avatar = "../../img/woman.png";
    } else {
        $gender = "man";
        $avatar = "../../img/man.png";
    }

  $stmt= $conn->prepare("INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `bitthday`,`gender`,`avatar`, `haslo`,`email`, `created_at`) VALUES (?, ?, ?,?, ?, ?, ?, ?, current_timestamp());");
  $pass = password_hash('$_POST["password1"]', PASSWORD_ARGON2ID);
  $stmt ->bind_param('isssssss',$_POST["city_id"],$_POST["firstName"],$_POST["lastName"],$_POST["bitthday"],$gender,$avatar,$pass ,$_POST["email1"]);
  $stmt->execute();

  if($stmt->affected_rows==1){
      $_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
    }else{
        $_SESSION["error"] = "Nie udało się dodać użytkownika";
    }
    // header("location:../register.php");  
