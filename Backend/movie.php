<?php
require_once "backheader.php";
try {
    $sql = "SELECT ID, movie from Movies ORDER by movie";
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
            echo "<tr><td>".$row['movie']."</td>";
            echo "<td><a href='viewBack.php?ID=".$row['ID']."'>View</a> </td>";
            echo "<td><a href='edit.php?ID=".$row['ID']."'>Edit</a> </td>";
            echo "<td><a href='delete.php?ID=".$row['ID']. "&M=" . $row['movie'] . "'>Delete</a> </td>";
        }
        echo "</td></tr>";
        ?>
    </table>

<?php
    echo"<p>Would you like to add a new movie?</p> <a href='insertMovie.php'><button>Add Here!</button></a>";
include_once "footer.php";