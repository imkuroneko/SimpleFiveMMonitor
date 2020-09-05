<?php

$error = [];
if(isset($_POST['submit'])) {
	if(empty($_POST['nombre']) || empty($_POST['ip']) || empty($_POST['puerto'])) {
		$error = ['status' => 'danger', 'msg' => 'Complete todos los campos para continuar.'];
	} else {
		$server_id = hash('md5',date('d/m/Y H:i:s'));
		$nombre = $_POST['nombre'];
		$ip = $_POST['ip'];
		$puerto = $_POST['puerto'];

		if(!filter_var($ip, FILTER_VALIDATE_IP)) {
			$error = ['status' => 'danger', 'msg' => 'Ingrese una IP válida.'];
		}

		if(!is_numeric($puerto)) {
			$error = ['status' => 'danger', 'msg' => 'Ingrese un puerto válido (dato no válido: texto).'];
		}

		$imp = file_get_contents('../servers.json');
		$temp = json_decode($imp);

		foreach ($temp as $server => $info_sv) {
			if($info_sv->ip == $ip && $info_sv->puerto == $puerto) {
				$error = ['status' => 'danger', 'msg' => 'Ya has registrado anteriormente un servidor con esta IP y Puerto.'];
			}
		}

		if(empty($error)) {
			$temp->{$server_id} = [
				'nombre' => $nombre,
				'ip' => $ip,
				'puerto' => $puerto
			];
			file_put_contents('../servers.json', json_encode($temp));
			$error = ['status' => 'success', 'msg' => 'Se ha registrado correctamente el nuevo servidor.'];
		}
	
	}
}

require '../inc/_header.php';
?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-4 offset-0 offset-md-4 pt-5">
			<form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
				<div class="form-group">
					<label>Nombre del Servidor</label>
					<input class="form-control form-control-sm" type="text" name="nombre" autocomplete="off">
				</div>
				<div class="form-group">
					<label>IP</label>
					<input class="form-control form-control-sm" type="phone" name="ip" autocomplete="off">
				</div>
				<div class="form-group">
					<label>Puerto</label>
					<input class="form-control form-control-sm" type="phone" name="puerto" autocomplete="off" value="30120">
				</div>

				<?php if(!empty($error)) {echo "<div class='alert alert-{$error['status']} text-center'>{$error['msg']}</div>"; } ?>

				<div class="form-group text-center">
					<input class="btn btn-info" type="submit" name="submit" value="Registrar">
					<br>
					<small><a class="text-success" href="../">Volver Atrás</small>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require '../inc/_footer.php'; ?>