<?php
session_start();
//wersja z zajęć
$errors = [];
if($_SERVER["REQUEST_METHOD"]=='POST'){

// wersja z zajęć
    foreach($_POST as $key => $value){
        if(empty($value)){
            $errors[] = "Pole <b>$key</b> musi być wypełnione";
        }
    }
    if(!empty($errors)){
        $error_messege = implode("<br>",$errors);
        header("location: ../index.php?error=".urlencode($error_messege));
        exit();
    }
    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)== false)
    {
        $error_messege = "Wprowadź poprawny email";
        header("location: ../index.php?error=".urlencode($error_messege));
        exit();
    }
    else {
        echo "email:".$_POST["email"]. " hasło: ". $_POST["pass"];
    }
    require_once "./connect.php";
    $stmt = $conn->prepare("SELECT * FROM users where email=?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt-> execute();
    $result = $stmt->get_result();
    echo $result ->num_rows;
    if($result->num_rows !=0){
        $user = $result->fetch_assoc();
        if(password_verify($_POST["pass"],$user["haslo"])){
           $_SESSION["logged"]["firstName"] = $user["firstName"];
           $_SESSION["logged"]["lastName"] = $user["lastName"];
           $_SESSION["logged"]["role_id"] = $user["role_id"];
           $_SESSION["logged"]["session_id"] = session_id();
           header("location: ../logged.php");
           print_r($_SESSION["logged"]);
        print_r($_SESSION["logged"]);
            echo "zalogowany";
        }else{
            $_SESSION["error"] = "Błędny login lub hasło!";
        echo "<script> history.back();</script>";
        exit();

        }
    }else{   
        $_SESSION["error"] = "Błędny login lub hasło!";
        echo "<script> history.back();</script>";
        exit();
    }


} else{
    header("location:../pages/index.php");
}
// echo "<script>history.back();</script>";
// exit(); 
