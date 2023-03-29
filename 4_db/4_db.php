<?php session_start(); ?>
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
        if (isset($_SESSION["error"])) {
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
    require_once "../scripts/connect.php";

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
    if(isset($_GET["deleteUser"])){
        if($_GET["deleteUser"]!=0){
            echo "<hr>Usunięto użytkownika o id= $_GET[deleteUser] <br>";
        }else{
            echo "<hr>Nie usunięto użytkownika";
        }
    }
    if(isset($_GET["addUserForm"])){
        echo <<< ADDUSERFORM
        <h4> Dodawanie użytkownika </h4>
        <form action="../scripts/add_user.php" method="post">
        <input type="text" name="firstName" placeholder="Imię" autofocus> <br><br>
        <input type="text" name="lastName" placeholder="Nazwsiko"> <br><br>
        <input type="date" name="bitthday" placeholder ="Data urodzenia"> <br><br>
        <select name="city_id">
        ADDUSERFORM;
        $sql = "SELECT * from cities";
        $result = $conn->query($sql);
        while($city=$result->fetch_assoc()){
            echo <<< MIASTO
           <option value="$city[id]"> $city[city]</option>
           MIASTO;
        }
        echo <<< ADDUSERFORM
        </select> <br> <br>
        <input type="submit" value="Dodaj użytkownika">
        </form>
        ADDUSERFORM;
    }else{
    echo '<a href="./4_db.php?addUserForm=1">Dodaj użytkownika</a>';
    }
    ?>

</body>
</html>