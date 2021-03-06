<?php
function switch_turn() {
        $turn = $_SESSION["turn"];
        $turn++;
        $turn %= 2;
        $_SESSION["turn"] = $turn;
}
class Cell {
        function __construct($id_1, $id_2) {
                $this->_id_1 = $id_1;
                $this->_id_2 = $id_2;
        }
        function set_figure() {
                if ($this->_figure != 'none') {
                        return;
                }
                $this->_figure = ($_SESSION["turn"] == 0) ? 'cross' : 'circle';
                switch_turn();
                // $this->print_cell();
        }
        function print_cell() {
                switch ($this->_figure) {
                        case 'none':
                                echo "<label for='$this->_id_1-$this->_id_2'><div name='cell' style='width: 100px; height: 100px; border: 1px solid black; background-color: rgb(253, 244, 227); float: left; cursor: pointer;'></div></label>";
                                break;
                        case 'cross':
                                echo "<label for='$this->_id_1-$this->_id_2'><div name='cell' style='width: 100px; height: 100px; border: 1px solid black; background-color: #FD3F49; float: left;'><div class='helper_player_cell_x_big' style='font-size: 150px; margin-left: 4px;'></div></div></label>";
                                break;
                        case 'circle':
                                echo "<label for='$this->_id_1-$this->_id_2'><div name='cell' style='width: 100px; height: 100px; border: 1px solid black; background-color: #92F58D; float: left;'><div class='helper_player_cell_o' style='width:70px; height: 70px; margin: 12px;'></div></div></label>";
                                break;
                        default:
                                echo "<label for='$this->_id_1-$this->_id_2'><div name='cell' style='width: 100px; height: 100px; border: 1px solid black; background-color: red; float: left;'><b>ERROR</b></div></label>";
                                break;
                }
        }
        private $_id_1;
        private $_id_2;
        public $_figure = 'none';
}
?>