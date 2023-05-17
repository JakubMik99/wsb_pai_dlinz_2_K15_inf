<?php
function sanitizeInput(&$input){
        $input = stripslashes($input);
        $input = htmlentities($input);
        $input = trim($input);
}
// echo $_POST["firstName"]." ilość znaków: ".strlen($_POST["firstName"])." ==> ". sanitizeInput($_POST["firstName"])." Ilość znaków: ".strlen($_POST["firstName"]));


if ($_SERVER["REQUEST_METHOD"]== "POST") {
    session_start();
require_once "./connect.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
$errors = [];
$required_fields = ["firstName","lastName","email1","email2","password1","password2","bitthday","city_id","plec"];
//  foreach($required_fields as $key => $value){
//     echo "$key = $value <br>";
//  }

    
    foreach($required_fields as $value)
    {
        if(empty($_POST[$value])){
            $errors[] = "Pole <b> $value </b> jest wymagane!";
        }
    }

    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);        
        echo "<script>history.back();</script>";
        exit();
    }
    if($_POST["email1"]!=$_POST["email2"]){
        $errors[]="Adresy email są różne od siebie";
    }
    if($_POST["additionalEmail1"]!=$_POST["additionalEmail2"]){
        $errors[]="Dodatkowe adresy email są różne od siebie";
    }else{
        if(empty($_POST["additionalEmail1"])){
            $_POST["additionalEmail1"] = NULL;
        }
    }
    if($_POST["password1"]!=$_POST["password2"]){
        $errors[]="Hasła są różne od siebie";
    }else {
        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/',$_POST["password1"])){
            $errors[]="Hasło nie spełnia wymagań";
        }
    }
    if(!isset($_POST["plec"])){
        $errors[]="Wybierz płeć";
    }
    if(!isset($_POST["terms"])){
       $errors[]="Zaakceptuj regulamin";
    }
    if (!empty($errors)) {
        $_SESSION["error"] = implode("<br>", $errors);        
        echo "<script>history.back();</script>";
        exit();
    }
    //walidacja hasła

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
        foreach($_POST as $key => $value){
            if(!$_POST["password1"] && !$_POST["password2"]){
                sanitizeInput($_POST["key"]);
            }
        }
      $stmt= $conn->prepare("INSERT INTO `users` (`city_id`, `firstName`, `lastName`, `bitthday`,`gender`,`avatar`, `haslo`,`email`,`additional_email`, `created_at`) VALUES (?, ?, ?,?, ?, ?, ?, ?,?, current_timestamp());");
      $pass = password_hash('$_POST["password1"]', PASSWORD_ARGON2ID);
      $stmt ->bind_param('issssssss',$_POST["city_id"],$_POST["firstName"],$_POST["lastName"],$_POST["bitthday"],$gender,$avatar,$pass ,$_POST["email1"],$_POST["additionalEmail1"]);
      $stmt->execute();
    
      if($stmt->affected_rows==1){
          $_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
        }else{
            $_SESSION["error"] = "Nie udało się dodać użytkownika";
        }
    }
    header("location:../register.php");  
    
