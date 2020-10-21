<?php
require_once "connect.inc.php";
require_once "header.php";
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
	echo "<td><a href='rent.php?ID=".$row['ID']."'>Rent</a> </td>";
	echo "<td><a href='buy.php?ID=".$row['ID']."'>Buy</a> </td>";
}
	echo "</td></tr>;"
	?>
</table>
<?php
include_once "footer.php";