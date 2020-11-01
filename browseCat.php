<?php
require_once "header.php";

$showform =1;

if(isset($_GET['submit']) && !empty($_GET['term']))
{
    $term = trim($_GET['term']);
    echo "<p>Your item is being searched!</p>";

    $sql = "SELECT * FROM Movies WHERE genre LIKE '%{$term}%' ORDER BY movie ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':term', $term);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($result)) {
        echo "<p>Sorry, your item was not found.</p>";
    } else {
        echo "<p>We found our item for you!</p><br>";
        echo "<p><a href='browseCat.php'>Search again?</a></p><br>";
        echo "<p>Here's what we found:</p><br>";
        ?>
        <table>
            <tr><th>Movie</th><th>Date</th><th>Rating</th><th>Genre</th><th>Options</th></tr>
            <?php
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['movie'] . "</td>";
                echo "<td>" . $row['see'] . "</td>";
                echo "<td>" . $row['rating'] . "</td>";
                echo "<td>" . $row['genre'] . "</td>";
                echo "<td><a href='view.php?ID=".$row['ID']."'>VIEW</a></td> 
                      <td><a href='buy.php?ID=".$row['ID']."&C=".$row['movie']."'>BUY</a></td> 
                      <td><a href='rent.php?ID=".$row['ID']."&C=".$row['movie']."'>RENT</a></td>";
                echo "</tr>";
            } ?>
        </table>
        <br>
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
    echo "<p>Please type something in the begin the search.</p>";
}

if ($showform = 1)
{
    ?>
    <form name="search" id="search" action="<?php echo $currentfile;?>" method="GET">
        <label for="term">Search Category</label>
        <select name="term" id="term">
                <option value="action">Action</option>
                <option value="adventure">Adventure</option>
                <option value="sport">Sport</option>
                <option value="thriller">Thriller</option>
                <option value="sci-fi">Sci-fi</option>
                <option value="drama">Drama</option>
                <option value="fantasy">Fantasy</option>
                <option value="crime">Crime</option>
            </select>
        </select>
        <br>
        <label for="submit">Submit:  </label>
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
    <?php
}
require_once "footer.php";
?>
}
