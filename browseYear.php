<?php
require_once "header.php";

$showform = 1;

if(isset($_GET['submit']) && !empty($_GET['term'])) {

    $term = trim($_GET['term']);
    echo "<p>Your item is being searched!</p>";

    $sql = "SELECT * FROM Movies WHERE MovDate LIKE '%{$term}%'";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':term', $term);
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (empty($result)) {
        echo "<p>Sorry, your item was not found.</p>";
    } else {
        echo "<p>We found our item for you!</p><br>";
        echo "<p><a href='browseYear.php'>Browse another year?</a></p><br>";
        echo "<p>Here's what we found:</p><br>";
        ?>
        <table>
            <?php
            foreach ($result as $row) {
                echo "<tr><th>Movie Name</th><td>" . $row['MovName'] . "</td></tr>";
                echo "<tr><th>Release</th><td>" . $row['MovDate'] . "</td></tr>";
                echo "<tr><th>Rating</th><td>" . $row['MovRating'] . "</td></tr>";
                echo "<tr><th>Genre</th><td>" . $row['MovGenre'] . "</td></tr>";
                echo "<td><a href='view.php?ID=".$row['ID']."'>View</a> </td>";
                echo "<td><a href='rent.php?ID=".$row['ID']."'>Rent</a> </td>";
                echo "<td><a href='buy.php?ID=".$row['ID']."'>Buy</a> </td>";
                echo "<tr><th><br></th>";
            } ?>
        </table>
        <?php
        $showform = 0;
    }
}

else if (isset($_GET['submit']) && empty($_GET['term']))
{
    echo "<p>Sorry, you left the form empty</p>";
}

else
{
    echo "<p>Please type a year in to begin the search.</p>";
}

if ($showform = 1)
{
    ?>
    <form name="search" id="search" action="<?php echo $currentfile;?>" method="get">
        <label for="term">Search Year</label>
        <input type="text" name="term" id="term" placeholder="Required search year">
        <br>
        <label for="submit">Submit:  </label>
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
    <?php
}
require_once "footer.php";
?>
