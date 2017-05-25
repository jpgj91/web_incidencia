<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $user = $_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
	$vista_footer= 'view/footer.php';
	require_once 'class/Incidencia.php';
	require_once $vista_header;
	 if(isset($_SESSION['usu_reg'])){
        if ($_SESSION['usu_reg'][4]==3) {}
            else{
                if ($_SESSION['usu_reg'][4]==1) {header("Location:incidencias_cliente.php");}
                 if ($_SESSION['usu_reg'][4]==2) {header("Location:incidencias_jefeproyecto.php");}
            }
            }
        else{
        header("Location:home.php");
    }
?>
<link rel="stylesheet" type="text/css" href="style.css">
	<div id="wrap_tabla">
		<?php 
       
$conn = new mysqli('localhost', 'root', '','incidencias');
 if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
	}
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` where `asignado_usuario_id` ='$user'";

    $resultado=$conn->query($sql);
    
    $nfilas = $resultado->num_rows;
    
    $conn->close();
 
     
  if ($resultado){
        
                
            if ($nfilas > 0){
            	   echo "
        <table  id='cerrar_inc_cliente' >
        <tr>
            <th id='t_cerrar_id'>id</th>
            <th id='t_cerrar_asunto'>asunto</th>
            <th id='cliente_est'>estado</th>
            <th id='t_cerrar_fecha'>fecha</th>
            <th id='t_cerrar_cerrar'>Cerrar</th>
        </tr>";
                for ($i=0; $i<$nfilas; $i++){
                 $fila=$resultado->fetch_array();
                 $inc = new Incidencia();
			//echo '<pre>' . var_export($fila, true) . '</pre>';
            $inc -> setid($fila[0]);
            $inc -> setdescription($fila[1]);
            $inc -> setassunto($fila[2]);
            $inc -> setprioridad($fila[3]);
            $inc-> setrestado($fila[10]);
            $inc-> setassignado($fila[5]);
            $inc-> setreportado($fila[6]);
            $inc-> setfecha($fila[7]);
               
            $prueba = $inc -> getid();
                 echo " <tr>
                            <td id='t_cerrar_id'>".$inc -> getid()."</td>
                            <td id='t_cerrar_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_cerrar_fecha'>".$inc-> getestado()."</td>
                            <td id='t_cerrar_fecha'>".$inc-> getfecha()."</td>
                            <td id='t_cerrar_cerrar'>"."<form action='' method='post'>"."<input type='submit' name='close_incidencia' id='close_inc' value='$prueba'>"."</form>"."</td>
                        </tr>";
                }
                echo "</table>";
            }else{
        	 echo "<div>
                    <p>No tienes ninguna incidencia por revisar</p>
                    </div>";
        	}

        }
        	
       		
           ?>
         
           	
           
           
	</div>
	<?php 
		
	if (isset($_POST['close_incidencia'])) {
			$id= $_POST['close_incidencia'];
			
			$conn = new mysqli('localhost', 'root', '','incidencias');
			$sql = "SELECT * FROM `incidencia` WHERE `id`='$id' ";
			$res=$conn->query($sql);

    		$inc_c= new Incidencia();
    		$close_inc=$res->fetch_array();
    		
    		$inc_c -> setid($close_inc[0]);
            $inc_c -> setdescription($close_inc[1]);
            $inc_c -> setassunto($close_inc[2]);
            $inc_c -> setprioridad($close_inc[3]);
            $inc_c-> setrestado($close_inc[4]);
            $inc_c-> setassignado($close_inc[5]);
            $inc_c-> setreportado($close_inc[6]);
            $inc_c-> setfecha($close_inc[7]);

            $id= $inc_c -> getid($close_inc[0]);
            $asunto = $inc_c ->getasunto();
            $descripccion = $inc_c ->getdescription();
            $estado = $inc_c-> setrestado($close_inc[4]);
         
		?>
	<div id="wrap_form_Cerrar">
		<form action="" method="post">
			<table>
				<h3>Revisar Incidencia</h3>
				<tr>
					<td>Nombre</td>
					<td><?php echo "<input type='text' name='nombre' value='$nom' readonly>" ;?></td>
					<?php echo "<input type='hidden' name='id_usu' value='$id' readonly>" ;?>
				</tr>
				<tr>
					<td>Asunto</td>
					<td><?php echo "<input type='text' name='nombre' value='$asunto' readonly> " ;?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo "<input type='text' name='nombre' value='$mail' readonly> " ;?></td>
				</tr>
				<tr>
					<td>Prioridad</td>
					<td>
						<input type="radio" name="prioridad" value="1"> Alta
  						<input type="radio" name="prioridad" value="2"> media
  						<input type="radio" name="prioridad" value="3"> baja
					</td>
				</tr>
				<tr>
					<td>Asunto</td>
					<td>
						<textarea name="descripccion" readonly><?php echo $descripccion;?></textarea>
					</td>
				</tr>
				<tr>
					<td>Nota interna</td>
					<td>
						<textarea name="comentario" placeholder="max 140 caracteres"></textarea>
				</td>
				</tr>
				<tr>
					
				</tr>
				
			</table>
			<input type="submit" name="Cerrar_incidencia" value="Enviar Revision" id="button_cerrar">
		</div>
	</form>
		<?php 
		
		
		}
		   if (isset($_POST['Cerrar_incidencia'])) {
			$id = (int)$_POST['id_usu'];
			$conn = new mysqli('localhost', 'root', '','incidencias');
				$sql ="UPDATE `incidencia` SET `estado_id`=3 WHERE`id`=$id";
						$Res=$conn->query($sql);
						
						if ($Res==true) {
							if (!empty($_POST['comentario'])) {
								$coment =$_POST['comentario'];
								$conn = new mysqli('localhost', 'root', '','incidencias');
								$sql = 'INSERT INTO `comentario`(`texto`, `visibilidad_id`, `incidencia_id`, `usuario_id`) VALUES ("'.$coment.'","2","'.$id.'","'.$user.'")';
								$conn->query($sql);
								header('Location: incidencias_programador.php');
							}else{
									header('Location: incidencias_programador.php');
								}
						}else{echo "aqui pasa algo";}
						
			}
        ?>
		
<?php 
require_once $vista_footer;
?>