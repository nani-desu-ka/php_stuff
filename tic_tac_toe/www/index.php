<?php
include_once 'handlers/Cell.php';
session_start();
$checker = (isset($_SESSION["checker"])) ? $_SESSION["checker"] : 0;
$win = (isset($_SESSION["win"])) ? $_SESSION["win"] : false;

$back_color = "white";
if ($_SESSION["win"] == true) $back_color = ($_SESSION["turn"] % 2 == 0) ? "#92F58D" : "#FD3F49";

include_once 'handlers/init.php';

/*
* Проверка на выигрыш
*/

for ($i = 0; $i < 3; $i++) {
        $prev = $_SESSION["field"][$i][0]->_figure;
        for ($j = 0; $j < 3; $j++) {
                if ($_SESSION["field"][$i][$j]->_figure == 'none' || $_SESSION["field"][$i][$j]->_figure != $prev) break;
                else {
                        $prev = $prev = $_SESSION["field"][$i][$j]->_figure;
                }
                if ($j == 2) {
                        $win = true;
                }
        }
}
for ($j = 0; $j < 3; $j++) {
        $prev = $_SESSION["field"][0][$j]->_figure;
        for ($i = 0; $i < 3; $i++) {
                if ($_SESSION["field"][$i][$j]->_figure == 'none' || $_SESSION["field"][$i][$j]->_figure != $prev) break;
                else {
                        $prev = $prev = $_SESSION["field"][$i][$j]->_figure;
                }
                if ($i == 2) {
                        $win = true;
                }
        }
}
$prev = $_SESSION["field"][0][0]->_figure;
for ($i = 0; $i < 3; $i++) {
        if ($_SESSION["field"][$i][$i]->_figure == 'none' || $_SESSION["field"][$i][$i]->_figure != $prev) break;
        else {
                $prev = $prev = $_SESSION["field"][$i][$i]->_figure;
        }
        if ($i == 2) {
                $win = true;
        }
}
$i = 2;
$j = 0;
$prev = $_SESSION["field"][2][0]->_figure;
while ($i != -1 || $j != 3) {
        if ($_SESSION["field"][$i][$j]->_figure == 'none' || $_SESSION["field"][$i][$j]->_figure != $prev) break;
        else {
                $prev = $prev = $_SESSION["field"][$i][$j]->_figure;
        }
        if ($i == 0 && $j == 2) {
                $win = true;
        }
        $i--;
        $j++;
}
if ($win == true && $_SESSION["win"] == false) {
        $_SESSION["win"] = $win;
        header("Refresh:0;url=index.php");
}
else $_SESSION["win"] = $win;




include_once 'handlers/header.php';
$checker++;
$_SESSION["checker"] = $checker;

/*
* Текущий игрок
*/

if ($_SESSION["win"]) {
        if ($_SESSION["turn"] % 2 == 0)  {
                echo "<div class='player_cell'><div class='helper_player_cell_o'></div></div>";

        } else {
                echo "<div class='player_cell'><div class='helper_player_cell_x_small'></div></div>";
        }
} else {
        if ($_SESSION["turn"] % 2 == 0)  {
                echo "<div class='player_cell'><div class='helper_player_cell_x_small'></div></div>";
        } else {
                echo "<div class='player_cell'><div class='helper_player_cell_o'></div></div>";
        }
}

/*
* Вывод полей
*/

echo "<div class='field-form'><form action='handlers/handler.php' method='post' style='min-height: 320px;'>";
for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
                $_SESSION["field"][$i][$j]->print_cell();
        }
}

/*
* Селекторы
*/

for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
                echo "<input type='radio' id='$i-$j' value='$i-$j' name='Selector' style='display: none'><br>";
        }
}
if (!$_SESSION["win"]) echo "<input type='submit' class='field-form-button' style='margin-top: 170px' value='сделать ход'/>";
echo "</form>";
echo "<form action='handlers/destruction.php' method='post' ><input type='submit' class='field-form-button' value='Начать заново' /></form></div>";
include_once 'handlers/footer.php';
?>
