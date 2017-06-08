<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    require_once 'class/TipoError.php';
?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="wrap_crearinc">
<form action="" method="post">
	<table id="table_crear">
		<thead>
			<tr>
			<td id="txt_titulo"><h2>INCIDENCIA</h2></td>
			</tr>
		</thead>
		<tr>
			<td id="txt">Nombre :</td>
			<td><?php echo "$nom" ;?></td>
		</tr>
		<tr>
			<td id="txt">Asunto :</td>
			<td><input type="text" name="asunto" id="asunto_txt"></td>
			<td><span class="error"><?php echo (isset($err_asunto)) ? $err_asunto : '';?></span></td>
		</tr>
		<tr>
			<td id="txt">Email :</td>
			<td><?php echo "$mail" ;?></td>
		</tr>
		<tr>
			<td id="txt">Prioridad :</td>
			<td>
				<!--input type="radio" name="prioridad" value="1" id="rd_prioridad"> Alta<br>
  				<input type="radio" name="prioridad" value="2" id="rd_prioridad"> media<br>
  				<input type="radio" name="prioridad" value="3" id="rd_prioridad"> baja<br><br-->
  				<div id="prueba_id">
  					<div id="prueba_2">
						<input type="radio" name="prioridad" value="1"" id="radio1" class="radio" />
						<label for="radio1" id="lab_prioridad">Alta</label>
					</div>
					<div id="prueba_2">
						<input type="radio" name="prioridad" value="2" id="radio2" class="radio"/>
						<label for="radio2" id="lab_prioridad">media</label>
					</div>
					<div id="prueba_2">	
						<input type="radio" name="prioridad" value="3" id="radio3" class="radio"/>
						<label for="radio3" id="lab_prioridad">baja</label>
					</div>	
				</div>
			</td>
			<td><span class="error"><?php  echo (isset($err_prioridad)) ? $err_prioridad : '';?></span></td>
		</tr>
		<tr>
			<td id="txt">Tipo Error :</td>
			<td><?php 
			$conn = new mysqli('localhost', 'root', '','incidencias');
        $sql = "SELECT * FROM `error`";
        $resultado=$conn->query($sql);
        $nfilas = $resultado->num_rows;
        if ($resultado){

        	 echo"<select name='t_err' id='error_select' class='soflow'>
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
			<td><span class="error"><?php echo (isset($err_tipo)) ? $err_tipo : '';?></span></td>
		</tr>
		<tr>
			<td id="txt">Descripción :</td>
			<td>
				<textarea rows="4" cols="50" name="descripccion">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td >Nota interna : </td>
			<td>
				<textarea  rows="4" cols="50"name="comentario" placeholder="max 140 caracteres">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="Crear_incidencia" class="btn_crear" value="Crear Incidencia"></td>
		</tr>
	</table>
</form>
</div>