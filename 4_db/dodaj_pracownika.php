<?php
require_once "../scripts/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        $sql = "SELECT city FROM cities;";
        $result = $conn->query($sql);
        $options = mysqli_fetch_all($result,MYSQLI_ASSOC);
        ?>
        <form action="2_db.php" method="POST">
            <input type="text" name="firstName" placeholder="imie">
            <input type="text" name="lastName" placeholder="nazwisko">
            <input type="date" name="birthday">
            <select name="city">
                <option>Wybierz miasto</option>
                <?php
                    foreach($options as $option){
                        ?>
                        <option ><?php echo $option['city']?></option>
                   <?php 
                    }
                ?>
            </select>
            

        </form>
</body>
</html>

