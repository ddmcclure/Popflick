<?php
require_once "backheader.php";

if(isset($_SESSION['emploginid'])) //if the user is already logged in
{
    echo "<p class='error'>You are already logged in.</p>"; //this will output the user has already logged in
    include_once 'footer.php'; //include the footer file (if not there will not cause errors)
    exit(); //exit
}
//declare variables
$showform = 1; //this allows the input fields to be shown until the user is logged in
$errormsg = ''; //set the error message string to empty

if(isset ($_POST['submit'])) { //when the user hits the submit button

	$formfield['ffuname'] = strtolower(trim($_POST['uname'])); //this trims the and converts the users email to lowercase
	$formfield['ffpassword'] = trim($_POST['password']);

	if(empty($formfield['ffuname'])) { $errormsg .= '<p>USERNAME IS MISSING</p>';} //if fields are empty concatenate onto the error message string
	if(empty($formfield['ffpassword'])) { $errormsg .= '<p>PASSWORD IS MISSING</p>';} //if fields are empty concatenate onto the error message string

	if($errormsg != '') { //if the error message string isn't empty
		echo "<p>THERE ARE ERRORS</p>" . $errormsg; //output error
	}
	else //if there are no errors
	{
		try
		{
			$sql = 'SELECT * FROM employee WHERE emp_user = :bvuname'; //connect to database and get all info connected to the email entered
			$s = $pdo->prepare($sql); //prepare your SQL statement
			$s->bindValue(':bvuname', $formfield['ffuname']); //bind value for prepared statement to what the user has entered for email
			$s->execute(); //execute the prepared statement
			$count = $s->rowCount(); //count the returned information
		}
		catch (PDOException $e) //if any errors occur during the above process
		{
			echo "ERROR!!!" . $e->getMessage(); //print error to user
			exit(); //exit
		}

		if($count < 1) //if the count of the returned information is less than one, that means there is no info connected to the email entered
		{
			echo '<p>The username or password is incorrect</p>'; //print error
		}
		else
		{
			$row = $s->fetch(); //fetch all data from the database

			$confirmedpw = $row['emp_pass']; //get users password
			if (password_verify($formfield['ffpassword'], $confirmedpw)) //if users password matches one entered into form
			{
        echo '<p>AHHHHHH</p>';
				$_SESSION['emploginid']= $row['emp_id']; //set session variables for the staff id
        $_SESSION['emploginname'] = $row['emp_user']; //set session variables for the staff first name
				$_SESSION['emploginaccess'] = $row['emp_accesslvl'];  //set session variables for the staff permissions
				$_SESSION['empemployed'] = $row['emp_employed'];  //set session variables for the staff empolyed status
				$showform = 0; //hide the form field information
				echo "<br>";
                echo "<p>Logged In Successfully</p>"; //tell user that login was successful
				echo "<br>";
				echo '<script>window.location = "index.php";</script>'; //redirect to set URL
				echo "<br>";
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

<center>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<div class="loginblock">
<div>
        <h1>Employee Login</h1>
</div>
<!-- <p>You are not logged in.  Please log in</p> -->

<form name = "loginForm" id = "loginForm" method = "post" action = "employeelogin.php">
	<table>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="uname" id = "uname" required></td>
		</tr><tr>
			<td>Password:</td>
			<td><input type="password" name="password" id = "password" required></td>
		</tr><tr>
			<td></td>
			<td><input type ="submit" class="button" name= "submit" value = "submit"></td>
		</tr>
	</table>
</div>
</center>
<p>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </p>

</form>
<?php
}
require_once "footer.php";
