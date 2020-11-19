<?php
//Developer(s): Blakley Parker
//Date: 11/4/2020
//Purpose: This is where staff create a order containing the movies the customer wants to buy

$showform = 1; //showfrom

  require_once "backheader.php"; //require header file
	require_once "connect.inc.php";  //require connection file

  //create a result set for movies
  $sqlselectc = "SELECT * from movies";//SQL string
  $resultc = $pdo->prepare($sqlselectc); //prep statement
  $resultc->execute();//execute statement
  $counter = 0
?>
  <br><br>
  <center>
    <h1> Enter Movies to Purchase </h1>
  <div class="movietable">
    <table>
			<?php
				echo '<tr>';
				while ($rowc = $resultc->fetch() )//gets all movies
					{
					$sqlselectp = "SELECT * from movies where ID = :bvID AND inventory >= 1";//SQL string
					$resultp = $pdo->prepare($sqlselectp);//prepare statment
					$resultp->bindValue(':bvID', $rowc['ID']); //bind value
					$resultp->execute();//execute prepared statement
					while ($rowp = $resultp->fetch() )
						{
							//form below are added values to each button
						echo '<td>';
						echo '<form action = "' . $_SERVER['PHP_SELF'] . '" method = "post">';
						echo '<input type = "hidden" name = "movieid" value = "'. $rowp['ID'] .'">';
						echo '<input type = "hidden" name = "movieprice" value = "'. $rowp['price'] .'">';
						echo '<input type="submit" class="button" name="moviesubmit" value="'. $rowp['movie'] . ' - $'. $rowp['price'] .'">';
						echo '</form>';
						echo '</td>';
						}
					echo '</th>';
						$counter = $counter +1;
					if ($counter >= 3){
						$counter = 0;
						echo '</tr><tr>';
					}
				}
echo '</tr>';
echo'</table>';
echo "</div>";
echo'</center>';
echo'<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
  include_once 'footer.php';//include to footer once
?>
