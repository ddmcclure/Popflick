<?php
require_once "header.php";
try {
    $sql = "SELECT ID, movie from Movies ORDER by movie";
    $result = $pdo->query($sql);

}catch (PDOException $e)
{
    die($e->getMessage());
}
?>
    <table>
        <tr><th>Movies</th><th colspan="5">Options</th></tr>
        <?php
        foreach ($result as $row){
            echo "<tr><td>".$row['movie']."</td>";
            echo "<td><a href='viewBack.php?ID=".$row['ID']."'>View</a> </td>";
            echo "<td><a href='edit.php?ID=".$row['ID']."'>Edit</a> </td>";
            echo "<td><a href='delete.php?ID=".$row['ID']. "&M=" . $row['movie'] . "'>Delete</a> </td>";
            echo "<td><a href='poster.php?ID=".$row['ID']."'>Poster</a> </td>";
        }
        echo "</td></tr>";
        ?>
    </table>

<?php
require_once "footer.php";