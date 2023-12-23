
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
 
    <?php
    // session_start();
    include_once 'classes.php';
    




    if (!isset($_SESSION['players'])) {
        $_SESSION['players'] = [];
    }
    
    //if request method is post(form)
    //then get attributes
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission
        $name = $_POST['name'];
        $id = $_POST['id'];
        $age = $_POST['age'];

        // $newPlayer = new Player($id, $name, $age);
        // $players[] = $newPlayer;
        
        //create object newplayer
        //add object to array of player
        $newPlayer = new Player($id, $name, $age);
        $_SESSION['players'][] = $newPlayer;
       
        echo "<p>success! Enter another player.</p>";
        // echo "<p>Name : $name</p>";
        // echo "<p>Age : $age</p>";
        
        //iterate to display all data
        //test if it works withouy getter
        //or use previous comment to print only recent entered player
        // foreach ($_SESSION['players'] as $player) {
        //     echo "ID: " . $player->getId() . "<br>";
        //     echo "Name: " . $player->getName() . "<br>";
        //     echo "Age: " . $player->getAge() . "<br><br>";
        // }
    }
    ?>

<title>Enter a Player</title>

<body>

<div class="form-container">
    <form method="post" action="player.php">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>

        <label for="name">Player Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" required>

        <button type="submit">Submit</button>
    </form>
    <a href="index.php">MAIN</a>
</div>

</body>
</html>
