<?php
include_once 'handlers/Cell.php';
session_start();
$checker = (isset($_SESSION["checker"])) ? $_SESSION["checker"] : 0;
$win = (isset($_SESSION["win"])) ? $_SESSION["win"] : false;

$TITLE = 'TIC-TAC-TOE';
include_once 'handlers/header.php';
echo "<form action='handlers/handler.php' method='post'>
        <div style='width: 306px; height: 350px;'>";
include_once 'handlers/globals.php';
include_once 'handlers/func_helpers.php';
$checker++;
$_SESSION["checker"] = $checker;

/*
* Вывод полей
*/

for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
                $_SESSION["field"][$i][$j]->print_cell();
        }
}

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
$_SESSION["win"] = $win;

/*
* Селекторы
*/

for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
                echo "<input type='radio' id='$i-$j' value='$i-$j' name='Selector' style='display: none'><br>";
        }
}
if (!$_SESSION["win"]) echo "<input type='submit' value='Походить'/ style='margin-top: 10px'>";
echo "</form></div>";
echo "<form action='handlers/destruction.php' method='post'><input type='submit' value='Начать заново' /></form>";
include_once 'handlers/footer.php';
?>
