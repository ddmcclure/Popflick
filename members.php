<?php
require_once "header.php";
$showform = 1;
$errormsg = 0;
$erruname = "";
$errpwd = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $uname = trim(strtolower($_POST['uname']));
    $pwd = $_POST['pwd'];

    if (empty($uname)) {
        $erruname = "You must enter a username.";
        $errormsg = 1;
    }
    if (empty($pwd)) {
        $errpwd = "You must enter a password.";
        $errormsg = 1;
    }

    if($errormsg == 1) {
        echo "<p class='error'>There are errors. Please make corrections and resubmit.</p>";
    }
    else {
        try {
            $sql = "SELECT * FROM Members WHERE Username = :uname";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':uname', $uname);
            $stmt->execute();
            $row = $stmt->fetch();
            if (password_verify($pwd, $row['Password'])) {
                echo "<p class='success'>Login successful!</p>";
                $_SESSION['ID'] = $row['ID'];
                $_SESSION['uname'] = $row['Username'];
                header("Location: confirm.php?state=2");
            }
            else {
                echo "<p class='error'>The username and password you entered is not correct. Please try again.</p>";
            }
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
if($showform == 1) {
?>

    <center>
      <p>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </p>
    <div class="loginblock">
    <form name="login" id="login" method="POST" action="members.php">
        <table>
            <tr><th><label for="uname">Username:</label><span class="error">*</span></th>
                <td><input name="uname" required id="uname" type="text" placeholder="Username"
                    value="<?php if(isset($uname)) {
                        echo $uname;
                    }?>" /><span class="error"><?php if(isset($erruname)){echo $erruname;}?></span></td>
            </tr>
            <tr><th><label for="pwd">Password:</label><span class="error">*</span></th>
                <td><input name="pwd" required id="pwd" type="password" placeholder="Required Password"/>
                    <span class="error"><?php if(isset($errpwd)){echo $errpwd;}?></span></td>
            </tr>
            <tr><th><label for="submit"></label></th>
                <td><input type="submit" name="submit" id="submit" value="submit"/></td>
            </tr>
        </table>
    </form>

    <p>Not a member? <a href="createmember.php">Click here</a> to learn more about our membership program, and sign up to be a member!</p>
    </div>
  </center>
  <p>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </p>

<?php
}
require_once "footer.php";
