<?php
		include 'conexao.php';
		include 'convertDate.php';
	?>
	<thead>
	<tr>
		<th>P. Mar</th>
		<th>Data/Hora</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$index = 0;
	//$sql = "SELECT tempBMP, pressBMP, altitudeBMP, pressMarBMP, horario FROM dados ORDER BY horario DESC";
	//$stmt = $pdo->prepare($sql);
	//$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
	?>
		<tr>
			<td><?php	echo $row->pressMarBMP.' Pa'; ?></td>
			<td><?php	echo convertHorario($row->horario); }?></td>
		</tr>
	</tbody>
	</table>
