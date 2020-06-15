<?php
	require __DIR__.'/./config/bootstrap.php';
	
	function http_status_code($code) {
		return http_response_code($code);
	}
	
	$input = json_decode(file_get_contents("php://input"), true);
	
	if(!in_array($input["key"], ["client1", "client3"])) {
		http_status_code(401);
		return;
	}
	http_status_code(200);
	return;
?>