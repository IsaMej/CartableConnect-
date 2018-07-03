<?php
    $db = db_connect();

    function db_connect() {
		$host 		= "localhost";
		$dbname 	= "cartable";
		
		$user 		= "root";
		$password 	= "";
		
		$db = new PDO(
					"mysql:host=$host;dbname=$dbname", 
					$user, 
					$password, 
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::MYSQL_ATTR_DIRECT_QUERY=>true));
		return $db;
    }

	
	// Get user IP
	$userIp = $_SERVER['REMOTE_ADDR'];
	$userIp = (!empty($_SERVER['HTTP_CLIENT_IP'])) 			? $_SERVER['HTTP_CLIENT_IP'] 		: $userIp;
	$userIp = (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 	? $_SERVER['HTTP_X_FORWARDED_FOR'] 	: $userIp;
	
	$userIp = "80.215.168.190";
	
	$userInfo[]		= unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$userIp));
		
	$operateur 		= gethostbyaddr($_SERVER['REMOTE_ADDR']);
	
	$download		= isset($_POST['download']) ? $_POST['download'] 	: 0;
	$upload			= isset($_POST['upload']) 	? $_POST['upload']		: 0;
	
	$latitude 		= $userInfo[0]['geoplugin_latitude'];
	$longitude 		= $userInfo[0]['geoplugin_longitude'];
	
	$debitResult 	= true;
	$mirrorResult	= true;
	
	
	$req = $db->prepare("INSERT INTO testinfo (operateur, download, upload, debit_resultat, mirroir_resultat, lat, lng) VALUES (:operateur, :down, :up, :debit, :mirroir, :lat, :long)");
	$req->execute(array(
		"operateur" 	=> $operateur,
		"down" 			=> $download,
		"up" 			=> $upload,
		"debit" 		=> $debitResult,
		"mirroir" 		=> $mirrorResult,
		"lat" 			=> $latitude,
		"long" 			=> $longitude
	));