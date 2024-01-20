<?php

include_once 'classes.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (isset($_POST['selected_team'])) {
        $selectedTeamName = $_POST['selected_team'];
        $selectedTeam = getTeamByName($selectedTeamName);


        if ($selectedTeam) {
            echo "<h2>Team Information</h2>";
            echo "<table>";
            echo "<tr><th>Name</th><th>Location</th><th>Number of Players</th></tr>";
            echo "<tr><td>{$selectedTeam->getName()}</td><td>{$selectedTeam->getLocation()}</td><td>{$selectedTeam->getNbOfPlayers()}</td></tr>";
            echo "</table>";
        
            echo "<h2>Players</h2>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Action</th></tr>";
        
            foreach ($selectedTeam->getPlayers() as $player) {
                echo "<tr>";
                echo "<td>{$player->getId()}</td>";
                echo "<td>{$player->getName()}</td>";
                echo "<td>{$player->getAge()}</td>";
                echo "<td>";
        
                // Add the delete form for each player
                echo "<form method='post' action='deletebutton.php' style='display: inline; margin-right: 5px;'>";
                echo "<input type='hidden' name='player_id' value='{$player->getId()}'>";
                echo "<button type='submit' name='delete_player'>Delete</button>";
                echo "</form>";
        
                echo "</td>";
                echo "</tr>";
            }
        
            echo "</table>";
        } else {
            echo "<p>Team not found</p>";
        }
    } else {
        echo "<p>No team selected</p>";
    }
}


function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Information</title>
</head>
<body>

    <h1>Select Team:</h1>
    
    <form method="post" action="">
        <label for="selected_team">Choose a team:</label>
        <select id="selected_team" name="selected_team" required>
            <?php
           
            foreach ($_SESSION['players'] as $team) {
                if  ($team instanceof Team){
                echo "<option value='{$team->getName()}'>{$team->getName()}</option>";
            }
        }
            ?>
        </select>

        <br>

        <button type="submit">Show Team Information</button>
    </form>
    <a href="index.php">MAIN</a>
</body>
</html>
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
    </style>
