<?php
function checkDup($pdo, $sql, $userentry)
{
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $userentry);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        echo "<p class='error'>Error checking duplicate users!" . $e->getMessage() . "</p>";
        exit();
    }
}