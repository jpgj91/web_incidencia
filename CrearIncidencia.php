<?php

session_start();
require_once 'class/incidencia.php';
$vista = 'view/home_cliente.php';
$vista_header= 'view/header.php';
$vista_footer= 'view/footer.php';
if (isset($_POST['Crear_incidencia'])) {
	if (!empty($_POST['asunto'])) {
		if (!empty($_POST['prioridad'])) {
			$asunto   = $_POST['asunto'];
			$priority = $_POST['prioridad'];
			$mensaje  = $_POST['descripccion'];
			$user=$_SESSION['usu_reg'][0];
			$estado  = 1;
			$null = "";
			$fecha=strftime( "%d/%m/%Y ", time() );
			$conn = new mysqli('localhost', 'root', '','incidencias');
			$sql = 'INSERT INTO `incidencia` (descripcion,asunto,prioridad_id,estado_id,reportador_usuario_id)
                 VALUES ("'.$mensaje.'","'.$asunto.'","'.$priority.'","'.$estado.'","'.$user.'")';
                
                 if ($conn->query($sql) === TRUE) {
                 	header('Location: incidencias_cliente.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            $conn->close();
           
             
		}else{
			echo "radio buton vacio";
		}
	}else{
		echo "Asunto no puede estar vacio";
	}
}else{
	echo"en proceso";

}

require_once $vista_header;
require_once $vista;
require_once $vista_footer;