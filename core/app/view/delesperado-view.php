<?php


$esperado = EsperadoData::getById($_GET["id"]);
$esperado->del();

Core::redir("./index.php?view=esperado");
?>