<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="w3.php" method="POST">
        Podaj swoje imię: <br>
        <input type="text" name="imie"><br>
        <button type="submit" value="submit_name">Potwierdź</button>
    </form>
    <?php
    $imie = $_POST['imie'];
    echo "<h3>Witaj $imie </h3>"
    ?>
    
    
</body>
</html>