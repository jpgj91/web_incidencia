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
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id`WHERE  `asignado_usuario_id` IS NULL ORDER BY `incidencia`.`prioridad_id` ASC,`incidencia`.`fecha`" ;

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
            <th id='t_cliente_est'>prioridad</th>
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
			
					<p>Seleccione un programador</p>
					<?php echo "<input type='hidden' name='id_usu' value='$id' readonly>" ;?>
					<?php
       						$conn = new mysqli('localhost', 'root', '','incidencias');
       	 					$sql = "SELECT * FROM `usuario` WHERE `rol_id`=3";
       						$res=$conn->query($sql);
        					$nfilas = $res->num_rows;
        						if ($res){


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

                    			echo"<label><input type='radio' name='programador' value='$id_p'>".$name_p."</label>"."<br>";
                    			
                			}

            			}

            		$conn->close();
        			}?>
                    <div id="mas_comentario">
                    <label>añadir algun comentario</label><br>
                    <textarea name="comentario"></textarea><br>
                    </div>
        			<input type="submit" name="assignado_p" value="Assignar">
		</div>
	</form>
		<?php 
		
		
		}
		   if (isset($_POST['assignado_p'])) {
		   

			$id = (int)$_POST['id_usu'];
			$valor = $_POST['programador'];
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
                                    header('Location: incidencias_jefeproyecto.php');
                                }
							
						}else{echo "aqui pasa algo";}
				}else{
					$error="falta seleccionar programador";
					echo $error;
				}
			}
        ?>
		
<?php 
require_once $vista_footer;
?>