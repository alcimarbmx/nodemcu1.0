<?php
include 'conexao.php';
$n_pag = 25;
if($_GET['pag']):
  $pag = intval($_GET['pag']);
else:
  $pag = 0;
endif;

  switch($title):
    case 'dht11temperatura':
      $query = "SELECT tempDHT, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
      $titlepag = "Temperatura DHT11";
      break;
      case 'dht11umidade':
      $query = "SELECT umidadeDHT, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
      $titlepag = "Umidade do Ar DHT11";
      break;
    case 'ds20':
      $query = "SELECT tempSoloDS20, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
      $titlepag = "Temperatura do solo DS18D20";
      break;
    case 'bmp180temperatura':
        $query = "SELECT tempBMP,  horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
        $titlepag = "Temperatura BMP180";
        break;
    case 'bmp180pressao':
        $query = "SELECT  pressBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
        $titlepag = "Pressão atmosférica BMP180";
        break;
    case 'bmp180altitude':
        $query = "SELECT altitudeBMP,  horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
        $titlepag = "Altitude BMP180";
        break;
    case 'bmp180pressaomar':
        $query = "SELECT pressMarBMP, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
        $titlepag = "Pressão maritíma BMP180";
        break;
    case 'umidadehl':
        $query = "SELECT umidadeHL, horario FROM dados ORDER BY id DESC LIMIT $pag, $n_pag";
        $titlepag = "Humidade do solo HL";
        break;
    default:
      echo "<h1>Not found</h1>";
  endswitch;

  try{
      $stmt = $pdo->prepare($query);
      $stmt->execute();
      $result =  $stmt->fetch(PDO::FETCH_OBJ);
  }catch(Error $e){
      echo $e->getMessage();
      }
 ?>
