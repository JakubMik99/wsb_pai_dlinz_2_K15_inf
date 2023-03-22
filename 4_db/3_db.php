<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Użytkownicy</title>
</head>
<body>
    
        <?php
    require_once "../scripts/connect.php";
    if(!isset($_GET["Miasto"])){
        $_GET["Miasto"]=-1;
    }

   echo <<<MIASTO
   <a href="3_db.php?Miasto=1">Wyświetl miasta</a> 
   MIASTO;
   
   if($_GET["Miasto"]!=1)
   {

       $sql = "SELECT `users`.`id`,`users`.`firstName`,`users`.`lastName`, `users`.`bitthday`,`cities`.`city`,`states`.`state`,`countries`.`country` FROM `users` 
    inner join `cities` on `users`.`city_id` = `cities`.`id` 
    inner join `states` on `cities`.`state_id` = `states`.`id` 
    inner join `countries` on `states`.`country_id` = `countries`.`id`;";
    $result = $conn->query($sql);
    echo <<< USERSTABLE
    <h4>Użytkownicy</h4>
    <table>
    <tr>
    <th>Imię</th>
    <th>Nazwisko</th>
    <th>Miasto</th>
            <th>Województwo</th>
            <th>Państwo</th>
            <th>Data urodzenia</th>
            </tr>
    USERSTABLE;
            
            if($result->num_rows >0){
                
                
                while($user=$result->fetch_assoc()){
                    echo <<<USERS
                    <tr> 
                    <td> $user[firstName]</td>
            <td> $user[lastName]</td> 
            <td> $user[city]</td> 
            <td> $user[state]</td>
            <td> $user[country]</td>
            <td> $user[bitthday]</td>
            <td> <a href="../scripts/delete_user.php?deleteUserId=$user[id]">Usuń</a> </td>
            </tr>
            
            USERS;
        }
    }else{
        echo <<< USERTABLE
        <tr>
        <td colspan="6"> brak rekordów do wyświetlenia </td>
        </tr>
        USERTABLE;
    }
    echo "</table>";
    if(isset($_GET["deleteuser"])){
        if($_GET["deleteuser"]!=0){
            echo "<hr>Usunięto użytkownika o id= $_GET[deleteUser]";
        }else{
            echo "<hr>Nie usunięto użytkownika";
        }
    }
    
}else{
    $sql = "SELECT cities.city, states.state FROM cities
    inner join states on states.id = cities.state_id";
    $result = $conn->query($sql);
    $result = $conn->query($sql);
    echo <<< CITYTABLE
    <h4>Miasta</h4>
    <table>
    <tr>
    <th>Miasto</th>
    <th>Województwo</th>
    CITYTABLE;
    if($result->num_rows >0){
                
                
        while($user=$result->fetch_assoc()){
            echo <<<USERS
            <tr> 
            <td> $user[city]</td> 
            <td> $user[state]</td>
            <td> <a href="../scripts/delete_user.php?deleteUserId=$user[id]">Usuń</a> </td>
            </tr>
            USERS;
        }
    }
}

    ?>

</body>
</html>