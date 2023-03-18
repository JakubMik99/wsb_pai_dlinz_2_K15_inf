<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testy z bazą danych</title>
</head>
<body>
    <form action="test_db.php" methot="POST">
        <label>Imię </label> <br>
        <input type="text" name = "imie"> <br>
        <label>Nazwisko </label> <br>
        <input type="text" name = "nazwisko"> <br>
        <label>Data urodzenia </label> <br>
        <input type="date" name = "data_ur"> <br>
        <input type="submit" value= "Dodaj pracownika">
    </form>
    <?php
    $conn = new mysqli("localhost","root","","firma");
    require_once "../scripts/polacz.php";
    if(isset($_POST['dodaj_pracownika'])){
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $data_urodzenia = $_POST['data_ur'];
    
        $sqlAdd = 'INSERT INTO pracownicy (imie, nazwisko, data_urodzenia) VALUES ("'.$imie.'", "'.$nazwisko.'", '.$data_urodzenia.');';
        $query_run = msqli_query($conn,$sqlAdd);
        if($query_run){
            $sqlAdd = 'INSERT INTO pracownicy (imie, nazwisko, data_urodzenia) VALUES ("'.$imie.'", "'.$nazwisko.'", '.$data_urodzenia.');';
            $add = $conn->query($sqlAdd);
            echo "Dodano pracownika";
        }
        else{
            echo "Dodanie pracownika nie powiodło się";
        }
    }   
    $sql = "SELECT * FROM `pracownicy`;";

    $result = $conn->query($sql);
    while( $user = $result->fetch_assoc()){
        echo <<<USER
        Imię i nazwisko: $user[Imie] $user[Nazwisko] data urodzenia: $user[Data_Urodzenia]<br>
        USER;
    }
    ?>
</body>
</html>