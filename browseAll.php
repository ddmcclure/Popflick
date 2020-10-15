<?php
include_once "header.php;

$sql = "SELECT MovName, MovGenre, MovRating, from Movies ORDER by MovName";

$result = $pdo->query($sql);

?>
<table>
	<tr><th>Movies</th><th colspan="3">Options</th></tr>
	<?php
	foreach ($result as $row){
	echo "<tr><td>".$row['stuff']."</td>;
	echo"<td><a herf ='view.php?ID=".$row['ID'].">View</a>;
	echo"<td><a herf ='rent.php?ID=".$row['ID'].">Rent</a>;
	echo"<td><a herf =buy.php?ID=".$row['ID'].">Buy</a>;
}
	echo "</td></tr>;"
	?>
</table>
<?php
include_once "footer.php";