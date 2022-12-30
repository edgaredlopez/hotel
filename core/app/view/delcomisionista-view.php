<?php


$comisionista = ComisionistaData::getById($_GET["id"]);
$comisionista->del();

Core::redir("./index.php?view=comisionista");
?>