<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $user = $_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
	$vista_footer= 'view/footer.php';
	require_once 'class/Incidencia.php';
	require_once $vista_header;
?>
<link rel="stylesheet" type="text/css" href="style.css">
	<div id="wrap_tabla">
		<?php 
       
$conn = new mysqli('localhost', 'root', '','incidencias');
 if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
	}
	
    $sql = "SELECT * FROM `incidencia` where `reportador_usuario_id` ='$user'";

    $resultado=$conn->query($sql);
    
    $nfilas = $resultado->num_rows;
    
    $conn->close();
 
        echo "
        <table  id='cerrar_inc_cliente' >
        <tr>
            <th id='cliente_id'>id</th>
            <th>asunto</th>
            <th id='cliente_est'>estado</th>
            <th>fecha</th>
            <th>Cerrar</th>
        </tr>";
  if ($resultado){
        
                
            if ($nfilas > 0){
                for ($i=0; $i<$nfilas; $i++){
                 $fila=$resultado->fetch_array();
                 $inc = new Incidencia();

            $inc -> setid($fila[0]);
            $inc -> setdescription($fila[1]);
            $inc -> setassunto($fila[2]);
            $inc -> setprioridad($fila[3]);
            $inc-> setrestado($fila[4]);
            $inc-> setassignado($fila[5]);
            $inc-> setreportado($fila[6]);
            $inc-> setfecha($fila[7]);
               
            $prueba = $inc -> getid();
                 echo " <tr>
                            <td id='cliente_id'>".$inc -> getid()."</td>
                            <td>".$inc -> getasunto()."</td>
                            <td id='cliente_est'>".$inc-> getestado()."</td>
                            <td>".$inc-> getfecha()."</td>
                            <td>"."<form action='' method='post'>"."<input type='submit' name='close_incidencia' id='close_inc' value='$prueba'>"."</form>"."</td>
                        </tr>";
                }
                echo "</table>";
            }

        }
        	
       		
           ?>
         
           	
           
           
	</div>
	<?php 
		var_dump($_POST['close_incidencia']);
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
						<textarea placeholder="max 140 caracteres"></textarea>
				</td>
				</tr>
				<tr>
					<td><input type="submit" name="Cerrar_incidencia" value="cerrar_incidencia"></td>
				</tr>
			</table>
		</div>
	</form>
		<?php 
		
		
		}
		   if (isset($_POST['Cerrar_incidencia'])) {
		   	var_dump($_POST);
			$id = (int)$_POST['id_usu'];
			$conn = new mysqli('localhost', 'root', '','incidencias');
				$sql ="UPDATE `incidencia` SET `estado_id`=3 WHERE`id`=$id";
						$Res=$conn->query($sql);
						var_dump($Res);
						if ($Res==true) {
							
						}else{echo "aqui pasa algo";}
						
			}
        ?>
		
<?php 
require_once $vista_footer;
?>