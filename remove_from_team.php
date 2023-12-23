<?php
// Start the session


// Include the classes
include_once 'classes.php';

// Function to get team by name
function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}

// Check if team and player parameters are provided in the URL
if (isset($_GET['team']) && isset($_GET['player'])) {
    // Include the Player class definition
    include_once 'classes.php';

    $teamName = $_GET['team'];
    $playerId = $_GET['player'];

    // Remove the player from the team
    $team = getTeamByName($teamName);
    if ($team) {
        $team->removePlayerById($playerId);
    }

    // Redirect back to the players information page
    header("Location: deletePlayer.php");
    exit();
} else {
    // Redirect to the main page if parameters are missing
    header("Location: index.php");
    exit();
}
?>
