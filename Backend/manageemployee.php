<?php
require_once "backheader.php";
$showform = 0;

try {
    $sqlselectc = "SELECT * from employee";//SQL string
    $resultc = $pdo->prepare($sqlselectc); //prep statement
    $resultc->execute();//execute statement
    //$result = $pdo->query($sql);
  }
  catch (PDOException $e)
{
    die($e->getMessage());
}
?>
<center>
  <h1>Employee Management</h1>
<table class=employeeblock>
	<?php
	foreach ($resultc as $row){
	echo "<tr><td>".$row['emp_lname'].", ".$row['emp_fname']."</td>";
	echo "<td><a href='employeeupdate.php?ID=".$row['emp_id']."'>Update</a> </td>";
}
	echo "</tr>";
	?>
</table>
</center>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php
require_once "footer.php";
