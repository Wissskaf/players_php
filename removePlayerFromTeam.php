<?php
include_once 'classes.php';

session_start();


function getTeamByName($teamName) {
    foreach ($_SESSION['players'] as $team) {
        if ($team->getName() === $teamName) {
            return $team;
        }
    }
    return null;
}

// function to remove a player from a team by setting team value to ""
function removePlayerFromTeam($teamName, $playerId) {
    $team = getTeamByName($teamName);
    if ($team) {
        // update the session with the modified team
        foreach ($_SESSION['players'] as $key => $sessionTeam) {
            if ($sessionTeam->getName() === $teamName) {
                foreach ($sessionTeam->getPlayers() as $player) {
                    if ($player->getId() == $playerId) {
                        $player->setTeam(""); 
                        break;
                    }
                }
                $_SESSION['players'][$key] = $team;
                break;
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['player_id'], $_POST['team_name'])) {
        $playerIdToRemove = $_POST['player_id'];
        $teamNameToRemoveFrom = $_POST['team_name'];
        removePlayerFromTeam($teamNameToRemoveFrom, $playerIdToRemove);
        echo "<p>Player removed from the team successfully.</p>";
    }
}
?>
