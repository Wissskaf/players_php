<?php
// Include the classes
include_once 'classes.php';

// // Start the session
// session_start();

// Function to get team by name
function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}
?>

<html>

    
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
    </style>
<title>Players Information</title>
<body>

    <h1>Players Information</h1>

    <?php
    // Display players information
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Team</th></tr>";
    foreach ($_SESSION['players'] as $player) {
        if ($player instanceof Player) {
            echo "<tr><td>{$player->getId()}</td><td>{$player->getName()}</td><td>{$player->getAge()}</td><td>{$player->getTeam()}</td></tr>";
        }
    }
    echo "</table>";
    ?>
    <a href="index.php">MAIN</a>

</body>
</html>
