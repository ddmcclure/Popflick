<?php
include_once "header.php";

$sql = "SELECT * from Movies WHERE ID = {$_GET['ID']}";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
    <br>
    <br>
    <table>
        <?php echo "<img src='/uploads/".$row['poster']."'alt='Profile Picture for" . $row['movie'] ."class='profile'>";?>
        <tr><th>Movie Name</th><td><?php echo $row['movie'];?></td></tr>
        <tr><th>Release</th><td><?php echo $row['see'];?></td></tr>
        <tr><th>Rating</th><td><?php echo $row['rating'];?></td></tr>
        <tr><th>Genre</th><td><?php echo $row['genre'];?></td></tr>
    </table>
<?php
echo"<a href='movieFront.php'><button>Back to Movie List</button></a>";
include_once "footer.php";
?>