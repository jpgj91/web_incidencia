<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $user = $_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
	$vista_footer= 'view/footer.php';
	require_once 'class/Incidencia.php';
	require_once 'class/Usuario.php';
	require_once $vista_header;

    /*codigo para que no entren en esta pagina si no eres el usuario indicado*/
    if(isset($_SESSION['usu_reg'])){
        if ($_SESSION['usu_reg'][4]==2) {}
            else{
                if ($_SESSION['usu_reg'][4]==1) {header("Location:incidencias_cliente.php");}
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
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id` WHERE  `asignado_usuario_id` IS NULL and `estado_id`=1 ORDER BY `incidencia`.`prioridad_id` ASC,`incidencia`.`fecha`" ;

    $resultado=$conn->query($sql);
    
    $nfilas = $resultado->num_rows;
    
    $conn->close();
     
       
  if ($resultado){
        
                
            if ($nfilas > 0){
             echo "
                    <table  id='cerrar_inc_cliente' >
        <tr>
            <th id='t_cerrar_id'>Id</th>
            <th id='t_cerrar_asunto'>Asunto</th>
            <th id='t_cliente_est'>Estado</th>
            <th id='t_cliente_est'>Prioridad</th>
            <th id='t_cerrar_fecha'>Fecha</th>
            <th id='t_cerrar_cerrar'>Asignar</th>
        </tr>";
                for ($i=0; $i<$nfilas; $i++){
                 $fila=$resultado->fetch_array();
                 $inc = new Incidencia();
		//echo '<pre>' . var_export($fila, true) . '</pre>';
            $inc -> setid($fila[0]);
            $inc -> setdescription($fila[1]);
            $inc -> setassunto($fila[2]);
            $inc -> setprioridad($fila[12]);
            $inc-> setrestado($fila[10]);
            $inc-> setassignado($fila[5]);
            $inc-> setreportado($fila[6]);
            $inc-> seterror($fila[7]);
            $inc-> setfecha($fila[8]);
               
            $prueba = $inc -> getid();
                 echo " <tr>
                            <td id='t_cerrar_id'>".$inc -> getid()."</td>
                            <td id='t_cerrar_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_cliente_est'>".$inc-> getestado()."</td>
                            <td id='t_cliente_est'>".$inc-> getprioridad()."</td>
                            <td id='t_cerrar_fecha'>".$inc-> getfecha()."</td>
                            <td id='t_cerrar_cerrar'>"."<form action='' method='post'>"."<input type='submit' name='close_incidencia' id='close_inc' value='$prueba'>"."</form>"."</td>
                        </tr>";
                }
                echo "</table>";
            }else{
             echo "<div>
                        <p>No tienes ninguna incidencia Por assignada</p>
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
			
					<h2 id="asig_titul">Seleccione un programador</h2>
					<?php echo "<input type='hidden' name='id_usu' value='$id' readonly>" ;?>
					<?php
       						$conn = new mysqli('localhost', 'root', '','incidencias');
       	 					$sql = "SELECT * FROM `usuario` WHERE `rol_id`=3";
       						$res=$conn->query($sql);
        					$nfilas = $res->num_rows;
        						if ($res){

                                 echo "<div id='programadores_list'>";       
            					if ($nfilas > 0){
                					for ($i=0; $i<$nfilas; $i++){
                    				$fila=$res->fetch_array();
                                
                    				$usu_p =new Usuario();

                    				$usu_p->setid($fila[0]);
                    				$usu_p->setname($fila[1]);
                    				$usu_p->setpass($fila[2]);
                    				$usu_p->setmail($fila[3]);
                    				$usu_p->setrol($fila[4]);

                    				$id_p=$usu_p->getid();
                    				$name_p=$usu_p->getname();

                    			echo"<input type='radio' name='programador' value='$id_p'>".$name_p."<br>";
                    			
                			}
                            echo "</div>";
            			}

            		$conn->close();
        			}?>
                    <div id="mas_comentario">
                    <h3 id="asig_titul_comt">Añadir  Comentario</h3>
                    <textarea name="comentario" rows="4" cols="50"></textarea>
                    </div>
        			<input type="submit" name="assignado_p" value="Asignar" class="btn_asignar">
                    <hr>
                    <div id="rechazo comentario">
                    <h2 id="rechazar_titulo">Rechazar</h2>
                    <h3 id="rechazar_titul_comt">Añadir Comentario</h3>
                    <textarea name="rechazo_mens" rows="4" cols="50"></textarea>
                    </div>
                    <input type="submit" name="Rechazar" value="Rechazar" class="btn_rechazar">
                    <span id="error"></span>
                   
		</div>
	</form>
		<?php 
		
		
		}
		   if (isset($_POST['assignado_p'])) {
		   

			$id = (int)$_POST['id_usu'];
			$valor = (isset($_POST['programador'])) ? $_POST['programador']   : null;;
				if(!empty($valor)){
						$conn = new mysqli('localhost', 'root', '','incidencias');
						$sql ="UPDATE `incidencia` SET `asignado_usuario_id`=$valor WHERE`id`=$id";
                        $sql1 ="UPDATE `incidencia` SET `estado_id`=2 WHERE`id`=$id";
						$Res=$conn->query($sql);
                        $Res1=$conn->query($sql1);
						if ($Res==true && $Res1==true) {
                            if (!empty($_POST['comentario'])) {
                                $coment =$_POST['comentario'];
                                $conn = new mysqli('localhost', 'root', '','incidencias');
                                $sql = 'INSERT INTO `comentario`(`texto`, `visibilidad_id`, `incidencia_id`, `usuario_id`) VALUES ("'.$coment.'","2","'.$id.'","'.$user.'")';
                                $conn->query($sql);
                                header('Location: incidencias_jefeproyecto.php');
                            }else{
                                   
                                }
							
						}else{}
				}else{
                    echo '<script language="javascript">alert("falta seleccionar programador para asignar la Incidiencia: ");</script>'; 
					//$error="falta seleccionar programador";
					//echo $error;
				}
                header('Location: incidencias_jefeproyecto.php');
			}
            if (isset($_POST['Rechazar'])) {
                $id = (int)$_POST['id_usu'];
                if (!empty($_POST['rechazo_mens'])) {
                $conn = new mysqli('localhost', 'root', '','incidencias');
                $sql ="UPDATE `incidencia` SET `estado_id`=5 WHERE`id`=$id";
                $result=$conn->query($sql);
                 if ($result== true) {
                    
                        $msn =$_POST['rechazo_mens'];
                        $conn = new mysqli('localhost', 'root', '','incidencias');
                        $sql = 'INSERT INTO `comentario`(`texto`, `visibilidad_id`, `incidencia_id`, `usuario_id`) VALUES ("'.$msn.'","1","'.$id.'","'.$user.'")';
                        $res=$conn->query($sql);
                        header('Location: incidencias_jefeproyecto.php');
                    }
                }else{
                         echo '<script language="javascript">alert("Debe poner un mensaje para rechazar la Incidiencia: ");</script>'; 
                    }
            }
       
        ?>
		
<?php 

require_once $vista_footer;
?>