<?php require './script/list.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title> FiveM Server Monitor </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
</head>
<body>

	<div class="container pt-5 mt-5">
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="table">
					<table class="table table-bordered text-center table-sm">
						<thead>
							<tr>
								<th> Nombre Servidor </th>
								<th> IP:Puerto </th>
								<th> Estado </th>
								<th> Versión </th>
								<th> Jugadores </th>
								<th> Acciones </th>
							</tr>
						</thead>
						<tbody> <?php echo $table; ?> </tbody>
						<tfooter>
							<tr>
								<th colspan="6">
									<a class="text-info small" href="./script/create.php"> <i class="fas fa-plus"></i> Agregar Servidor</a>
								</th>
							</tr>
						</tfooter>
					</table>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>