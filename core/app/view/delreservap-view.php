<?php


$reserva = ReservapData::getById($_GET["id"]);
$reserva->del();

Core::redir("./index.php?view=reservasp");
?>