<?php 
    @session_start();
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $user = $_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
	$vista_footer= 'view/footer.php';
    $vista_form='view/formulario_incidencia.php';
    $id='';// inicializamos variable y la ponemos sin valor para que evite un notice, sera variable que ayude a sacar el id de la incidencias
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
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` where `estado_id` =5";

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
            <th id='t_cerrar_cerrar'>Ver</th>
            <th id='t_cerrar_cerrar'>Chat</th>
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
            $inc-> setfecha($fila[8]);
             $id=$inc -> getid();   
            $prueba = $inc -> getid();
                 echo " <tr>
                            <td id='t_cerrar_id'>".$inc -> getid()."</td>
                            <td id='t_cerrar_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_cliente_est'>".$inc-> getestado()."</td>
                            <td id='t_cerrar_fecha'>".$inc-> getfecha()."</td>
                            <td id='t_cerrar_cerrar'>"."<form action='' method='post'>"."<input type='submit' name='close_incidencia' id='close_inc' value='$prueba'>"."</form>"."</td>
                            <td t_comentario>"."<form action='ver_comentarios.php' method='post'>"."<input type='submit' name='comentarios' value='$id' id='chat'>"."</form>"."</td>
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
            <fieldset class="busq_inc">
            <legend>Busqueda Incidencia:</legend>
            Id Incidencia: <input type="text" name="search_id_number"><br>
            <input type="submit" value="buscar" name="search_id" id="button_cerrar">
            </fieldset>
        </form>
    </div>
    <?php 
        
    if (isset($_POST['close_incidencia'])) {
            $id= $_POST['close_incidencia'];
            
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
            require_once $vista_form;
            }
            if (isset($_POST['search_id'])) {
                if (!empty($_POST['search_id_number'])) {
                    $id= $_POST['search_id_number'];
                    $conn = new mysqli('localhost', 'root', '','incidencias');
                    $sql_1 = "SELECT * FROM `incidencia` WHERE `incidencia`.`id`='$id' and `incidencia`.`estado_id`=5 ";
                    $res_inc=$conn->query($sql_1);
                    
                        if ($conn->affected_rows == 1) {
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
                                require_once $vista_form;
                        }else{
                        echo "<script type=\"text/javascript\">alert(\"El id insertado no existe o no esta pendiente de revision por parte tu parte\");</script>";  
                    }   
                }else{
                    echo "<script type=\"text/javascript\">alert(\"No se ha escrito ninguna incidencia\");</script>";  
                }
            }

        ?>
		<?php 
		
		
		
		   if (isset($_POST['Cerrar_incidencia'])) {
            $id = (int)$_POST['id_usu'];
            $conn = new mysqli('localhost', 'root', '','incidencias');
                $sql ="UPDATE `incidencia` SET `estado_id`=1 WHERE`id`=$id";
                        $Res=$conn->query($sql);
                        
                        if ($Res==true) {
                            if (!empty($_POST['comentario'])) {
                                $coment =$_POST['comentario'];
                                $conn = new mysqli('localhost', 'root', '','incidencias');
                                $sql = 'INSERT INTO `comentario`(`texto`, `visibilidad_id`, `incidencia_id`, `usuario_id`) VALUES ("'.$coment.'","1","'.$id.'","'.$user.'")';
                                $conn->query($sql);
                                header('Location: incidencias_cliente.php');
                            }else{
                                    header('Location: incidencias_cliente.php');
                                }
                            
                        }else{echo "aqui pasa algo";}
                        
            }
        ?>
		
<?php 
require_once $vista_footer;
?>