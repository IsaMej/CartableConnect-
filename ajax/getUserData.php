<?php
session_start();



echo json_encode(array(
	"idUser" 		=> $_SESSION['id_user'], 
	"userName" 		=> explode("@", $_SESSION['email'])[0]),
	"idRemoteUser"	=> ($_SESSION['id_user'] == 1) ? 2 : 1;);
	
