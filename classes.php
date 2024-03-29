<?php
session_start();
//declare 2 structs
class Player {
    private $id;
    private $name;
    private $age;

    private $teamp;
    private $playersOfTeam = array();


    // dont use team constructor when creating new player
    //team will be added on later in (assign.php)
    public function __construct($id, $name, $age) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        // $this->$team = $team;
    }

    // Getter methods to retrieve player information
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function getTeam() {
        return $this->teamp;
    }
    //note: getters return value while setters return
    //arguments passed to it regardless
    //setters
    //to set team in assign.php
    public function setTeam($teamName) {
         $this->teamp = $teamName;
    }
    public function setPlayers($players) {
        $this->playersOfTeam = $players;
    }

    public function removePlayer($playerKey) {
        if (isset($this->playersOfTeam[$playerKey])) {
            unset($this->playersOfTeam[$playerKey]);
        }
    }
    
    
    public function removePlayerById($playerId) {
        $index = array_search($playerId, array_column($this->playersOfTeam, 'id'));

        if ($index !== false) {
            unset($this->playersOfTeam[$index]);
        }
    }

    function deletePlayerById($playerId) {
       
        foreach ($_SESSION['players'] as $key => $player) {
            
            if ($player instanceof Player && $player->getId() == $playerId) {
              
                unset($_SESSION['players'][$key]);
    
                
                $teamName = $player->getTeam();
    
                
                removePlayerFromTeam($teamName, $playerId);
    
                break;
            }
        }
    }
    
    
}

class Team {
    
    private $name;
    private $location;
    private $nbOfPlayers;
    
    // array of players (teamPlayers)
    private $playersOfTeam ;

   

//create empty array 
public function __construct ($name,$location,$nbOfPlayers ){

    $this->name = $name;
    $this->location = $location;
    $this->nbOfPlayers = $nbOfPlayers;
    // $this->playersOfTeam =  $playersOfTeam; 
}

public function removePlayer($player) {
    $index = array_search($player, $this->playersOfTeam);

    if ($index !== false) {
        unset($this->playersOfTeam[$index]);
    }
}
//getter
public function getName () {
    return $this->name;
}

public function getLocation () {
    return $this->location;
}

public function getNbOfPlayers () {
    return $this->nbOfPlayers;
}
public function addPlayer( $player) {
    $this->playersOfTeam[] = $player;
}



public function getPlayers() {
    return $this->playersOfTeam;
}
public function setPlayers($players) {
    $this->playersOfTeam = $players;
}


// Inside the Team class
public function removePlayerById($playerId) {
    foreach ($this->playersOfTeam as $key => $player) {
        if ($player instanceof Player && $player->getId() == $playerId) {
            // Remove the player from the session
            removePlayerFromSession($playerId);

            // Remove the player from the team
            unset($this->playersOfTeam[$key]);
            break;
        }
    }
}
}
function removePlayerFromSession($playerId) {
    foreach ($_SESSION['players'] as $key => $player) {
        if ($player instanceof Player && $player->getId() == $playerId) {
            unset($_SESSION['players'][$key]);
            break;
        }
    }
}
?>