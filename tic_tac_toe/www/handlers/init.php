<?php
session_start();
include_once 'Cell.php';
if ($checker == 0) {
        $field = array();
        for ($i = 0; $i < 3; $i++) {
                array_push($field, array(new Cell($i, 0), new Cell($i, 1), new Cell($i, 2)));
        }
        $_SESSION["field"] = $field;
        $_SESSION["turn"] = 0;
}
?>