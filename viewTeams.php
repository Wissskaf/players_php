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
            echo "<tr><th>ID</th><th>Name</th><th>Age</th></tr>";
            foreach ($selectedTeam->getPlayers() as $player) {
                echo "<tr><td>{$player->getId()}</td><td>{$player->getName()}</td><td>{$player->getAge()}</td></tr>";
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
<!-- <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        select {
            margin-bottom: 10px;
            text-align: center;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style> -->