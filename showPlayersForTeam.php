<?php

include_once 'classes.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['team_name'])) {
    $teamName = $_GET['team_name'];

    $team = null;
    foreach ($_SESSION['players'] as $existingTeam) {
        if ($existingTeam instanceof Team && $existingTeam->getName() === $teamName) {
            $team = $existingTeam;
            break;
        }
    }

    if ($team) {
        $players = $team->getPlayers();
    } else {
        
        header("Location: index.php");
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players for Team: <?php echo htmlspecialchars($teamName); ?></title>
    
</head>
<body>

    <h1>Players for Team: <?php echo htmlspecialchars($teamName); ?></h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
        </tr>
        <?php
        foreach ($players as $player) {
            echo "<tr>";
            echo "<td>{$player->getId()}</td>";
            echo "<td>{$player->getName()}</td>";
            echo "<td>{$player->getAge()}</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="index.php">MAIN</a>

</body>
</html>
