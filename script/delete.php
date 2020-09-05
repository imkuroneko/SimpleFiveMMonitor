<?php
	if(isset($_GET['server'])) {
		$id = $_GET['server'];

		$imp = file_get_contents('../servers.json');
		$temp = json_decode($imp);

		$del = 0;
		foreach ($temp as $server => $item) {
			if($server == $id) {
				unset($temp->$server);
				$msg = "Se ha eliminado correctamente el servidor solicitado.";
	
				$json = json_encode($temp);
				$handle = fopen('../servers.json', 'w');
				fwrite($handle, $json);
				fclose($handle);
				$del = 1;
			}
		}

		if($del == 0) {
			$msg = "No se ha encontrado un servidor con el ID indicado.";
		}
	} else {
		$msg = "No se ha recibido el ID del servidor a eliminar.";
	}


	echo $msg;
?>
<br> <a href='../'>Volver...</a>
