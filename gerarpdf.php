<?php 
	include 'conexao.php';
	include 'sensors/convertDate.php';
	require 'fpdf181/fpdf.php';
	//date_default_timezone_set('America/Sao_paulo');
class PDF extends FPDF{
	function Header(){
    	$this->SetFont('Arial','B',15);
    	$this->Cell(0, 0, utf8_decode("Relatório"), 0, 0,"C");
    	$this->Ln(20);
	}
	function Footer(){
    	$this->SetY(-15);
    	$this->SetFont('Arial','I',8);
    	$this->Cell(0, 10, utf8_decode("Gerado em "). date('d/m/Y')." ".date('H:i:s'), 'C');
    	$this->Cell(0,10,utf8_decode("Página ").$this->PageNo().'',0,0,'R');
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Estação NodeMcu 1.0</title>
	<link rel="icon" href="icon.png">
	
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>
<body class="light darken-2">

<div class="container">
<div class="card-panel accent-2">

<h1><a href="index.php"><img rel="icon" src="icon.png"></a> Mini estação NodeMcu</h1>

</div>
<form action="" method="" class="pure-form pure-form-stacked">
	<label>Data inicial</label>
	<input type="date" name="datainicio" required value="<?php echo date("Y-m-d")?>">

	<label>Data final</label>
	<input type="date" name="datafinal" required value="<?php echo date("Y-m-d")?>">
    
	<label>Sensor</label>

	<select name="sensor" >
		<option value="todos">Todos dados</option>
		<option value="tempSoloDS20">Temperatura do solo</option>
		<option value="umidadeHL">Umidade do solo</option>
		<option value="tempDHT">Temperatura DHT11</option>
		<option value="umidadeDHT">Umidade relativa do ar</option>
		<option value="tempBMP">Temperatura BMP180</option>
		<option value="pressBMP">Pressão atmosférica</option>
		<option value="altitudeBMP">Altitude BMP180</option>
		<option value="pressMarBMP">Pressão marítima BMP180</option>
        </select>
    
	<br>
	<input class="btn primary" type="submit" value="Gerar relatório" formtarget="_blank">
        
</form>
</div>
<?php
	/*
	$datainicio = $_GET['datainicio'];
	$datafinal = $_GET['datafinal'];
*/	if($_GET):
	$sensor = $_GET['sensor'];
	$datainicio = $_GET['datainicio'];
	$datafinal = $_GET['datafinal'];
/*
	$datainicio + " " + $_GET['horario'];
  
	$sensor = $_GET['sensor'];
	$query = "SELECT umidadeHL , horario FROM dados";
	#$query = "SELECT umidadeHL , horario FROM dados WHERE horario >= $datainicio";

	$stmt = $pdo->prepare($query);
	$stmt->execute();
*/	if($sensor === "todos"):
		$query = "SELECT * FROM dados WHERE horario>='$datainicio 00:00:00' AND horario<='$datafinal 23:59:59'";
	else:
		$query = "SELECT $sensor , horario FROM dados WHERE horario>='$datainicio 00:00:00' AND horario<='$datafinal 23:59:59'";
	#$query = "SELECT umidadeHL , horario FROM dados WHERE horario >= $datainicio";
	endif;
	//$stmt = $pdo->prepare($query);
	//$stmt->execute();
	
	$stmt = $pdo->prepare($query);
	$stmt->execute();	
	
	#$datainicio = convertData($datainicio);
	#$datafinal = convertData($datafinal);
	//echo $sensor."<br>";
	#function Footer(){
    	#$pdf->SetY(-15);
    #$pdf->SetFont('Arial','I',8);
    #$pdf->Cell(0,10,'Page kkkiojojoklmjok'.$pdf->PageNo(),0,0,'C');
#}
	$pdf = new PDF("L", "mm", "A4");
	#$pdf->Header($datainicio, $datafinal);
	$pdf->AddPage();

	#cabecalho da pagina
	#$pdf->SetFont("Arial", 'B', 16);
	#$pdf->Cell(0, 0, utf8_decode("Relatório"), 0, 0,"C");
	#$pdf->Ln(15);
	$pdf->SetFont("Arial", '', 8);
	$pdf->Cell(0, 0, utf8_decode("Período: ").convertData($datainicio)." - ".convertData($datafinal), 0, 0,"L");
    $pdf->Ln(10);
	if($sensor == 'todos'):
		#cabecalho da tabela
	$pdf->SetFont("Arial", 'I', 8);
	$pdf->Cell(36, 6, utf8_decode("Data"), 1, 0, "C");
	$pdf->Cell(20, 6, utf8_decode("Umidade HL"), 1, 0, "C");
	$pdf->Cell(29, 6, utf8_decode("Temperatura DHT"), 1, 0, "C");
	$pdf->Cell(24, 6, utf8_decode("Umidade DHT"), 1, 0, "C");
	$pdf->Cell(34, 6, utf8_decode("Temperatura do solo"), 1, 0, "C");
	$pdf->Cell(38, 6, utf8_decode("Temperatura BMP180"), 1, 0, "C");
	$pdf->Cell(28, 6, utf8_decode("Pressão BMP180"), 1, 0, "C");
	$pdf->Cell(28, 6, utf8_decode("Altitude BMP180"), 1, 0, "C");
	$pdf->Cell(40, 6, utf8_decode("Pressão marítima BMP180"), 1, 0, "C");
	
	$pdf->Ln();
	/*
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
*/

	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$pdf->SetFont("Arial", 'B', 8);
		$pdf->Cell(36, 6, utf8_decode(convertHorario($row->horario)), 1, 0, "C");
		$pdf->Cell(20, 6, utf8_decode($row->{'umidadeHL'}), 1, 0, "C");
		$pdf->Cell(29, 6, utf8_decode($row->{'tempDHT'}), 1, 0, "C");
		$pdf->Cell(24, 6, utf8_decode($row->{'umidadeDHT'}), 1, 0, "C");
		$pdf->Cell(34, 6, utf8_decode($row->{'tempSoloDS20'}), 1, 0, "C");
		$pdf->Cell(38, 6, utf8_decode($row->{'tempBMP'}), 1, 0, "C");
		$pdf->Cell(28, 6, utf8_decode($row->{'pressBMP'}), 1, 0, "C");
		$pdf->Cell(28, 6, utf8_decode($row->{'altitudeBMP'}), 1, 0, "C");
		$pdf->Cell(40, 6, utf8_decode($row->{'pressMarBMP'}), 1, 0, "C");
		
		$pdf->Ln();
	}
	
	else:
	#cabecalho da tabela
	$pdf->SetFont("Arial", 'I', 8);
	$pdf->Cell(40, 10, utf8_decode("Horário"), 1, 0, "C");
	$pdf->Cell(50, 10, utf8_decode("$sensor"), 1, 0, "C");

	$pdf->Ln();
	/*
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
	$pdf->Cell(20, 10, utf8_decode("Relatório"), 1,0);
*/
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
		$pdf->SetFont("Arial", 'B', 10);
		$pdf->Cell(40, 10, utf8_decode(convertHorario($row->horario)), 1, 0, "C");
		$pdf->Cell(50, 10, utf8_decode($row->$sensor), 1, 0, "C");
		$pdf->Ln();
	}
	endif;

	#ob_start();
	ob_clean();
	$diainicio = convertData($datainicio);
	$diafinal = convertData($datafinal);
    
	$pdf->Output(utf8_decode("Relatório $diainicio - $diafinal.pdf"), "I");
    
	
endif;
?>
<hr  class="featurette-divider">
    
</body>
</html>