<?php

// $_SESSION['players'] = [];
include_once 'classes.php';


// Assume you have a Player and Team class defined similarly to your previous code

// Check if there are teams and players in the session
// if (!isset($_SESSION['teams'])) {
//     $_SESSION['teams'] = [];
// }

if (!isset($_SESSION['players'])) {
    $_SESSION['players'] = [];
}

// Check if the form is submitted
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission for player assignment to a team
    if (isset($_POST['assign_team']) && isset($_POST['assigned_players'])) {
        $teamName = $_POST['assign_team'];
        $assignedPlayers = $_POST['assigned_players'];

        // Find the selected team
        $selectedTeam = null;
        foreach ($_SESSION['players'] as $team) {
            if ($team->getName() === $teamName) {
                $selectedTeam = $team;
                break;
            }
        }

        // Assign players to the selected team
        if ($selectedTeam) {
            foreach ($assignedPlayers as $playerId) {
                // Find the selected player
                foreach ($_SESSION['players'] as $player) {
                    if ($player instanceof Player && $player->getId() == $playerId) {
                        // Assign player to the team
                        $selectedTeam->addPlayer($player);
                        $player->setTeam($teamName);
                        break;
                    }
                }
            }

            echo "<p>Players assigned to Team: $teamName</p>";
        }
    }
}

?>



    

    <title>Assign Players to Teams</title>

<body>

<div class="form-container">
    <form method="post" action="assign.php">
        <label for="assign_team">Select Team:</label>
        <select id="assign_team" name="assign_team" required>
            <?php
            // Display available teams in the combo box
            foreach ($_SESSION['players'] as $team) {
           if  ($team instanceof Team) {
                echo "<option value='{$team->getName()}'>{$team->getName()}</option>";
            }
        }
            ?>
        </select>

        <br>

        <label>Select Players to Assign:</label>
<?php
// Display all players with checkboxes
foreach ($_SESSION['players'] as $player) {

    // Check if the current item is an instance of the Player class
    if ($player instanceof Player) {
        echo "<input type='checkbox' name='assigned_players[]' value='{$player->getId()}'>{$player->getId()} &nbsp; {$player->getName()}<br>";
    }
}


?>


<br>

<button type="submit">Assign Players</button>
    </form>
    <a href="index.php">MAIN</a>
</div>

</body>
</html>
<style>
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

    .form-container {
        text-align: center;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin: 10px 0;
    }

    select {
        margin-bottom: 10px;
        text-align: center;
    }

 

 

    input[type="checkbox"] {
        margin-right: 5px;
       
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
</style>
