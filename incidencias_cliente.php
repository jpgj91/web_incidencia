
<?php 
    /*Iniciamo la session con los datos que el usuario tiene la base de datos*/
    @session_start();
    $user=$_SESSION['usu_reg'][0]; //variable donde guardaremos el id del usuario que se ha logeado en este momento
    /*Vistas necesarias para cargas la pagina*/
    $vista_header= 'view/header.php';
    $vista_Pcookie= 'view/cookies_politica.php';
	$vista_footer= 'view/footer.php';
    /*End Vista*/
    /*Clase necesarias*/
	require_once 'class/Incidencia.php';
    /*End clases*/
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
 <body>

 <?php 
       
$conn = new mysqli('localhost', 'root', '','incidencias');
 if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
	}
	
    $sql = "SELECT `incidencia`.`id`,`incidencia`.`asunto`,`prioridad`.`name`,`estado`.`name`,`usuario`.`name`,`error`.`name`,`incidencia`.`fecha` FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id` join`error` ON `incidencia`.`error_id`=`error`.`id`  left join`usuario` ON `incidencia`.`asignado_usuario_id`=`usuario`.`id`where `incidencia`.`reportador_usuario_id` ='$user' ORDER BY `incidencia`.`estado_id`";

    $resultado=$conn->query($sql); // variable donde guardaremos  la query que si es su valor sera true.
   
    $nfilas = $resultado->num_rows; // esto nos dira el numero de filas a la que la query afecta

    $conn->close(); 
 // Establecemos conexion con BD y creamos la query para que nos devuelva  lo que necesitemos   y la cerramos 

   
  if ($resultado){
        
                
            if ($nfilas > 0){ //decimos que si el numero de filas afectadas es  mayor que cero las imprima
                echo "
                <table id='incidecnias_general'>
                            <thead>
                            <tr>
                                <th  colspan='8'>Incidencias</th>
                            </tr>
                            </thead>
                             <tr>
                                <th id='t_id'>Id</th>
                                <th id='t_asunto'>Asunto</th>
                                <th id='t_prioridad'>Prioridad</th>
                                <th id='t_estado'>Estado</th>
                                <th id='t_assingacion'>Asignación</th>
                                <th id='t_prioridad'>Error</th>
                                <th id='t_fecha'>Fecha</th>
                                <th id='t_comentario'>Chat</th>
                            </tr>";
                for ($i=0; $i<$nfilas; $i++){
                    $fila=$resultado->fetch_array();
                    //echo '<pre>' . var_export($fila, true) . '</pre>';
                    $inc = new Incidencia();
                    $inc -> setid($fila[0]);
                    //$inc -> setdescription($fila[1]);
                    $inc -> setassunto($fila[1]);
                    $inc -> setprioridad($fila[2]);
                    $inc-> setrestado($fila[3]);
                    $inc-> setassignado($fila[4]);
                    //$inc-> setreportado($fila[5]);
                    $inc-> seterror($fila[5]);
                    $inc-> setfecha($fila[6]);
                    $id=$inc -> getid();
                    if ($inc -> getestado()=="cerrado") {
                           echo " <tr class='finalizado'>

                             <td id='t_id'>".$id."</td>
                            <td id='t_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_prioridad'>".$inc -> getprioridad()."</td>
                            <td id='t_estado'>".$inc-> getestado()."</td>
                            <td id='t_assingacion'>".$inc-> getassignado()."</td>
                            <td id='t_prioridad'>".$inc -> geterror()."</td>
                            <td id='t_fecha'>".$inc->  getfecha()."</td>
                            <td t_comentario>"."<form action='ver_comentarios.php' method='post'>"."<input type='submit' name='comentarios' value='$id' id='chat'>"."</form>"."</td>
                            
                        </tr>";
                        }else{
                        echo " <tr class='continued'>

                            <td id='t_id'>".$id."</td>
                            <td id='t_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_prioridad'>".$inc -> getprioridad()."</td>
                            <td id='t_estado'>".$inc-> getestado()."</td>
                            <td id='t_assingacion'>".$inc-> getassignado()."</td>
                            <td id='t_prioridad'>".$inc -> geterror()."</td>
                            <td id='t_fecha'>".$inc->  getfecha()."</td>
                            <td t_comentario>"."<form action='ver_comentarios.php' method='post'>"."<input type='submit' name='comentarios' value='$id' id='chat'>"."</form>"."</td>
                        </tr>";
                        }
                 
                }
                echo "</table>";
            }else{
                echo "<div>
                            <h2>No tienes ninguna incidencia</h2>
                            <p>*Crea incidencia para que aparezca.....</p><a href='Crearincidencia.php'>Pulsa aqui</a>
                    </div>";
            }

        }

       
           ?>

</body>
<?php 
require_once $vista_Pcookie;
require_once $vista_footer;
?>