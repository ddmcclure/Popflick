<?php
require_once "header.php";
try {
    $sql = "SELECT CusFName, CusLName FROM Customers";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
        <tr><th>First Name</th><th>Last Name</th></tr>";
        foreach($row as $row) {
            echo "<td>" . $row['CusFName'] . "</td>";
            echo "<td>" . $row['CusLName'] . "</td>";
            echo "</tr>\n";
        }
    echo "</table>";
}
catch (PDOException $e) {
    die($e->getMessage());
}
?>

<?php
require_once "footer.php";