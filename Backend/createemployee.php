<?php
require_once "backheader.php";
$showform = 1;
$errmsg = 0;
$errfname = "";
$errlname = "";
$erruname = "";
$errpwd = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = trim(strtolower($_POST['username']));
    $pwd = $_POST['pass'];
    $pwd2 = $_POST['conpass'];
    $accesslvl = $_POST['accesslvl'];

    if (empty($fname)) {
        $errfname = "<span class='error'>Your first name is required</span>";
        $errmsg = 1;
    }

    if (empty($lname)) {
        $errlname = "<span class='error'>Your last name is required</span>";
        $errmsg = 1;
    }

    if (empty($uname)) {
        $erruname = "<span class='error'>The username is required</span>";
        $errmsg = 1;
    }

    if (empty($pwd)) {
        $errpwd = "<span class='error'>The password is required</span>";
        $errmsg = 1;
    }

    if (empty($pwd2)) {
        $errpwd2 = "<span class='error'>You must confirm your password</span>";
        $errmsg = 1;
    }

    if (empty($accesslvl)) {
        $errpwd2 = "<span class='error'>The access level is required</span>";
        $errmsg = 1;
    }

    if ($pwd != $pwd2) {
        $errpwd2 = "<span class='error'>The passwords do not match</span>";
        $errmsg = 1;
    }

    $sql = "SELECT * FROM employee WHERE emp_user = ?";
    $count = checkDup($pdo, $sql, $uname);
    if($count > 0) {
        $errmsg = 1;
        $erruname = "<span class='error'>The username is already taken.</span>";
    }

    if($errmsg == 1){
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{
        echo "<p class='success'>Employee creation was successful!</p>";

        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

        try{
            $sql = "INSERT INTO employee (emp_fname, emp_lname, emp_user, emp_pass, emp_accesslvl)
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue('1', $fname);
            $stmt->bindValue('2', $lname);
            $stmt->bindValue('3', $uname);
            $stmt->bindValue('4', $hashedpwd);
            $stmt->bindValue('5', $accesslvl);
            $stmt->execute();
            $showform = 0;
            echo "<p class='success'>Thank you for entering your information.</p>";
            echo "<p><a href='index.php'>Log In</a></p>";
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
if ($showform == 1) {
    ?>
    <center>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <div class="loginblock">
    <div>
            <h1>Employee Creation</h1>
    </div>
    <form name="employeeform" id="employeeform" method="POST" action="createemployee.php">
    <?php
    if (isset($erruname)) {
        echo "$erruname<br>";
    }
    ?>
    <label for="fname">First Name:</label><input type="text" name="fname" id="fname" maxlength="255" size="50" value="<?php if(isset($fname)) {echo $fname;}?>"><br>
    <?php
    if (isset($errlname)) {
        echo "$errlname<br>";
    }
    ?>
    <br><label for="lname">Last Name:</label><input type="text" name="lname" id="lname" maxlength="255" size="50" value="<?php if(isset($lname)) {echo $lname;}?>"><br>
    <?php
    if (isset($errphone)) {
        echo "$errphone<br>";
    }
    ?>
    <br><label for="username">Username:</label><input type="text" name="username" id="username" maxlength="255" size="50" value="<?php if(isset($uname)) {echo $uname;}?>"><br>
    <?php
    if (isset($erremail)) {
        echo "$erremail<br>";
    }
    ?>
    <br><label for="pass">Password:</label><input type="password" name="pass" id="pass" maxlength="255" size="50" value="<?php if(isset($pwd)) {echo $pwd;}?>"><br><br>
    <?php
    if (isset($errpwd2)) {
        echo "$errpwd2<br>";
    }
    ?>
    <br><label for="conpass">Confirm Password:</label><input type="password" name="conpass" id="conpass" maxlength="255" size="50">
    <br><br><label for="pass">Access Level:</label><input type="text" name="accesslvl" id="accesslvl" maxlength="255" size="50" value="<?php if(isset($accesslvl)) {echo $accesslvl;}?>"><br><br>
    <?php
    if (isset($errpwd2)) {
        echo "$errpwd2<br>";
    }
    ?>

    <br><input type="submit" name="submit" id="submit" value="Submit"/>
    </form>
  </div>
  </center>
<?php
}
require_once "footer.php";
