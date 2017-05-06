<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
?>
<link rel="stylesheet" type="text/css" href="style.css">

<form action="" method="post">
	<table>
		<tr>
			<td>Nombre</td>
			<td><?php echo "<input type='text' name='nombre' value='$nom' readonly>" ;?></td>
		</tr>
		<tr>
			<td>Asunto</td>
			<td><input type="text" name="asunto"></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo "<input type='text' name='nombre' value='$mail' readonly>" ;?></td>
		</tr>
		<tr>
			<td>Prioridad</td>
			<td>
				<input type="radio" name="prioridad" value="1"> Alta<br>
  				<input type="radio" name="prioridad" value="2"> media<br>
  				<input type="radio" name="prioridad" value="3"> baja<br><br>
			</td>
		</tr>
		<tr>
			<td>Asunto</td>
			<td>
				<textarea name="descripccion">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td>Nota interna</td>
			<td>
				<textarea placeholder="max 140 caracteres">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="Crear_incidencia" value="Crear Incidencia"></td>
		</tr>
	</table>
</form>
