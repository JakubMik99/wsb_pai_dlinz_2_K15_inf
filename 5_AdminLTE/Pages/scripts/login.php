<?php
session_start();
//moja wersja
// $err = array(
//     "email" => "Wprowadź email <br>",
//     "pass" => "Wprowadź hasło <br"
// );
//wersja z zajęć
$errors = [];
if($_SERVER["REQUEST_METHOD"]=='POST'){
    
    //moja wersja
    // $_SESSION["error"]="";
    // foreach($_POST as $key => $value){
    //     if(empty($value)){
    //         $_SESSION["error"] .= $err[$key];
    //     }
    // }
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
    //Zachowuje<b>
    // echo htmlentities($_POST["email"]);
    //Zachowuje tylko b
    // filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)== false)
    {
        $error_messege = "Wprowadź poprawny email";
        header("location: ../index.php?error=".urlencode($error_messege));
        exit();
    }
    else {
        echo "email:".$_POST["email"]. " hasło: ". $_POST["pass"];
    }
} else{
    header("location:../pages/index.php");
}
// echo "<script>history.back();</script>";
// exit(); 
