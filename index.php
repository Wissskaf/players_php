<html>
<title>Main</title>

<body>
    <!-- <h1> Wissam Skaf</h1> -->
    <div class="nav-container">
        <a href="player.php">Enter a player</a>
        <a href="team.php">Enter a Team</a>
        <a href="assign.php">Assign player to team</a>
        <a href="viewPlayers.php">All Players</a>
        <a href="viewTeams.php">View Team's Players</a>
        <a href="deletePlayer.php">Delete Player</a>
        <a href="allteams.php">All Teams</a>

        <!-- <a href="displayPlayer.php">Display all players in a team</a> -->
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

    .nav-container {
        text-align: center;
    }

    .nav-container a {
        display: block;
        margin: 10px 0;
        padding: 10px;
        text-decoration: none;
        color: #333;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .nav-container a:hover {
        background-color: #ddd;
    }
</style>