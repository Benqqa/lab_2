<?php
include 'config.php';

$table1 = 'Sector';
$table2 = 'Objects';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Данные из объединенных таблиц</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Данные из объединенных таблиц Sector и Objects</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Coordinates</th>
            <th>Light Intensity</th>
            <th>Foreign Objects</th>
            <th>Star Objects</th>
            <th>Unknown Objects</th>
            <th>Defined Objects</th>
            <th>Sector Note</th>
            <th>Type</th>
            <th>Accuracy</th>
            <th>Quantity</th>
            <th>Time</th>
            <th>Date</th>
            <th>Object Note</th>
        </tr>
        <?php
        try {
            $stmt = $conn->prepare("CALL joinTables(:table1, :table2)");
            $stmt->bindParam(':table1', $table1);
            $stmt->bindParam(':table2', $table2);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['coordinates'] . "</td>
                        <td>" . $row['light_intensity'] . "</td>
                        <td>" . $row['foreign_objects'] . "</td>
                        <td>" . $row['star_objects'] . "</td>
                        <td>" . $row['unknown_objects'] . "</td>
                        <td>" . $row['defined_objects'] . "</td>
                        <td>" . $row['note'] . "</td>
                        <td>" . $row['type'] . "</td>
                        <td>" . $row['accuracy'] . "</td>
                        <td>" . $row['quantity'] . "</td>
                        <td>" . $row['time'] . "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['note'] . "</td>
                      </tr>";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </table>
</body>
</html>

<?php
$conn = null;
?>