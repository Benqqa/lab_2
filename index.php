<?php
include 'config.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Observatory</title>
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
    <h1>List of Objects</h1>
    
    <h2>Sector</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Coordinates</th>
            <th>Light Intensity</th>
            <th>Foreign Objects</th>
            <th>Star Objects</th>
            <th>Unknown Objects</th>
            <th>Defined Objects</th>
            <th>Note</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM Sector");
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
                  </tr>";
        }
        ?>
    </table>

    <h2>Objects</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Accuracy</th>
            <th>Quantity</th>
            <th>Time</th>
            <th>Date</th>
            <th>Note</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM Objects");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['accuracy'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['time'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['note'] . "</td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Natural Objects</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Galaxy</th>
            <th>Accuracy</th>
            <th>Light Flux</th>
            <th>Related Objects</th>
            <th>Note</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM NaturalObjects");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['galaxy'] . "</td>
                    <td>" . $row['accuracy'] . "</td>
                    <td>" . $row['light_flux'] . "</td>
                    <td>" . $row['related_objects'] . "</td>
                    <td>" . $row['note'] . "</td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Positions</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Earth Position</th>
            <th>Sun Position</th>
            <th>Moon Position</th>
        </tr>
        <?php
        $stmt = $conn->query("SELECT * FROM Positions");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['earth_position'] . "</td>
                    <td>" . $row['sun_position'] . "</td>
                    <td>" . $row['moon_position'] . "</td>
                  </tr>";
        }
        ?>
    </table>

    <form action="join.php" method="get">
        <button type="submit">Показать данные из объединенных таблиц</button>
    </form>
</body>
</html>

<?php
$conn = null;
?>