<?php

include_once 'classes.php';

// session_start();


function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}


function removePlayerFromTeam($teamName, $playerId) {
    $team = getTeamByName($teamName);
    if ($team) {
        $team->removePlayerById($playerId);
    }
}

 function deletePlayerById($playerId) {
    
    foreach ($_SESSION['players'] as $key => $player) {
    
        if ($player instanceof Player && $player->getId() == $playerId) {
            
            $teamName = $player->getTeam();
    
         
            $team = getTeamByName($teamName);
            if ($team) {
                $team->removePlayerById($playerId);
            }
    
            
            unset($_SESSION['players'][$key]);
    
            break;
        }
    }
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // on delete
    if (isset($_POST['delete_player'])) {
        $playerIdToDelete = $_POST['player_id'];
        deletePlayerById($playerIdToDelete);
    }

    // if remove is presses
    if (isset($_POST['remove_from_team'])) {
        $playerIdToRemove = $_POST['player_id'];
        $teamNameToRemoveFrom = $_POST['team_name'];
        removePlayerFromTeam($teamNameToRemoveFrom, $playerIdToRemove);
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

            
            echo "<form method='post' action='deletePlayer.php' style='display: inline; margin-right: 5px;'>";
            echo "<input type='hidden' name='player_id' value='{$player->getId()}'>";
            echo "<button type='submit' name='delete_player'>Delete</button>";
            echo "</form>";

            // Form to remove player from team
          // Form to remove player from team
        //   echo "<form method='post' action='removePlayerFromTeam.php' style='display: inline;'>";
        //   echo "<input type='hidden' name='player_id' value='{$player->getId()}'>";
        //   echo "<input type='hidden' name='team_name' value='{$player->getTeam()}'>";
        //   echo "<button type='submit' name='remove_from_team'>Remove from Team</button>";
        //   echo "</form>";


            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    ?>

</body>
</html>
