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
            unset($_SESSION['players'][$key]);

            removePlayerFromTeam($teamName, $playerId);

            break;
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_player'])) {
        $playerIdToDelete = $_POST['player_id'];
        deletePlayerById($playerIdToDelete);
        header("Location: viewTeams.php");
        exit();
    }

    if (isset($_POST['remove_from_team'])) {
        $playerIdToRemove = $_POST['player_id'];
        $teamNameToRemoveFrom = $_POST['team_name'];
        removePlayerFromTeam($teamNameToRemoveFrom, $playerIdToRemove);
        header("Location: viewTeams.php");
        exit();
    }
}
?>
