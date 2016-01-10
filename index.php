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
            $game->pick_move();
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
/*
 *********************
 * Cameron Stenmark
 * A00885373
 * COMP 4711
 * Lab 1
 ********************* 
 */


/*
 * class Game
 * attributes position = the game board
 * 
 * functions __construct = the constructor for the game board
 *           winner = checks if a player has won the game
 *           display = displays the game board in a table
 *           show_cell = allows the user to pick a move
 *           pick_move = the computer player picks its move
 * 
 * this class is the game, it handles all moves, decides a winner 
 * and displays the game board
 */
class Game {
    var $position;
    /*
     * function __construct
     * parameters the string to build the game board from
     * return none
     * 
     * creates the game, with a displayable game board
     */
    function __construct($squares){
        $this->position = str_split($squares);
    }
    /*
     * function winner
     * parameters which player has won
     * return if they won
     * 
     * this function checks if either x or o has won yet
     * checking each posibility and then returning the result
     */
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
    /*
     * function display
     * parameters none
     * return none
     * 
     * this function handles the display of the board
     * calling the show_cell function on each cell on 
     * the board and displaying it in a neat html
     * table
     */
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
    /*
     * function show_cell
     * parameters the cell to show
     * return the link to the new board
     * 
     * this function has 2 purposes
     * it displays the contents of a cell
     * and allows the user to choose their move
     */
    function show_cell($which) {
        $token = $this->position[$which];
        if ($token <> '-') {
            return '<td>'.$token.'</td>';
        }
        $this->newposition = $this->position;
        $this->newposition[$which] = 'x'; // this would be their move
        $move = implode($this->newposition); 
        $link = '/?board='.$move; // this is what we want the link to be

        return '<td><a href='.$link.'>-</a></td>';
    }
    /*
     * function pick_move
     * parameters none
     * return true
     * 
     * this function controls the computer player
     * picks a random square that does not have a 
     * x or o and chooses that as its move.
     */
    function pick_move() {
        while(true){
            $which = rand(0,8);
            $token = $this->position[$which];
            if($token == '-') {
                break;
            }
        }
        
        $this->position[$which] = 'o';
        
        return true;
    }
}


