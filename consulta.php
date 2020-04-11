<?php
	include 'conexao.php';
	include 'sensors/convertDate.php';
	$title = 'consulta';
	if($_GET):
		$buscaHoraDiaInicio = date("Y-m-d H:i", strtotime($_GET['selecionadiahorainicio']));
		$buscaHoraDiaFim = date("Y-m-d H:i", strtotime($_GET['selecionadiahorafim']));
		$sensor = $_GET['sensor'];
		$query = "SELECT umidadeDHT, horario FROM dados"; 
	endif;
		$stmt = $pdo->prepare($query);
		$stmt->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf8">
	<title>$title</title>
</head>
<body>
<h1>
	<a href="index.php"><img rel="icon" src="icon.png"></a>
</h1>



<form action="" method="get">
	<input type="datetime-local" name="selecionadiahorainicio" value="<?php echo $_GET['selecionadiahorainicio']; ?>">
	<input type="datetime-local" name="selecionadiahorafim" value="<?php echo $_GET['selecionadiahorafim']; ?>">
	<select name="sensor" class="pure-input-1-2">
		<option ></option>
		<option value="umidade">Umidade</option>
		<option value="tempSolo">Temperatura do solo</option>
		<option value="umidadedht">Umidade do ar</option>
		<option value="temperaturadht">Temperatura DHT</option>
		<option value="tempBMP">Temperatura BMP</option>
		<option value="pressBMP">Pressão atmosferica</option>
	</select>
	<input class="btn" type="submit" name="submit" value="Buscar">
</form>

<?php
//include "sensors/$sensor.php";
	echo $buscaHoraDiaInicio."<br>".$sensor."<br>";
	echo $buscaHoraDiaFim;
	
	while($row = $stmt->fetch(PDO::FETCH_OBJ)):
		echo $row->umidadeHL;
		var_dump($row);
	endwhile;
?>

</body>
</html>