<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listy</title>
</head>
<body>
    <h4>Lista</h4>
    <ul>
    <li>Wielkopolska </li>
        <ol>
            <li>Poznań </li>
            <li>Września </li>
            <li>Gniezno </li>
        </ol>

    <li> dolnośląskie
        <?php
        $city = "Wrocław";
        echo "<ol>";
        echo "<li>Legnica</li>";
        echo "<li>$city</li>";
        //echo "</ol>";
        ?>
        <li>Bolesławiec </li>
        </ol>
    </li>
    <li> kujawsko-pomorskie</li>
    </ul>
</body>
</html>

