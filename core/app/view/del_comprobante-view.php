<?php


		$eliminar = TipoComprobanteData::getById($_GET['id']);
		$eliminar->del();


Core::redir("./index.php?view=tipo_comprobante");
?>