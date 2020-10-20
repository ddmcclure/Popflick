<?php
require_once "header.php";
$errmsg = 0;
$success = 0;
echo "<center><h2>Member Rewards</h2>";
try {
    $sql = "SELECT * FROM Members WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
}
catch (PDOException $e) {
    die($e->getMessage());
}

$lateFee = $row['HasLateFee'];
$points = $row['Points'];

$rewardType = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $rewardType = $_POST['reward'];
    if ($rewardType == 'forgive') {
        if ($points - 50 < 0) {
            $errmsg = 1;
        }
        else {
            $points = $points - 50;
            $sql = "UPDATE Members SET HasLateFee = :fee, Points = :points WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fee', 0);
            $stmt->bindValue(':points', $points);
            $stmt->bindValue(':id', $_SESSION['ID']);
            $stmt->execute();
            $success = 1;
            $lateFee = 0;
        }
    }
    if ($rewardType == 'late') {
        $sql = "UPDATE Members SET HasLateFee = :fee WHERE ID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':fee', 1);
        $stmt->bindValue(':id', $_SESSION['ID']);
        $stmt->execute();
        $success = 1;
        $lateFee = 1;
    }
    if ($rewardType == 'free') {
        if ($points - 25 < 0) {
            $errmsg = 1;
        }
        else {
            $points = $points - 25;
            $sql = "UPDATE Members SET HasLateFee = :fee, Points = :points WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fee', 0);
            $stmt->bindValue(':points', $points);
            $stmt->bindValue(':id', $_SESSION['ID']);
            $stmt->execute();
            $success = 1;
            $lateFee = 0;
        }
    }
    if ($rewardType == 'card') {
        if ($points - 100 < 0) {
            $errmsg = 1;
        }
        else {
            $points = $points - 100;
            $sql = "UPDATE Members SET HasLateFee = :fee, Points = :points WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':fee', 0);
            $stmt->bindValue(':points', $points);
            $stmt->bindValue(':id', $_SESSION['ID']);
            $stmt->execute();
            $success = 1;
            $lateFee = 0;
        }
    }
}

if ($errmsg == 1) {
    echo "<p class='error'>You do not have enough points to redeem this award.</p>";
}

if ($success == 1) {
    echo "<p class='success'>Reward redeemed successfully!</p>";
}

if ($lateFee == 1) {
    echo "<div class='aboutusblock'>
            <form name='lateFeeForgive' id='lateFeeForgive' method='POST' action='rewards.php'>
                <h1>Late Fee Forgiveness</h1>
                <p>Removes the late fee you have accumulated on your account!</p>
                <p>Cost: 50 points</p>
                <label for='reward'><input name='reward' id='reward' type='hidden' value='forgive'></label>
                <input type='submit' name='submit' id='submit' value='Redeem'/>
            </form>
          </div><br>";
}
else {
    echo "<div class='aboutusblock'>
            <form name='lateFeeAdd' id='lateFeeAdd' method='POST' action='rewards.php'>
                <h1>Testing Purposes Only: Add Late Fee</h1>
                <p>Adds a late fee to currently logged in account.</p>
                <p>Cost: 0 points</p>
                <label for='reward'><input name='reward' id='reward' type='hidden' value='late'></label>
                <input type='submit' name='submit' id='submit' value='Redeem'/>
            </form>
          </div><br>";
}
echo "<div class='aboutusblock'>
            <form name='freeMovie' id='freeMovie' method='POST' action='rewards.php'>
                <h1>Free Movie Rental</h1>
                <p>Allows rental of one free movie!</p>
                <p>Cost: 25 points</p>
                <label for='reward'><input name='reward' id='reward' type='hidden' value='free'></label>
                <input type='submit' name='submit' id='submit' value='Redeem'/>
            </form>
          </div><br>";
echo "<div class='aboutusblock'>
            <form name='giftCard' id='giftCard' method='POST' action='rewards.php'>
                <h1>$10 Gift Card</h1>
                <p>Redeem for a $10 gift card to be used at any of our locations!</p>
                <p>Cost: 100 points</p>
                <label for='reward'><input name='reward' id='reward' type='hidden' value='card'></label>
                <input type='submit' name='submit' id='submit' value='Redeem'/>
            </form>
          </div><br></center>";

require_once "footer.php";
