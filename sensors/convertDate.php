<?php

  function convertHorario($horario){
    return date("d/m/Y H:i:s", strtotime($horario));
  }
  function convertData($horario){
  	  return date("d/m/Y", strtotime($horario));
  }
 ?>
