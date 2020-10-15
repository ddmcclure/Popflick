<?php
include_once "header.php;

$sql = "SELECT * from Movies WHERE ID = {$_GET['ID']}";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$row = $stmt->fetch();
?>
<table>
	<tr><th>Movie Name</th><td>?echo $row['Movname'];?></td></tr>
	<tr><th>Genere</th><td>?echo $row['MovGenre'];?></td></tr>
	<tr><th>Rating</th><td>?echo $row['Rating'];?></td></tr>
</table>
<?php
include_once "footer.php";
?>