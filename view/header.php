<!DOCTYPE html>
<html>
<?php 
    @session_start();
    
?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>header</title>
       <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
  
        <header id="head">
            <section id="logo">
                
            </section>
            <section class="usuario">
                <p id="bienvenida"> <?php  if(empty($_SESSION["usu_reg"])){}else{ echo "Usuario: ".$_SESSION["usu_reg"][1]; }  ?></p>
            </section>
            <section class="fecha">
                <p id="fecha"><?php  setlocale(LC_TIME, 'spanish'); echo strftime('%A, %d  %B ');?></p>
            </section>
            
           
            </section>
        </header>
        <nav>
            <ul>
            
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='incidencias_cliente.php'>Incidencias</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='CrearIncidencia.php'>crear incidencia</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ if($_SESSION["usu_reg"][4]==1){echo "<li><a  href='cerrar_incidencias.php'>Cerrar incidencia</a></li>";} }?>
                <?php if(empty($_SESSION["usu_reg"])){}else{ echo "<li class='active' style=' float: right;'><a href='logout.php'>cerrarsesion</a></li>"; }?>
                
            </ul>

        </nav>
          </body>
          </html>