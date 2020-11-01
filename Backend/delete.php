<<<<<<< HEAD
<?php
require_once "backheader.php";

$showform =1;
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    try {
        $sql = "DELETE FROM Movies WHERE ID = :ID";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':ID', $_POST['ID']);

        $stmt->execute();

        $showform = 0;

        echo "<p>The movie <strong>".$_POST['M']."</strong> has been deleted. Return to <a href='movie.php'>Movie List</a>.</p>";
    }
    catch (PDOException $e)
    {
        die( $e->getMessage());
    }

}

if ($showform ==1)
{
 ?>
    <p>Are you sure you want to delete <?php echo $_GET['M'];?></p>
    <form id="delete" name="delete" method="post" action="<?php echo $currentfile;?>">
        <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID'];?>">
        <input type="hidden" id="M" name="M" value="<?php echo $_GET['M'];?>">
        <input type="submit" id="delete" name="delete" value="YES">
        <input type="button" id="nodelete" name="nodelete" value="NO" onclick="window.location='movie.php'">
    </form>
<?php
}

=======
<?php
require_once "backheader.php";

$showform =1;
if ($_SERVER['REQUEST_METHOD']=="POST")
{
    try {
        $sql = "DELETE FROM Movies WHERE ID = :ID";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':ID', $_POST['ID']);

        $stmt->execute();

        $showform = 0;

        echo "<p>The movie <strong>".$_POST['M']."</strong> has been deleted. Return to <a href='movie.php'>Movie List</a>.</p>";
    }
    catch (PDOException $e)
    {
        die( $e->getMessage());
    }

}

if ($showform ==1)
{
 ?>
    <p>Are you sure you want to delete <?php echo $_GET['M'];?></p>
    <form id="delete" name="delete" method="post" action="<?php echo $currentfile;?>">
        <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID'];?>">
        <input type="hidden" id="M" name="M" value="<?php echo $_GET['M'];?>">
        <input type="submit" id="delete" name="delete" value="YES">
        <input type="button" id="nodelete" name="nodelete" value="NO" onclick="window.location='movie.php'">
    </form>
<?php
}

>>>>>>> 97f2c8079425dd0471110e188a43f7e3ad3ca668
require_once "footer.php";