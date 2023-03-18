<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Document</title>
</head>
<body>
    <a href="dodaj.php">Dodaj uzytkownika</a>
    
<?php
require_once "../scripts/connect.php";
$sql = "SELECT u.firstName, u.lastName, u.bitthday, c.city, s.state, co.country FROM users u
INNER JOIN cities c on u.city_id = c.id
INNER JOIN states s on c.state_id = s.id
INNER JOIN countries co on s.country_id = co.id;";
$result = $conn->query($sql);
echo <<< TAB
<table>
<tr> 
    <th>Imię </th> 
    <th>Nazwisko </th> 
    <th>Data urodzenia </th> 
    <th>Miejscowość </th> 
    <th>Województwo </th> 
    <th>Państwo </th> 
</tr>
TAB;
while($user = $result->fetch_assoc())
{
echo <<< DATA
<tr>
<td> $user[firstName]</td>
<td> $user[lastName]</td>
<td> $user[bitthday]</td>
<td> $user[city]</td>
<td> $user[state]</td>
<td> $user[country]</td>

</tr>

DATA;
}
?>

</body>
</html>