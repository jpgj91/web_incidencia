
<?php 
/*Iniciamo la session con los datos que el usuario tiene la base de datos*/
    @session_start();
    $user=$_SESSION['usu_reg'][0];//variable donde guardaremos el id del usuario que se ha logeado en este momento
    /*Vistas necesarias para cargas la pagina*/
    $vista_header= 'view/header.php';
    $vista_Pcookie= 'view/cookies_politica.php';
	$vista_footer= 'view/footer.php';
     /*End Vista*/
    /*Clase necesarias*/
	require_once 'class/Incidencia.php';
	require_once $vista_header;
    /*codigo para que no entren en esta pagina si no eres el usuario indicado*/
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
 <body>
 <?php 
       
$conn = new mysqli('localhost', 'root', '','incidencias');
 if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
	}
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id` join`error` ON `incidencia`.`error_id`=`error`.`id` left join`usuario` ON `incidencia`.`asignado_usuario_id`=`usuario`.`id`where `incidencia`.`asignado_usuario_id` ='$user'" ;

    $resultado=$conn->query($sql);
   
    $nfilas = $resultado->num_rows;

    $conn->close();
 
       
  if ($resultado){
        
                
            if ($nfilas > 0){
                  echo "<table id='incidecnias_general'>
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
                 $inc = new Incidencia();
            //echo '<pre>' . var_export($fila, true) . '</pre>';
            $inc -> setid($fila[0]);
                    //$inc -> setdescription($fila[1]);
                    $inc -> setassunto($fila[2]);
                    $inc -> setprioridad($fila[12]);
                    $inc-> setrestado($fila[10]);
                    $inc-> setassignado($fila[16]);
                    //$inc-> setreportado($fila[5]);
                    $inc-> seterror($fila[14]);
                    $inc-> setfecha($fila[8]);
             $id=$inc -> getid();
                       if ($inc -> getestado()=="cerrado") { // le decimos que si el estado = cerrado los tr se llamen finalizado sino se llamen coninued
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
                    <p>No tienes ninguna incidencia que revisar</p>
                    </div>";
        }

        }

       
           ?>
</body>
<?php 
require_once $vista_Pcookie;
require_once $vista_footer;
?>