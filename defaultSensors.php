<?php
	include 'conexao.php';
	
	$n_pag = 25;
	//$pag = 0;
	if($_GET['title']):
		$title = $_GET['title'];
		$pag = intval($_GET['pag']);
	else:
  		$pag = 0;
	endif;
/*
if(!empty($_GET['datainicio']) && !empty($_GET['datafinal'])){
			$datainicio = $_GET['datainicio'];
			$datafinal = $_GET['datafinal'];
			$query = "SELECT * FROM dados WHERE horario>='$datainicio 00:00:00' AND horario<='$datafinal 23:59:59' ORDER BY horario ASC LIMIT $pag, $n_pag";
	}else{
		$query = "SELECT * FROM dados ORDER BY horario DESC LIMIT $pag, $n_pag";
	}

*/
echo $title;
	switch ($title):
		case 'dht11temperatura':
			$query = "SELECT tempDHT, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'dht11temperatura';
			break;
		case 'dht11umidade':
			$query = "SELECT umidadeDHT, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'dht11umidade';
			break;
		case 'bmp180temperatura':
			$query = "SELECT tempBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'bmp180temperatura';
			break;
		case 'bmp180pressao':
			$query = "SELECT  pressBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'bmp180pressao';
			break;
		case 'bmp180altitude':
			$query = "SELECT  altitudeBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'bmp180altitude';
			break;
		case 'bmp180pressaomar':
			$query = "SELECT  pressMarBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'bmp180pressaomar';
			break;
		case 'umidadehl':
			$query = "SELECT umidadeHL, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'umidadehl';
			break;
		case 'ds20':
			$query = "SELECT tempSoloDS20, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
			$sensor = 'ds20';
			break;
		default:
			echo "<h1>Not found...</h1>";
			break;
	endswitch;

	$stmt = $pdo->prepare($query);
	$stmt->execute();

	?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Estação NodeMcu</title>
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

<h1>

	<a href="index.php"><img rel="icon" src="icon.png"></a>
	<?php
	include 'header.php';
		echo " ".$titlepag;
	 ?>
</h1>

</div>

<form action="" method="get" class="pure-form">

	<div  class="input-field col s12">
		<input type="date" name="data">
	</div>

	<button class="btn" type="submit">Buscar</button> 
</form>
<a href="?title=<?php  echo $title;?>&pag=<?php  if($pag > 0): echo $pag -25; endif;?>" > << </a>...
<a href="?title=<?php  echo $title;?>&pag=<?php  echo $pag +25;?>" > >> </a>


<hr  class="featurette-divider">

<table class="bordered striped centered">
<?php
	include "sensors/$sensor.php";
?>
	<hr class="featurette-divider">
</div>
</body>
</html>
