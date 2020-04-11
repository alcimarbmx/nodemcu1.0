<?php
	include 'conexao.php';
	include 'sensors/convertDate.php';

$n_pag = 25;
if(!empty($_GET['pag'])):
	$pag = intval($_GET['pag']);
else:
	$pag = 0;
endif;
	$datainicio = date("Y-m");
	$datafinal = date("Y-m");

	//if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(!empty($_GET['datainicio']) && !empty($_GET['datafinal'])){
			$datainicio = $_GET['datainicio'];
			$datafinal = $_GET['datafinal'];
			$query = "SELECT * FROM dados WHERE horario>='$datainicio 00:00:00' AND horario<='$datafinal 23:59:59' ORDER BY horario ASC LIMIT $pag, $n_pag";
	}else{
		$query = "SELECT * FROM dados ORDER BY horario DESC LIMIT $pag, $n_pag";
	}
	$stmt = $pdo->prepare($query);
	$stmt->execute();

	$linha = $stmt->rowCount();
	$paginas = ceil($linha / $n_pag);
	echo $paginas." paginas para alimentar a tabela";
	?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Estação NodeMcu 1.0</title>
	<link rel="icon" href="icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body class="light darken-2">

<div class="container">
<div class="card-panel accent-2">

<h1><a href="index.php"><img rel="icon" src="icon.png"></a> Mini estação NodeMcu</h1>

</div>
<!--
<form action="" method="get" class="pure-form">

	<div  class="input-field col s12">
		<input type="date" name="datainicio" value="<?php #if($datainicio): echo $datainicio; endif;?>">
		<input type="date" name="datafinal" value="<?php #if($datafinal): echo $datafinal; endif;?>">
	</div>

	<button class="btn" type="submit">Pesquisar</button>
</form>
-->


<a <?php
		if(!isset($datainicio) && !isset($datafinal) && ($pag > 0)):
			echo 'href=?datainicio='.$datainicio.'&datafinal='.$datafinal.'&pag='.($pag - 25);
		else:	
			if($pag > 0): 
				echo 'href=?pag='.($pag - 25);
			endif;
		endif; ?> > << </a> ...
<a <?php
		if(!isset($datainicio) && !isset($datafinal)):
		echo 'href=?datainicio='.$datainicio.'&datafinal='.$datafinal.'&pag='.($pag + 25);
		else:	echo 'href=?pag='.($pag + 25);
		endif;?>> >> </a>
    <?php    
    echo "<a class='btn btn-success' href='gerarpdf.php'>Gerador de relatório</a>";
?>

<hr  class="featurette-divider">
<table class="bordered striped centered">

	<thead>
	<tr>
		<!-- <th>id</th> -->
		<th><a class="btn" href="defaultSensors.php?title=umidadehl&pag=0">Umid. do solo</a></th>
		<th><a class="btn" href="defaultSensors.php?title=dht11temperatura&pag=0">Temp. DHT11</a></th>
		<th><a class="btn" href="defaultSensors.php?title=dht11umidade&pag=0">Umid. relat. do ar</a></th>
		<th><a class="btn" href="defaultSensors.php?title=ds20&pag=0">Temp. Solo</a></th>
		<th><a class="btn" href="defaultSensors.php?title=bmp180temperatura&pag=0">Temp. BMP</a></th>
		<th><a class="btn" href="defaultSensors.php?title=bmp180pressao&pag=0">Pressão</a></th>
		<th><a class="btn" href="defaultSensors.php?title=bmp180altitude&pag=0">Altitude</a></th>
		<th><a class="btn" href="defaultSensors.php?title=bmp180pressaomar&pag=0">P. Mar</a></th>
		<th>Data/Hora</th>
	</tr>
	</thead>
	<tbody>
	<?php
	 $index = 0;
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
	?>
		<tr>
			<!-- <td><?php 	#echo $row->id; ?></td> -->
			<td><?php 	echo $row->umidadeHL; ?></td>
			<td><?php	echo $row->tempDHT.' ºC';?></td>
			<td><?php	echo $row->umidadeDHT.' %'; ?></td>
			<td><?php	echo $row->tempSoloDS20.' ºC'; ?></td>
			<td><?php	echo $row->tempBMP.' ºC'; ?></td>
			<td><?php	echo $row->pressBMP.' Pa'; ?></td>
			<td><?php	echo $row->altitudeBMP.' M'; ?></td>
			<td><?php	echo $row->pressMarBMP.' Pa'; ?></td>
			<td><?php	echo convertHorario($row->horario); }?></td>
		</tr>
	</tbody>
	</table>
	<hr class="featurette-divider">
</div>
</body>
</html>
