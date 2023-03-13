<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testy z bazą danych</title>
</head>
<body>
    <?php
    require_once "../scripts/polacz.php";
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