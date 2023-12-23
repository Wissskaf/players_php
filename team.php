<?php

// session_start();
include_once 'classes.php';


if (!isset($_SESSION['teams'])) {
    $_SESSION['teams'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $name = $_POST['name'];
    $location = $_POST['location'];
    $nbOfPlayers = $_POST['nbOfPlayers'];

   
    
    //create object newTeam
    //add object to array of player
    $newTeam = new Team($name, $location, $nbOfPlayers);
    $_SESSION['players'][] = $newTeam;
   
    //add breakline
    echo "<p>Name : $name </p>";
    // echo "<br>";
    echo "<p>Location : $location</p>";
    echo "<p>Number Of Players : $nbOfPlayers</p>";

}

?>

<title>Enter a Team</title>

<body>
<div class="form-container">

<form method="post" action="team.php">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="nbOfPlayers">Number of Players:</label>
        <input type="number" id="nbOfPlayers" name="nbOfPlayers" required>

        <button type="submit">Submit</button>
    </form>
    <a href="index.php">MAIN</a>
</div>
</body>

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

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
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
    </style>