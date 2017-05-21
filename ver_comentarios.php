<?php 
    @session_start();
    $id=$_SESSION['usu_reg'][0];
    $nom=$_SESSION['usu_reg'][1];
    $mail=$_SESSION['usu_reg'][2];
    $vista_header= 'view/header.php';
    
    $vista_footer= 'view/footer.php';
  require_once 'class/Incidencia.php';
  require_once $vista_header;

   
?>
<link rel="stylesheet" type="text/css" href="style.css">
<h2>Comentarios</h2>
<form action="" method="post">
	
			<?php
        $prueba=$_POST['comentarios'];
 
			$conn = new mysqli('localhost', 'root','','incidencias');
        $sql = "SELECT comm.texto,comm.usuario_id,incidencias.usuario.name
				FROM incidencias.comentario AS comm
 				JOIN incidencias.usuario ON incidencias.usuario.id = comm.usuario_id
				WHERE comm.incidencia_id = $prueba AND
      			comm.visibilidad_id IN (
       			SELECT incidencias.rol_has_visibilidad.visibilidad_id
        		FROM incidencias.rol_has_visibilidad
         		JOIN incidencias.usuario ON incidencias.usuario.id = $id
        		WHERE
          		incidencias.rol_has_visibilidad.rol_id = incidencias.usuario.rol_id
      			)";

       
        $resultado=$conn->query($sql);
        $nfilas = $resultado->num_rows;


        if ($resultado){

        	 
       
            if ($nfilas > 0){
                for ($i=0; $i<$nfilas; $i++){
                  $fila=$resultado->fetch_array();
                   //echo '<pre>' . var_export($fila, true) . '</pre>';
                    echo"<labale>$fila[2]</label>";
                    echo"<p>$fila[0]</p>";

                 	

                }
                
            }
        }
            $conn->close();

            ?>
</form>
<?php 
require_once $vista_footer;
?>