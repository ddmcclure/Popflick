<?php
require_once "backheader.php";

if(isset($_SESSION['emploginid']))
{
    echo "<p class='error'>You are already logged in.</p>";
    include_once 'footer.php';
    exit(); //exit
}
//declare variables
$showform = 1;
$errormsg = '';

if(isset ($_POST['submit'])) {

	$formfield['ffuname'] = strtolower(trim($_POST['uname']));
	$formfield['ffpassword'] = trim($_POST['password']);

	if(empty($formfield['ffuname'])) { $errormsg .= '<p>USERNAME IS MISSING</p>';}
	if(empty($formfield['ffpassword'])) { $errormsg .= '<p>PASSWORD IS MISSING</p>';}

	if($errormsg != '') {
		echo "<p>THERE ARE ERRORS</p>" . $errormsg; //output error
	}
	else //if there are no errors
	{
		try
		{
			$sql = 'SELECT * FROM employee WHERE emp_user = :bvuname';
			$s = $pdo->prepare($sql);
			$s->bindValue(':bvuname', $formfield['ffuname']);
			$s->execute();
			$count = $s->rowCount();
		}
		catch (PDOException $e) //if any errors occur during the above process
		{
			echo "ERROR!!!" . $e->getMessage(); //print error to user
			exit(); //exit
		}

		if($count < 1)
		{
			echo '<center><p>The username or password is incorrect</p></center>'; //print error
		}
		else
		{
			$row = $s->fetch(); //fetch all data from the database

			$confirmedpw = $row['emp_pass']; //get users password
			if (password_verify($formfield['ffpassword'], $confirmedpw)) //if users password matches one entered into form
			{

				$_SESSION['emploginid']= $row['emp_id']; //set session variables for the staff id
        $_SESSION['emploginname'] = $row['emp_user'];
				$_SESSION['emploginaccess'] = $row['emp_accesslvl'];
				$_SESSION['empemployed'] = $row['emp_employed'];
				$showform = 0; //hide the form field information
				echo "<br>";
                echo "<p>Logged In Successfully</p>"; //tell user that login was successful
                header("Location: confirm.php?state=2");

			}
			else
			{
				echo '<center><p>The username or password you entered is incorrect</p></center>'; //if password incorrect throw ambiguous incorrect error
			}
		}
	}
}
if($showform == 1) //if  user hasn't logged in
{
//HTML below is the login form
?>

<br><br><center>
<h1>Employee Login</h1>
</center>
<div class="loginblock">
<form name = "loginForm" id = "loginForm" method = "post" action = "employeelogin.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="uname" id = "uname" placeholder="Username" maxlength="255" size="50" required></td>
		</tr><tr>
			<td>Password:</td>
			<td><input type="password" name="password" id = "password" placeholder="Password" maxlength="255" size="50" required></td>
		</tr><tr>
			<td></td>
			<td><input type ="submit" class="button" name= "submit" value = "Login" ></td>
		</tr>
	</table>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</form>
<?php
}
require_once "footer.php";
