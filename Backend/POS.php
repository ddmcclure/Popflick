<?php
//Developer(s): Blakley Parker
//Date: 11/4/2020
//Purpose: This is where staff create a order containing the movies the customer wants to buy

$showform = 1; //showfrom
$allowedperms = array(1,2,3);
$assignedperm = $_SESSION['emp_accesslvl']; //set assigned perm

  require_once "backheader.php"; //require header file
	require_once "connect.inc.php";  //require connection file


  <table class="ordertable">
			<?php
				echo '<tr>';
				while ($rowc = $resultc->fetch() )//gets all categories
					{
					echo '<th valign = "top" align = "center">' . $rowc['dbcatname'] . '<br>';
					echo '<table class="insideordertable">';
					$sqlselectp = "SELECT * from movies where ID = :bvID AND inventory <= 1";//SQL string
					$resultp = $db->prepare($sqlselectp);//prepare statment
					$resultp->bindValue(':bvID', $rowc['ID']); //bind value
					$resultp->execute();//execute prepared statement
					while ($rowp = $resultp->fetch() )//gets all items in the category
						{
							//form below are added values to each button
						echo '<tr><td>';
						echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">';
						echo '<input type = "hidden" name = "movieid" value = "'. $rowp['ID'] .'">';
						echo '<input type = "hidden" name = "orderitemprice" value = "'. $rowp['price'] .'">';
						echo '<input type="submit" class="button" name="OIEnter" value="'. $rowp['movie'] . ' - $'
							. $rowp['price'] .'">';
						echo '</form>';
						echo '</td></tr>';
						}
					echo '</table></th>';
						$counter = $counter +1;
					if ($counter >= 4){
						$counter = 0;
						echo '</tr><tr>';
					}
				}
echo '</tr>';
?>
</table>

  include_once 'footer.php';//include to footer once
?>
