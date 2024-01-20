<?php

include_once 'classes.php';

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
header("Location: AllTeams.php");
exit();

?>
