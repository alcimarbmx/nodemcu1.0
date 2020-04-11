<?php
	include 'conexao.php';
	include 'convertDate.php';
	?>
	<thead>
	<tr>
		<th>Umidade</th>
		<th>Data/Hora</th>
	</tr>
	</thead>
	<tbody>
	<?php
	 $index = 0;
	while($row = $stmt->fetch(PDO::FETCH_OBJ)){
	?>
		<tr>
			<td><?php echo $row->umidadeHL; ?></td>
			<td><?php	echo convertHorario($row->horario); }?></td>
		</tr>
	</tbody>
	</table>
	<hr class="featurette-divider">
</div>
</body>
</html>
