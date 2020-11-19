<?php
require_once "backheader.php";
$showform = 1;
$id = $_GET['ID'];
$errmsg = 0;
$errfname = "";
$errlname = "";
$erruname = "";
$errpwd = "";
$erraccesslvl = "";

echo $id;
if ($showform == 1) {

try {
      $sql = "SELECT * FROM employee WHERE emp_id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      $row = $stmt->fetch();
  }
  catch (PDOException $e) {
      die($e->getMessage());
  }
  $fname = $row['emp_fname'];
  $lname = $row['emp_lname'];
  $uname = $row['emp_user'];

if( isset($_POST['thesubmit']) ) //if the user submits
  		{
        $id = $_GET['ID'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = trim(strtolower($_POST['username']));
        $pwd = $_POST['pass'];
        $pwd2 = $_POST['conpass'];
        $accesslvl = $_POST['accesslvl'];

        if (empty($fname)) {
            $errfname = "<center><span class='error'>Your first name is required</span></center>";
            $errmsg = 1;
        }

        if (empty($lname)) {
            $errlname = "<center><span class='error'>Your last name is required</span></center>";
            $errmsg = 1;
        }

        if (empty($uname)) {
            $erruname = "<center><span class='error'>The username is required</span></center>";
            $errmsg = 1;
        }

        if (empty($pwd)) {
            $errpwd = "<center><span class='error'>The password is required</span></center>";
            $errmsg = 1;
        }

        if (empty($pwd2)) {
            $errpwd2 = "<center><span class='error'>You must confirm your password</span></center>";
            $errmsg = 1;
        }

        if (empty($accesslvl)) {
            $erraccesslvl = "<center><span class='error'>The access level is required</span></center>";
            $errmsg = 1;
        }

        if ($pwd != $pwd2) {
            $errpwd2 = "<center><span class='error'>The passwords do not match</span></center>";
            $errmsg = 1;
        }


        $sql = "SELECT * FROM employee WHERE emp_user = ?";
        $count = checkDup($pdo, $sql, $uname);
        if($count > 0) {
            $errmsg = 1;
            $erruname = "<center><span class='error'>The username is already taken.</span></center>";
        }

        if($errmsg == 1){
            echo "<center><p class='error'>There are errors.  Please make corrections and resubmit.</p></center>";
        }
        else{

            $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

            try{
                $sql = "UPDATE employee SET emp_fname = :bvfname, emp_lname = :bvlname, emp_user = :bvuname,
                  emp_pass = :bvpwd, emp_accesslvl = :bvaccesslvl WHERE emp_id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':bvfname', $fname);
                $stmt->bindValue(':bvlname', $lname);
                $stmt->bindValue(':bvuname', $uname);
                $stmt->bindValue(':bvpwd', $hashedpwd);
                $stmt->bindValue(':bvaccesslvl', $accesslvl);
                $stmt->bindValue(':id', $id);
                $stmt->execute();
                $showform = 0;
                echo "<center><p>Employee Update was successful!</p></center>";        }
            catch (PDOException $e) {
                die($e->getMessage());
            }
        }
}
    ?>
    <br><br>
    <div class="loginblock">
    <form name="employeeform" id="employeeform" method="POST">
    <?php
    if (isset($errfname)) {
        echo "$errfname<br>";
    }
    ?>
    <label for="fname">First Name:</label><input type="text" name="fname" id="fname" maxlength="50" size="25" value="<?php echo $fname;?>"><br>
    <?php
    if (isset($errlname)) {
        echo "$errlname<br>";
    }
    ?>
    <label for="lname">Last Name:</label><input type="text" name="lname" id="lname" maxlength="50" size="25" value="<?php echo $lname;?>"><br>
    <?php
    if (isset($erruname)) {
        echo "$erruname<br>";
    }
    ?>
    <label for="username">Username:</label><input type="text" required name="username" id="username" maxlength="50" size="25" value="<?php echo $uname;?>"><br>
    <?php
    if (isset($errpwd)) {
        echo "$errpwd<br>";
    }
    ?>
    <label for="pass">Password:</label><input type="password" required name="pass" id="pass" maxlength="50" size="25"><br>
    <?php
    if (isset($errpwd2)) {
        echo "$errpwd2<br>";
    }
    ?>
    <label for="conpass">Confirm Password:</label><input type="password" required name="conpass" id="conpass" maxlength="50" size="25">
    <br><br>
    <?php
    if (isset($erraccesslvl)) {
        echo "$erraccesslvl";
    }
    ?>
    <center>
    <p>Please select Access Level:</p>
    <input type="radio" id="1" name="accesslvl" value="1">
    <label for="1">Entry Level</label>
    <input type="radio" id="2" name="accesslvl" value="2">
    <label for="2">Associate</label>
    <input type="radio" id="3" name="accesslvl" value="3">
    <label for="3">Manager</label>
    <br><br>
    <br><input type="submit" name="thesubmit" id="submit" value="Update"/>
    </form>
  </center>
  </div>
  </center>
<?php
}
require_once "footer.php";
