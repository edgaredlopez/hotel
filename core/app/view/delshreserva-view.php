<?php


$shreserva = SHreservaData::getById($_GET["id"]);
$shreserva->update_estado();

if($shreserva->tipo==1)
{
    Core::redir("./index.php?view=re_servicio");
}
else
{
    Core::redir("./index.php?view=re_habitacion");
}


?>