<?php

function checkStatus($ip, $puerto) {
	$socket = @fsockopen($ip, $puerto, $errorNo, $errorStr, 2);
	if ($socket) {
		return [ 'on' => true, 'string' => '<span class="font-weight-bold text-success"> ON </span>' ];
	} else {
		return [ 'on' => false, 'string' => '<span class="font-weight-bold text-danger"> OFF </span>' ];
	}
}

function getServerInfo($ip, $puerto) {
	return curl("http://$ip:$puerto/info.json");

	return [
		'version' =>     'FiveM Linux 11.0-r',
		'players_on' =>  rand(0,100),
		'slots' =>       '100'
	];
}

function getPlayers($ip, $puerto) {
	$content = curl("http://$ip:$puerto/players.json");
	usort($content, function($a, $b) { return $a->id <=> $b->id; });
	return [ 'online' => count($content), 'players' => $content ];
}

function curl($url) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$rst = curl_exec($ch);
	curl_close($ch);
	return json_decode($rst);
}