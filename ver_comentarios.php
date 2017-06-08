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
<div id="wrap_chat">
<h2>Comentarios</h2>
<form action="" method="post">
	
			<?php
        $prueba=$_POST['comentarios'];
      
			$conn = new mysqli('localhost', 'root','','incidencias');
        $sql = "SELECT comm.texto,comm.usuario_id,incidencias.usuario.name,incidencias.usuario.rol_id
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

        	 ?>
           <div id="chat">
       <?php  
            if ($nfilas > 0){
                for ($i=0; $i<$nfilas; $i++){
                  $fila=$resultado->fetch_array();
                   $arr= [
                        1=>[
                          "Chat"=>"titulo_chat",
                          "Chat_Nombre"=>"txt_chat_titulo",
                          "Texto"=>"texto_chat",
                          "Texto_contenido"=>"txt_texto"
                        ],
                        2=>[
                        "Chat"=>"titulo_chat_jefe",
                          "Chat_Nombre"=>"txt_chat_titulo_jefe",
                          "Texto"=>"texto_chat_jefe",
                          "Texto_contenido"=>"txt_texto_jefe"
                          
                        ],
                        3=>[
                          "Chat"=>"titulo_chat_programador",
                          "Chat_Nombre"=>"txt_chat_titulo_programador",
                          "Texto"=>"texto_chat_programador",
                          "Texto_contenido"=>"txt_texto_programador"
                        ]
                   ];
                   //var_dump($fila);
                   //echo '<pre>' . var_export($fila, true) . '</pre>';
                    echo"<div id=".$arr[$fila['rol_id']]['Chat'].">
                      <span id=".$arr[$fila['rol_id']]['Chat_Nombre'].">$fila[2]</span>
                      </div>";
                    echo"<div id=".$arr[$fila['rol_id']]['Texto'].">
                    <span id=".$arr[$fila['rol_id']]['Texto_contenido'].">$fila[0]</span>
                    </div>";

                 	

                }
                
            }
        }
            $conn->close();

            ?>
          </div>
</form>
</div>
<?php 
require_once $vista_footer;
?>