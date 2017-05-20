<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    require_once 'class/TipoError.php';
?>
<link rel="stylesheet" type="text/css" href="style.css">

<form action="" method="post">
	<table>
		<tr>
			<td>Nombre</td>
			<td><?php echo "$nom" ;?></td>
		</tr>
		<tr>
			<td>Asunto</td>
			<td><input type="text" name="asunto"></td>
			<td><span><?php echo (isset($err_asunto)) ? $err_asunto : '';?></span></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo "$mail" ;?></td>
		</tr>
		<tr>
			<td>Prioridad</td>
			<td>
				<input type="radio" name="prioridad" value="1"> Alta<br>
  				<input type="radio" name="prioridad" value="2"> media<br>
  				<input type="radio" name="prioridad" value="3"> baja<br><br>
			</td>
			<td><span><?php  echo (isset($err_prioridad)) ? $err_prioridad : '';?></span></td>
		</tr>
		<tr>
			<td>Tipo Error</td>
			<td><?php 
			$conn = new mysqli('localhost', 'root', '','incidencias');
        $sql = "SELECT * FROM `error`";
        $resultado=$conn->query($sql);
        $nfilas = $resultado->num_rows;
        if ($resultado){

        	 echo"<select name='t_err'>
        	 	  <option value='seleccione'>seleccione</option>
        	 ";
            if ($nfilas > 0){
                for ($i=0; $i<$nfilas; $i++){
                    $fila=$resultado->fetch_array();

                    $err =new TipoError();

                    $err->setid($fila[0]);
                    $err->setname($fila[1]);

                    $id=$err->getid();
                    $txt=$err->getname();

                   
  						echo"<option value='$id'>$txt</option>";
						

                }
                echo "</select>";
            }
        }
            $conn->close();?>

			</td>
			<td><span><?php echo (isset($err_tipo)) ? $err_tipo : '';?></span></td>
		</tr>
		<tr>
			<td>Descripccion</td>
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
