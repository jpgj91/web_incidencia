
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
	
    $sql = "SELECT * FROM `incidencia` where `reportador_usuario_id` ='$user'";

    $resultado=$conn->query($sql);
    
    $nfilas = $resultado->num_rows;
    
    $conn->close();
 
        echo "
        <table border = 1 cellspacing = 1 cellpadding = 1>
        <tr>
            <th>id</th>
            <th>descripcion</th>
            <th>asunto</th>
            <th>prioridad</th>
            <th>estado</th>
            <th>assinado</th>
            <th>reportador</th>
            <th>fecha</th>
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
            }

        }

       
           ?>
</body>
<?php 
require_once $vista_footer;
?>