<!DOCTYPE html>

<html>  
    <head>
        <meta http-equiv="Content Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $position = $_GET['board'];
            $game = new Game($positions);
            if($game->winner('x')) {
                echo 'You Win.';
            } else if($game->winner('o')){
                echo 'I win.';
            } else {
                echo 'No winner yet, but you are losing';
            }
        ?>
    </body>
</html>
<?php

class Game {
    var $position;
    
    function __construct($squares){
        $this->position = str_split($squares);
    }
    
    function winner($token) {
        $won = false;
        
        for($row=0; $row<3; $row++){
            if(($this->position[3*$row] == $token) &&
               ($this->position[3*$row+1] == $token) &&
               ($this->position[3*$row+2] == $token)) {
                $won = true;
            }     
        }
        for($col=0; $col<3; $col++) {
           if(($this->position[$col] == $token) &&
               ($this->position[$col+3] == $token) &&
               ($this->position[$col+6] == $token)) {
                $won = true;
            }   
        }
        if (($this->position[0] == $token) &&
           ($this->position[4] == $token) &&
           ($this->position[8] == $token)) 
        {
            $won = true;
        } else if (($this->position[2] == $token) &&
           ($this->position[4] == $token) &&
           ($this->position[6] == $token)) 
        {
            $won = true;
        }
       
        return $won;
    }
}


