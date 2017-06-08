<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $user = $_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
	$vista_footer= 'view/footer.php';
	$vista_form='view/formulario_incidencia.php';
	require_once 'class/Incidencia.php';
	require_once $vista_header;
	/*codigo para que no entren en esta pagina si no eres el usuario indicado*/
	if(isset($_SESSION['usu_reg'])){
        if ($_SESSION['usu_reg'][4]==1) {}
            else{
                if ($_SESSION['usu_reg'][4]==2) {header("Location:incidencias_jefeproyecto.php");}
                 if ($_SESSION['usu_reg'][4]==3) {header("Location:incidencias_programador.php");}
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
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` where `reportador_usuario_id` ='$user'";

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
            <th id='t_cliente_est'>estado</th>
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
            $inc-> setrestado($fila[10	]);
            $inc-> setassignado($fila[5]);
            $inc-> setreportado($fila[6]);
            $inc-> setfecha($fila[8]);
               
            $prueba = $inc -> getid();
                 echo " <tr>
                            <td id='t_cerrar_id'>".$inc -> getid()."</td>
                            <td id='t_cerrar_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_cliente_est'>".$inc-> getestado()."</td>
                            <td id='t_cerrar_fecha'>".$inc-> getfecha()."</td>
                            <td id='t_cerrar_cerrar'>"."<form action='' method='post'>"."<input type='submit' name='close_incidencia' id='close_inc' value='$prueba'>"."</form>"."</td>
                        </tr>";
                }
                echo "</table>";
            }else{
        	 echo "<div>
                    <p>No tienes ninguna incidencia por cerrar</p>
                    </div>";
        }

        }
        	
       		
           ?>
         
           	
           
           
	</div>
	<div id="wrap_busqueda_inc">
		<form action="" method="post">
 			<fieldset>
  			<legend>Busqueda Incidencia:</legend>
  			Id Incidencia: <input type="text" name="search_id_number"><br>
  			<span class='error'><?php echo (isset($error_s_id)) ? $error_s_id : '';?></span>
  			<input type="submit" value="buscar" name="search_id">
 			</fieldset>
		</form>
	</div>
	<?php 
		$conn = new mysqli('localhost', 'root', '','incidencias');
			$sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join `error` ON `incidencia`.`error_id`=`error`.`id` join `prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id`WHERE `incidencia`.`id`='$id' ";
			$rest=$conn->query($sql);

    		$inc_c= new Incidencia();
    		$close_inc=$rest->fetch_array();
    		//echo '<pre>' . var_export($close_inc, true) . '</pre>';
    		$inc_c -> setid($close_inc[0]);
            $inc_c -> setdescription($close_inc[1]);
            $inc_c -> setassunto($close_inc[2]);
            $inc_c -> setprioridad($close_inc[14]);
            $inc_c-> setrestado($close_inc[10]);
            $inc_c-> setassignado($close_inc[5]);
            $inc_c-> setreportado($close_inc[6]);
            $inc_c-> seterror($close_inc[12]);
            $inc_c-> setfecha($close_inc[8]);


            $id= $inc_c -> getid($close_inc[0]);
            $asunto = $inc_c ->getasunto();
            $descripccion = $inc_c ->getdescription();
            $prioridad = $inc_c -> getprioridad();
            $estado = $inc_c-> getestado();
            $tipo_err = $inc_c-> geterror();
	
	if (isset($_POST['close_incidencia'])||isset($_POST['search_id'])) {
			if (isset($_POST['close_incidencia'])) {
			$id= $_POST['close_incidencia'];
			require_once $vista_form;
			}
			if (isset($_POST['search_id'])) {
				if (!empty($_POST['search_id_number'])) {
					$id= $_POST['search_id_number'];
					var_dump($id);
					$conn = new mysqli('localhost', 'root', '','incidencias');
					$sql_1 = "SELECT * FROM `incidencia` WHERE `incidencia`.`id`='$id' ";
					$res_inc=$conn->query($sql_1);
					
					if ($res_inc==true) {
						require_once $vista_form;
					}else{
						echo "el id no existe";
					}
					
				}else{
					$error_s_id = "no ha escrito ninguna incidencia";
				}
			}
		
	
         
		?>
	
		<?php 
		
		
		}
		   if (isset($_POST['Cerrar_incidencia'])) {
		   	var_dump($_POST);
			$id = (int)$_POST['id_usu'];
			$conn = new mysqli('localhost', 'root', '','incidencias');
				$sql ="UPDATE `incidencia` SET `estado_id`=5 WHERE`id`=$id";
						$Res=$conn->query($sql);
						
						if ($Res==true) {
							
						}else{echo "aqui pasa algo";}
						
			}
        ?>
		
<?php 
require_once $vista_footer;
?>