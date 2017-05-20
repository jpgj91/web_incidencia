
<?php 
    @session_start();
    $user=$_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
    $vista_Pcookie= 'view/cookies_politica.php';
	$vista_footer= 'view/footer.php';
	require_once 'class/Incidencia.php';
	require_once $vista_header;

?>
<link rel="stylesheet" type="text/css" href="style.css">
 <body>
 <?php 
       
$conn = new mysqli('localhost', 'root', '','incidencias');
 if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
	}
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id`";

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
                                <th id='t_id'>id</th>
                                <th id='t_asunto'>asunto</th>
                                <th id='t_prioridad'>prioridad</th>
                                <th id='t_estado'>estado</th>
                                <th id='t_assingacion'>assignado</th>
                                <th id='t_fecha'>fecha</th>
                                <th id='t_comentario'>Comentario</th>
                            </tr>";
                for ($i=0; $i<$nfilas; $i++){
                 $fila=$resultado->fetch_array();
                 $inc = new Incidencia();
            
            $inc -> setid($fila[0]);
            $inc -> setdescription($fila[1]);
            $inc -> setassunto($fila[2]);
            $inc -> setprioridad($fila[11]);
            $inc-> setrestado($fila[9]);
            $inc-> setassignado($fila[5]);
            $inc-> setreportado($fila[6]);
            $inc-> setfecha($fila[7]);
            $id=$inc -> getid();   

                echo " <tr>
                            <td id='t_id'>".$id."</td>
                            <td id='t_asunto'>".$inc -> getasunto()."</td>
                            <td id='t_prioridad'>".$inc -> getprioridad()."</td>
                            <td id='t_estado'>".$inc-> getestado()."</td>
                            <td id='t_assingacion'>".$inc-> getassignado()."</td>
                            <td id='t_fecha'>".$inc->  getfecha()."</td>
                            <td t_comentario>"."<input type='submit' name='comentarios' value='$id' id='chat'>"."</td>
                        </tr>";
                }
                echo "</table>";
            }

        }else{
             echo "<div>
                    <p>No tienes ninguna incidencia assignada</p>
                    </div>";
        }

       
           ?>
</body>
<?php 
require_once $vista_Pcookie;
require_once $vista_footer;
?>