<?php
require_once "backheader.php";
$showform = 1;
$errmsg = 0;
$errfname = "";
$errlname = "";
$erruname = "";
$errpwd = "";
$erraccesslvl = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
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
            echo "<p class='success'>Thank you for entering your information.</p>";        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
if ($showform == 1) {
    ?>
    <center>
    <div class="loginblock">
    <div>
            <h1>Employee Creation</h1>
    </div>
    <form name="employeeform" id="employeeform" method="POST" action="createemployee.php">
    <?php
    if (isset($errfname)) {
        echo "$errfname<br>";
    }
    ?>
    <label for="fname">First Name:</label><input type="text" name="fname" id="fname" maxlength="255" size="50" value="<?php if(isset($fname)) {echo $fname;}?>"><br>
    <?php
    if (isset($errlname)) {
        echo "$errlname<br>";
    }
    ?>
    <label for="lname">Last Name:</label><input type="text" name="lname" id="lname" maxlength="255" size="50" value="<?php if(isset($lname)) {echo $lname;}?>"><br>
    <?php
    if (isset($erruname)) {
        echo "$erruname<br>";
    }
    ?>
    <label for="username">Username:</label><input type="text" name="username" id="username" maxlength="255" size="50" value="<?php if(isset($uname)) {echo $uname;}?>"><br>
    <?php
    if (isset($errpwd)) {
        echo "$errpwd<br>";
    }
    ?>
    <label for="pass">Password:</label><input type="password" name="pass" id="pass" maxlength="255" size="50" value="<?php if(isset($pwd)) {echo $pwd;}?>"><br>
    <?php
    if (isset($errpwd2)) {
        echo "$errpwd2<br>";
    }
    ?>
    <label for="conpass">Confirm Password:</label><input type="password" name="conpass" id="conpass" maxlength="255" size="50">
    <br><br>
    <?php
    if (isset($erraccesslvl)) {
        echo "$erraccesslvl";
    }
    ?>

    <p>Please select Access Level:</p>
    <input type="radio" id="1" name="accesslvl" value="1">
    <label for="1">Entry Level</label>
    <input type="radio" id="2" name="accesslvl" value="2">
    <label for="2">Associate</label>
    <input type="radio" id="3" name="accesslvl" value="3">
    <label for="3">Manager</label>
    <br><br>
    <br><input type="submit" name="submit" id="submit" value="Submit Form"/>
    </form>
  </div>
  </center>
<?php
}
require_once "footer.php";
