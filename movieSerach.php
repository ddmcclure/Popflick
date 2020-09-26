<?php
require_once "header.php";
$sql = "SELECT MovName, MovGenre, MovRating, from Movies ASC WHERE ID = {$_GET['ID']} ";

$result = $pdo->query($sql);

?>
    <table><th>Movie List</th><th colspan="3">Options</th><tr>
            <?php
            foreach ($result as $row){
                echo "<tr><td>" . $row['Movname'] . "</td>";
                echo "<tr><td>" . $row['MovGenre'] . "</td>";
                echo "<tr><td>" . $row['MovRating'] . "</td>";
            }
            echo "</td></tr>";
            ?>
    </table>
<?php
require_once "footer.php"
//Going to make more changes
?>