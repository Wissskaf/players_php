<?php
// Start the session
session_start();

// Include the classes
include_once 'classes.php';

// Check if player parameter is provided in the URL
if (isset($_GET['player'])) {
    $playerId = $_GET['player'];

    // Loop through players and remove the player by ID
    foreach ($_SESSION['players'] as $key => $player) {
        if ($player instanceof Player && $player->getId() == $playerId) {
            unset($_SESSION['players'][$key]);
            break;
        }
    }

    // Redirect back to the players information page
    header("Location: deletePlayer.php");
    exit();
} else {
    // Redirect to the main page if parameter is missing
    header("Location: index.php");
    exit();
}
?>
