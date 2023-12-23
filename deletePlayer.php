<?php
// Include the classes
include_once 'classes.php';

// Start the session
session_start();

// Function to get team by name
function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}

// Function to remove a player from a team by ID
function removePlayerFromTeam($teamName, $playerId) {
    $team = getTeamByName($teamName);
    if ($team) {
        $team->removePlayerById($playerId);
    }
}

// Function to delete a player by ID
function deletePlayerById($playerId) {
    foreach ($_SESSION['players'] as $key => $player) {
        if ($player instanceof Player && $player->getId() == $playerId) {
            unset($_SESSION['players'][$key]);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .action-button {
            padding: 8px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>Players Information</h1>

    <?php
    
    
    // Display players information
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Team</th><th>Actions</th></tr>";
    foreach ($_SESSION['players'] as $player) {
        if ($player instanceof Player) {
            echo "<tr>";
            echo "<td>{$player->getId()}</td>";
            echo "<td>{$player->getName()}</td>";
            echo "<td>{$player->getAge()}</td>";
            echo "<td>{$player->getTeam()}</td>";
            echo "<td class='action-buttons'>";
            echo "<span class='action-button' onclick=\"removePlayer('{$player->getTeam()}', '{$player->getId()}')\">Remove from Team</span>";
            echo "<span class='action-button' onclick=\"deletePlayer('{$player->getId()}')\">Delete</span>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    ?>

 

</body>
</html>
