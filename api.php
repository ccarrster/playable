<?php
$method = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

function getGames(){
	if(file_exists('games.json')){
		return json_decode(file_get_contents('games.json'));
	} else {
		return [];
	}
}
function addGame($name){
	$games = getGames();
	$games[] = $name;
	file_put_contents('games.json', json_encode($games));
}

$lowerRequest = strtolower($request);
if($method === 'GET' && $lowerRequest === '/playable/api/games'){
	echo(json_encode(getGames()));
} elseif($method === 'POST' && $lowerRequest === '/playable/api/game'){
	addGame('New Game');
} else {
	http_response_code(404);
}


