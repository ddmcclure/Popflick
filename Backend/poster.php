<?php
include_once "backheader.php";


//SET INITIAL VARIABLES
$rightnow = time();
$showform = 1;  // show form is true
$errmsg = 0;
$errfile = "";

    $ID = $_GET['ID'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    echo "<h3>Initial Content of Files</h3>";
    print_r($_FILES);
    echo "<hr>";

    // FILE - ERROR CHECKING
    if ($_FILES['myfile']['error'] == 0) {
        echo $_FILES['myfile']['name'] . "<br>";

        $userfile = $_FILES['myfile']['name'];
        echo "<p><strong>User File:</strong>" . $userfile . "</p>";
        $pathparts = pathinfo($userfile);
        echo "<h3>Path Parts print_r</h3>";
        print_r($pathparts);
        echo "<hr>";

        $extension = strtolower($pathparts['extension']);
        $finalfile = "mrchamber_" . $rightnow . "." . $extension;
        echo "<p><strong>Final File: </strong>" . $finalfile . "</p>";
        $workingfile = "/var/www/html/uploads/" . $finalfile;
        echo "<p><strong>Working File: </strong>" . $workingfile . "</p>";

        if (file_exists($workingfile))
        {
            $errmsg =1;
            $errfile .= " File already exists!";
        }

        if($extension != "gif" && $extension != "jpg" && $extension != "jpeg" && $extension != "png")
        {
            $errmsg =1;
            $errfile .="<p>File must end in gif, jpg, jpeg, or png";
        }else{
            $imginfo = getimagesize($_FILES['myfile']['tmp_name']);
            echo "<h3>Image Info print_r</h3>";
            print_r($imginfo);
            echo "<hr>";
            echo"<p>The image width is " . $imginfo[0] . " and height is " . $imginfo[1] . "</p>";
            if ($imginfo[0] > 4000 || $imginfo[1] > 6000)
            {
                $errmsg = 1;
                $errfile .="<p>Your image is too big</p>";
            }
        }
    } else {
        $errmsg = 1;
        $errfile .= "<p>Cannot process file!</p>";
    }

    /* ***********************************************************************
      * CONTROL STATEMENT TO HANDLE ERRORS
      * ***********************************************************************
      */
    if ($errmsg == 1) {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    } else {
        if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $workingfile))
        {
            echo "<p class='error'>Could not move file</p>";
        } else {
            echo "<p class='success'>Your file has been uploaded.<br>";
            echo "<p>You can view your file at <a href='/uploads/" . $finalfile . "' target='_blank'>" . $finalfile . "</a></p> ";

            $sql = "UPDATE Movies SET poster = :poster WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':ID', $ID);
            $stmt->bindValue(':poster', $finalfile);
            $stmt->execute();
            $showform = 0;
        }

    } // else errormsg
}//submit

//display form if Show Form Flag is true
if ($showform == 1) {
    ?>
    <form name="fileupload" id="fileupload" method="post" action="<?php $currentfile;?>" enctype="multipart/form-data">
        <table>
            <tr><th><label for="myfile">Upload Your File:</label><span class="error">*</span></th>
                <td><input type="file" name="myfile" id="myfile" >
                    <span class="error"><?php if (isset($errfile)) {
                            echo $errfile;
                        }?></span></td>
            </tr>
            <tr><th><label for="submit">Submit:</label></th>
                <td><input type="submit" name="submit" id="submit" value="UPLOAD"/></td>
            </tr>

        </table>
    </form>
    <?php
}//end showform
include_once "footer.php";