<?php

include_once 'classes.php';

function getAllTeams() {
    $teams = [];
    foreach ($_SESSION['players'] as $team) {
        if ($team instanceof Team) {
            $teams[] = $team;
        }
    }
    return $teams;
}

function deleteTeam($teamName) {
    foreach ($_SESSION['players'] as $key => $team) {
        if ($team instanceof Team && $team->getName() === $teamName) {
            unset($_SESSION['players'][$key]);
            break;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_team'])) {
        $teamNameToDelete = $_POST['delete_team'];
        deleteTeam($teamNameToDelete);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Teams Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-button {
            background-color: #ff5252;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #ff0000;
        }
    </style>
</head>
<body>

    <h1>All Teams Information</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>Number of Players</th>
            <th>Players</th>
            <th>Action</th>
        </tr>
        <?php
        $allTeams = getAllTeams();
        foreach ($allTeams as $team) {
            echo "<tr>";
            echo "<td>{$team->getName()}</td>";
            echo "<td>{$team->getLocation()}</td>";
            echo "<td>{$team->getNbOfPlayers()}</td>";
            echo "<td>";

            // Display players for each team
            $players = $team->getPlayers();
            foreach ($players as $player) {
                echo "{$player->getName()}, ";
            }

            echo "</td>";
            echo "<td>";
            echo "<form method='post' action='deleteTeam.php' style='display: inline;'>";
            echo "<input type='hidden' name='delete_team' value='{$team->getName()}'>";
            echo "<button type='submit' class='delete-button' name='delete_team_btn'>Delete</button>";
            echo "</form>";
            echo "</td>";
            
            echo "<td>";
            echo "<a href='showPlayersForTeam.php?team_name=" . urlencode($team->getName()) . "'>Display Players</a>";
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="index.php">MAIN</a>

</body>
</html>
