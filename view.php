<?php
include_once "header.php";

$sql = "SELECT * from Movies WHERE ID = {$_GET['ID']}";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$row = $stmt->fetch();
?>
<br>
<br>
<table>
	<tr><th>Movie Name</th><td><?php echo $row['MovName'];?></td></tr>
    <tr><th>Release</th><td><?php echo $row['MovDate'];?></td></tr>
	<tr><th>Rating</th><td><?php echo $row['MovRating'];?></td></tr>
    <tr><th>Genre</th><td><?php echo $row['MovGenre'];?></td></tr>
</table>
<?php
include_once "footer.php";
?>