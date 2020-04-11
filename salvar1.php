<?php
	include "conexao.php";

	$umidadeHL = $_GET['umidadehl'];
	$tempDHT = $_GET['tempDHT'];
	$umidadeDHT = $_GET['umidadeDHT'];
	$tempSoloDS20 = $_GET['tempSoloDS20'];
	//bmp
	$tempBMP = $_GET['tempBMP'];
	$pressBMP = $_GET['pressBMP'];
	$altitudeBMP = $_GET['alttBMP'];
	$pressMarBMP = $_GET['pressMarBMP'];


	$sql = "INSERT INTO dados (umidadeHL, tempDHT, umidadeDHT, tempSoloDS20, tempBMP, pressBMP, altitudeBMP, pressMarBMP) VALUES
	({$umidadeHL}, {$tempDHT}, {$umidadeDHT}, {$tempSoloDS20}, {$tempBMP}, {$pressBMP}, {$altitudeBMP}, {$pressMarBMP})";

	$stmt = $pdo->prepare($sql);

/*	$stmt->BindParam(':umidadeHL', $umidadeHL);
	$stmt->BindParam(':tempDHT', $tempDHT);
	$stmt->BindParam(':umidadeDHT', $umidadeDHT);
	$stmt->BindParam(':tempSoloDS20', $tempSoloDS20);
	$stmt->BindParam(':tempBMP', $tempBMP);
	$stmt->BindParam(':pressBMP', $pressBMP);
	$stmt->BindParam(':altitudeBMP', $altitudeBMP);
	$stmt->BindParam(':pressMarBMP', $pressMarBMP);
*/

//http://localhost/nodemcu1.0/salvar1.php?umidadehl=100&tempDHT=29&umidadeDHT=33&tempSoloDS20=30.25&tempBMP=30.20&pressBMP=101114.00&alttBMP=17.42&pressMarBMP=101120.00
	if($stmt->execute()):
		echo "salvo_com_sucesso";
	else:
		echo "erro_ao_salvar";
	endif;


	/*
	http://localhost/nodemcu/salvar.php?sensor1=121&sensor2=4545&sensor3=34343
	*/
?>
