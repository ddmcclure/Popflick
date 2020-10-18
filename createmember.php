<?php
//this should definitely be cleaned up but i've worked for like 3 hours on it i'll do it later
require_once "header.php";
$showform = 1;
$errmsg = 0;
$errfname = "";
$errlname = "";
$erruname = "";
$errpwd = "";
$errphone = "";
$erraddress = "";
$errcity = "";
$errstat = "";
$errzip = "";
$erremail = "";
$errpoints = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = trim(strtolower($_POST['username']));
    $pwd = $_POST['pass'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $stat = $_POST['stat'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $pwd2 = $_POST['conpass'];
    $lateFee = 0;
    $points = $_POST['points'];

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

    if (empty($phone)) {
        $errphone = "<span class='error'>You must enter a 10 digit phone number</span>";
        $errmsg = 1;
    }

    if (empty($address)) {
        $erraddress = "<span class='error'>You must enter your address.</span>";
        $errmsg = 1;
    }

    if (empty($city)) {
        $errcity = "<span class='error'>You must enter your city.</span>";
        $errmsg = 1;
    }

    if (empty($stat)) {
        $errstat = "<span class='error'>You must enter your state.</span>";
        $errmsg = 1;
    }

    if (empty($zip)) {
        $errzip = "<span class='error'>You must enter your 5 digit zip code.</span>";
        $errmsg = 1;
    }

    if (empty($email)) {
        $erremail = "<span class='error'>An email is required</span>";
        $errmsg = 1;
    }

    if (isset($_POST['lateFee']) && ($_POST['lateFee'] == 1)) {
        $lateFee = 1;
    }

    if (empty($points)) {
        $errpoints = "<span class='error'>Please enter amount of points</span>";
        $errmsg = 1;
    }

    if ($pwd != $pwd2) {
        $errpwd2 = "<span class='error'>The passwords do not match</span>";
        $errmsg = 1;
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $erremail ="<span class='error'>The email is not a valid email.</span>";
        $errmsg = 1;
    }

    $sql = "SELECT * FROM Members WHERE Username = ?";
    $count = checkDup($pdo, $sql, $uname);
    if($count > 0) {
        $errmsg = 1;
        $erruname = "<span class='error'>The username is already taken.</span>";
    }

    if($errmsg == 1){
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{
        echo "<p class='success'>Account creation was successful!</p>";

        $hashedpwd = password_hash($pwd, PASSWORD_BCRYPT);

        try{
            $sql = "INSERT INTO Members (FirstName, LastName, Username, Password, PhoneNumber, 
                    Address, City, MemState, Zip, Email, HasLateFee, Points)
                    VALUES (:fname, :lname, :uname, :pwd, :phone, :address, :city, :stat, :zip, :email, :late, :points)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fname', $fname);
            $stmt->bindValue(':lname', $lname);
            $stmt->bindValue(':uname', $uname);
            $stmt->bindValue(':pwd', $hashedpwd);
            $stmt->bindValue(':phone', $phone);
            $stmt->bindValue(':address', $address);
            $stmt->bindValue(':city', $city);
            $stmt->bindValue(':stat', $stat);
            $stmt->bindValue(':zip', $zip);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':late', $lateFee);
            $stmt->bindValue(':points', $points);
            $stmt->execute();
            $showform = 0;
            echo "<p class='success'>Thank you for entering your information.</p>";
            echo "<p><a href='members.php'>Log In</a></p>";
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
            <h1>Member Account Creation</h1>
    </div>
    <form name="memberform" id="memberform" method="POST" action="createmember.php">
    <h3>Account Information</h3>
    <?php
    if (isset($erruname)) {
        echo "$erruname<br>";
    }
    ?>
    <label for="username">Username:</label><input type="text" name="username" id="username" maxlength="255" size="50" value="<?php if(isset($uname)) {echo $uname;}?>"><br>
    <?php
    if (isset($erremail)) {
        echo "$erremail<br>";
    }
    ?>
    <label for="email">Email:</label><input type="email" name="email" id="email" maxlength="255" size="50" value="<?php if(isset($email)) {echo $email;}?>"><br>
    <?php
    if (isset($errpwd)) {
        echo "$errpwd<br>";
    }
    ?>
    <label for="pass">Password:</label><input type="password" name="pass" id="pass" maxlength="255" size="50" value="<?php if(isset($pwd)) {echo $pwd;}?>"><br><br>
    <?php
    if (isset($errpwd2)) {
        echo "$errpwd2<br>";
    }
    ?>
    <label for="conpass">Confirm Password:</label><input type="password" name="conpass" id="conpass" maxlength="255" size="50">
    <h3>Member Information</h3>
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
    if (isset($errphone)) {
        echo "$errphone<br>";
    }
    ?>
    <label for="phone">Phone Number:</label><input type="text" name="phone" id="phone" maxlength="10" size="50" value="<?php if(isset($phone)) {echo $phone;}?>"><br>
    <?php
    if (isset($erraddress)) {
        echo "$erraddress<br>";
    }
    ?>
    <label for="address">Address</label><input type="text" name="address" id="address" maxlength="255" size="50" value="<?php if(isset($address)) {echo $address;}?>"><br>
    <?php
    if (isset($errcity)) {
        echo "$errcity<br>";
    }
    ?>
    <label for="city">City:</label><input type="text" name="city" id="city" maxlength="255" size="50" value="<?php if(isset($city)) {echo $city;}?>"><br>
    <?php
    if (isset($errstat)) {
        echo "$errstat<br>";
    }
    ?>
    <label for="stat">State:</label><input type="text" name="stat" id="stat" maxlength="2" size="50" value="<?php if(isset($stat)) {echo $stat;}?>"><br>
    <?php
    if (isset($errzip)) {
        echo "$errzip<br>";
    }
    ?>
    <label for="zip">Zip Code:</label><input type="text" name="zip" id="zip" maxlength="5" size="50" value="<?php if(isset($zip)) {echo $zip;}?>"><br>
    <h3>Testing Purposes Only</h3>
        <label for="lateFee">Has a Late Fee:</label><input type="checkbox" name="lateFee" id="lateFee" value="1"><br>
        <?php
        if (isset($errpoints)) {
            echo "$errpoints<br>";
        }
        ?>
        <label for="points">Points:</label><input type="text" name="points" id="points" maxlength="5" size="50" value="<?php if(isset($points)) {echo $points;}?>"><br>
    <input type="submit" name="submit" id="submit" value="Submit"/>
    </form>
  </div>
  </center>
<?php
}
require_once "footer.php";
