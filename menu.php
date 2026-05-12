<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'config.php';
?>
<?php
$conn = new mysqli("localhost", "root", "", "dineesay");

if ($conn->connect_error) {
    die("Connection failed");
}

$result = $conn->query("SELECT * FROM meals");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dineesay Menu</title>
</head>
<body>

<h1>Meal Menu</h1>

<table border="1">
<tr>
    <th>Meal</th>
    <th>Price</th>
</tr>

<?php
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['meal_name']}</td>
            <td>{$row['price']}</td>
          </tr>";
}
?>

</table>

</body>
</html>
