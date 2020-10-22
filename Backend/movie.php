<?php
require_once "backheader.php";
try {
    $sql = "SELECT ID, MovName from Movies ORDER by MovName";
    $result = $pdo->query($sql);

}catch (PDOException $e)
{
    die($e->getMessage());
}
?>
    <table>
        <tr><th>Movies</th><th colspan="4">Options</th></tr>
        <?php
        foreach ($result as $row){
            echo "<tr><td>".$row['MovName']."</td>";
            echo "<td><a href='view.php?ID=".$row['ID']."'>View</a> </td>";
            echo "<td><a href='edit.php?ID=".$row['ID']."'>Edit</a> </td>";
            echo "<td><a href='delete.php?ID=".$row['ID']. "&M=" . $row['MovName'] . "'>Delete</a> </td>";
        }
        echo "</td></tr>";
        ?>
    </table>
<?php
include_once "footer.php";