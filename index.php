<!DOCTYPE html>

<html>  
    <head>
        <meta http-equiv="Content Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $position = $_GET['board'];
            $game = new Game($position);
            $game->display();
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
    function display() {
        echo '<table cols=”3” style=”font­size:large; font­weight:bold”>';
        echo '<tr>'; // open the first row
        for ($pos=0; $pos<9;$pos++) {
            echo $this->show_cell($pos);
            if ($pos %3 == 2){
                echo '</tr><tr>'; // start a new row for the next square
            }
        }
        echo '</tr>'; // close the last row
        echo '</table>';
    }
    
    function show_cell($which) {
        $token = $this->position[$which];
        if ($token <> '­') {
            return '<td>'.$token.'</td>';
        }
        $this->newposition = $this->position;
        $this->newposition[$which] = 'o'; // this would be their move
        $move = implode($this->newposition); 
        $link = '/?board='.$move; // this is what we want the link to be

        return '<td><a href=”'.$link.'”>­</a></td>';
}

}


