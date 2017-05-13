
<?php 
    @session_start();
    $user=$_SESSION['usu_reg'][0];
    $vista_header= 'view/header.php';
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
	
    $sql = "SELECT * FROM `incidencia` join`estado` ON `incidencia`.`estado_id`=`estado`.`id` join`prioridad` ON `incidencia`.`prioridad_id`=`prioridad`.`id` where `incidencia`.`reportador_usuario_id` ='$user'";

    $resultado=$conn->query($sql);
   
    $nfilas = $resultado->num_rows;

    $conn->close();
 
   
  if ($resultado){
        
                
            if ($nfilas > 0){
                echo "<table id='incidecnias_general'>
                            <thead>
                                <th  colspan='8'>incidencias</th>
                            </thead>
                            <tr>
                                <th>id</th>
                                <th>descripcion</th>
                                <th>asunto</th>
                                <th>prioridad</th>
                                <th>estado</th>
                                <th>assignado</th>
                                <th>reportador</th>
                                <th>fecha</th>
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
                 echo " <tr>
                            <td>".$inc -> getid()."</td>
                            <td>".$inc -> getdescription()."</td>
                            <td>".$inc -> getasunto()."</td>
                            <td>".$inc -> getprioridad()."</td>
                            <td>".$inc-> getestado()."</td>
                            <td>".$inc-> getassignado()."</td>
                            <td>".$inc->  getreportado()."</td>
                            <td>".$inc->  getfecha()."</td>
                        </tr>";
                }
                echo "</table>";
            }else{
                echo "<div>
                            <h2>No tienes ninguna incidencia</h2>
                            <p>*Crea incidencia para que aparezca.....</p><a href='#'>Pulsa aqui</a>
                    </div>";
            }

        }

       
           ?>
</body>
<?php 
require_once $vista_footer;
?>