<?php

require __DIR__.'./functions.php';

# Servers Data
$servers = json_decode(file_get_contents('./servers.json'));

$table = '';

foreach ($servers as $server => $sv_info) {
	$getStatus = checkStatus($sv_info->ip, $sv_info->puerto);

	if($getStatus['on']) {
		$info = getServerInfo($sv_info->ip, $sv_info->puerto);
		$players = getPlayers($sv_info->ip, $sv_info->puerto);

		$fivem_version = $info->server;
		$players_on = $players['online'];
		$total_slots = $info->vars->sv_maxClients;
		$prcnt = ($total_slots*$players_on)/100;
	} else {
		$fivem_version = '-';
		$players_on = 0;
		$total_slots = 0;
		$prcnt = 0;
	}

	$table .= "<tr>
		<td class='align-middle'>{$sv_info->nombre}</td>
		<td class='align-middle'>{$sv_info->ip}:{$sv_info->puerto}</td>
		<td class='align-middle'>{$getStatus['string']}</td>
		<td class='align-middle'>{$fivem_version}</td>
		<td class='align-middle'>
			<div class='progress'><div class='progress-bar bg-info' style='width: {$prcnt}%; cursor:pointer'></div></div>
			<small>{$players_on}/{$total_slots}</small>
		</td>
		<td class='align-middle'>
			<div class='btn-group'>
				<a href='./script/delete.php?server={$server}' class='btn btn-sm btn-outline-danger' title='Eliminar Servidor'>
					<i class='far fa-fw fa-trash-alt'></i>
				</a>
			</div>
		</td>
	</tr>";
}
