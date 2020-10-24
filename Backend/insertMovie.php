<?php
require_once "backheader.php";

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

    if (!empty($MovName)) {

        $sql = "SELECT * FROM Movies WHERE movie = :movie";

        $count = checkDup($pdo, $sql, $movie);

        if ($count > 0) {

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

            $sql = "INSERT INTO Movies (movie, see, rating, genre) VALUES (:movie, :see, :rating, :genre)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':movie', $movie);

            $stmt->bindValue(':see', $see);

            $stmt->bindValue(':rating', $rating);

            $stmt->bindValue(':genre', $genre);

            $stmt->execute();

            $showform =0; //hide the form

            echo "<p class='success'>Thanks for entering a new movie.</p>";

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

                               value="<?php if(isset($movie)){echo $movie;}?>"></td>

                </tr>

                <tr>

                    <th><label for="see">Date</label></th>

                    <td><?php if(isset($errdate)){echo $errdate;}?><br>

                        <input type="text" name="see" id="see"

                               placeholder="Required Date (XX/XX/XXXX)"

                               value="<?php if(isset($see)){echo $see;}?>"></td>

                </tr>

                <tr>

                    <th><label for="rating">Rating</label></th>

                    <td><?php if(isset($errrate)){echo $errrate;}?><br>

                        <input type="text" name="rating" id="rating"

                               placeholder="Required Rating"

                               value="<?php if(isset($rating)){echo $rating;}?>"></td>

                </tr>

                <tr>

                    <th><label for="genre">Genre</label></th>

                    <td><?php if(isset($errgenre)){echo $errgenre;}?><br>

                        <input type="text" name="genre" id="genre"

                               placeholder="Required Genre"

                               value="<?php if(isset($genre)){echo $genre;}?>"></td>

                </tr>

                <tr>

                    <th><label for="submit">Submit</label></th>

                    <td><input type="submit" name="submit" id="submit"></td>

                </tr>

            </table>

        </fieldset>

    </form>



    <?php

}//end showform

require_once "footer.php";

?>
