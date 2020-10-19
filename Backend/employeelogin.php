<?php
require_once "backheader.php";
$showform = 1;
$errormsg = 0;
$erruname = "";
$errpwd = "";

if(isset($_SESSION['emp_id'])) {
    $showform = 0;
    echo "<h1>Employee Information</h1>";
    try {
        $sql = "SELECT * FROM employee WHERE emp_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_SESSION['emp_id']);
        $stmt->execute();
        $row = $stmt->fetch();
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    $fname = $row['emp_fname'];
    $lname = $row['emp_lname'];
    $uname = $row['emp_user'];
    $createdate = $row['emp_createdate'];

    echo "<p>Name: $fname $lname</p>";
    echo "<p>Username: $uname</p>";
    echo "<p>Account Created: $createdate</p>";
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $uname = trim(strtolower($_POST['emp_user']));
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
            $sql = "SELECT * FROM employee WHERE emp_user = :uname";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':emp_user', $uname);
            $stmt->execute();
            $row = $stmt->fetch();
            if (password_verify($pwd, $row['emp_pass'])) {
                echo "<p class='success'>Login successful!</p>";
                $_SESSION['emp_id'] = $row['emp_id'];
                $_SESSION['uname'] = $row['emp_user'];
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
    <form name="login" id="login" method="POST" action="emplopyeelogin.php">
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
    </div>
  </center>
  <p>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </p>

<?php
}
require_once "footer.php";
