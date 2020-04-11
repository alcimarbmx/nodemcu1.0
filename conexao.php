<?php
date_default_timezone_set('America/Sao_paulo');
$msg = "";
	try{
		$host = "localhost";
        $user = "root";
		$pass = "";
        #$host = "192.168.0.150";
		#$user = "pmauser";
		#$pass = "root";
		$bd = "nodemcu2.0";
		$pdo = new PDO("mysql:host={$host};dbname={$bd};charset=utf8;","{$user}","{$pass}");
	}catch(PDOException $erro){
		 echo "Erro de conexão: ". $erro->getMessage();
			 	//header("Location: noServer.php");
	}

?>
