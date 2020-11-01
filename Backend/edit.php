<?php
require_once "backheader.php";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ID']))
{
    $ID = $_GET['ID'];
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID'])) {
    $ID = $_POST['ID'];
} else {
    echo "<p class='error'> Something happened! Cannot obtain the correct entry.</p>";
    require_once "footer.php";
    exit();
}

$showform = 1;

$errmsg = 0;

$errname = "";

$errrate = "";

$errrate = "";

$errdate = "";

$errgenre = "";

$errfile = "";



if($_SERVER['REQUEST_METHOD'] == "POST")

{

    /* ***********************************************************************

    * SANITIZE USER DATA

    * ***********************************************************************

    */

    $movie = $_POST['movie'];
    $see = $_POST['see'];
    $rating = $_POST['rating'];
    $genre = $_POST['genre'];

    /* ***********************************************************************

     * CHECK EMPTY FIELDS

     * ***********************************************************************

     */

    if (empty($movie)) {

        $errname = "<span class='error'>The movie name is required.</span>";

        $errmsg = 1;

    }

    if (empty($see)) {

        $errdate = "<span class='error'>The date is required.</span>";

        $errmsg = 1;

    }

    if (empty($rating)) {

        $errrate = "<span class='error'>The rating is required.</span>";

        $errmsg = 1;

    }

    if (empty($genre)) {

        $errgenre = "<span class='error'>The genre name is required.</span>";

        $errmsg = 1;

    }
    /* ***********************************************************************

     * VALIDATE USER DATA

     * ***********************************************************************

     */

    //Nothing to validate



    /* ***********************************************************************

     * CHECK MATCHING FIELDS - uses functions.inc.php

     * ***********************************************************************

     */

    //Nothing to check



    /* ***********************************************************************

     * CHECK EXISTING DATA

     * ***********************************************************************

    */

    if ($movie != $_POST['ormovie']) {

        $sql = "SELECT * FROM Movies WHERE movie = ?";

        $moviename = checkDup($pdo, $sql, $movie);

        if ($moviename) {

            $errmsg = 1;

            $errcat = "<span class='error'>This movie is in the catalog already.</span>";

        }

    }//if category not empty

    /* ***********************************************************************

     * CONTROL CODE

     * ***********************************************************************

     */

    if($errmsg == 1){

        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";

    }

    else{

        echo "<p class='success'>There are no errors.</p>";

        /* ***********************************************************************

         * HASH SENSITIVE DATA

         * ***********************************************************************

         */

        //Nothing to hash



        /* ***********************************************************************

         * INSERT INTO THE DATABASE

         * ***********************************************************************

         */

        try{

            $sql = "UPDATE Movies SET movie = :movie, see = :see, rating = :rating, genre = :genre WHERE ID =:ID";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':ID', $ID);

            $stmt->bindValue(':movie', $movie);

            $stmt->bindValue(':see', $see);

            $stmt->bindValue(':rating', $rating);

            $stmt->bindValue(':genre', $genre);

            $stmt->execute();

            $showform =0; //hide the form

            echo "<p class='success'>Thanks for updating this movie.</p>";

        }

        catch (PDOException $e)

        {

            die( $e->getMessage() );

        }



    } // else errormsg

}//submit

/* ***********************************************************************

 * FORM

 * ***********************************************************************

 */

$sql = "SELECT * FROM Movies WHERE ID =:ID";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ID', $ID);
$stmt->execute();
$row = $stmt ->fetch();

if($showform == 1){

    ?>

    <form name="addMovie" id="addMovie" action="<?php echo $currentfile;?>" method="POST">

        <fieldset><legend>Add a New Movie</legend>

            <table>

                <tr>

                    <th><label for="movie">Name</label></th>

                    <td><?php if(isset($errname)){echo $errname;}?><br>

                        <input type="text" name="movie" id="movie"

                               placeholder="Required Movie Name"

                               value="<?php if(isset($movie)){echo $movie;} else{ echo $row['movie'];}?>"></td>

                </tr>

                <tr>

                    <th><label for="see">Date</label></th>

                    <td><?php if(isset($errdate)){echo $errdate;}?><br>

                        <input type="text" name="see" id="see"

                               placeholder="Required Date (XX/XX/XXXX)"

                               value="<?php if(isset($see)){echo $see;} else{ echo $row['see'];}?>"></td>

                </tr>

                <tr>

                    <th><label for="rating">Rating</label></th>

                    <td><?php if(isset($errrate)){echo $errrate;}?><br>

                        <input type="text" name="rating" id="rating"

                               placeholder="Required Rating"

                               value="<?php if(isset($rating)){echo $rating;} else{ echo $row['rating'];}?>"></td>

                </tr>

                <tr>

                    <th><label for="genre">Genre</label></th>

                    <td><?php if(isset($errgenre)){echo $errgenre;}?><br>

                        <input type="text" name="genre" id="genre"

                               placeholder="Required Genre"

                               value="<?php if(isset($genre)){echo $genre;} else{ echo $row['genre'];}?>"></td>

                </tr>

                <tr>

                    <th><label for="submit">Submit</label></th>

                    <td><input type="submit" name="submit" id="submit"></td>
                    <input type="hidden" name="ID" id="ID" value="<?php echo $row['ID'];?>">
                    <input type="hidden" name="ormovie" id="ormovie" value="<?php echo $row['movie'];?>">

                </tr>

            </table>

        </fieldset>

    </form>



    <?php

}//end showform

require_once "footer.php";

?>
