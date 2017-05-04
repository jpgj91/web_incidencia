<!DOCTYPE html>
<html>

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
            <p id="fecha"><?php date_default_timezone_set('UTC'); echo date('l jS \of F Y h:i:s A');?></p>
           <!-- <section class="box effect1">
                <img src="<?php if(!empty($_SESSION['reg'])){echo "/Wok/imagenes/".$_SESSION["reg"][5];}else{echo "https://cops.usdoj.gov/html/dispatch/01-2013/images/no_ID.jpg"; }?>" width="50" height="50"  alt="">
                <p id="bienvenida"> <?php  if(empty($_SESSION["reg"])){echo"!Bienvenid@ Invitado!";}else{ echo "!Bienvenid@ ".$_SESSION["reg"][0]." (".$_SESSION["reg"][4].")!"; }   ?></p>

                
                <?php echo isset($button)  ? $button  : null;?>
                <form action="" method="post"><?php  if(!empty($_SESSION["reg"])){echo"<input type='submit' value='Salir' name='logout' id='slir'>";}else{}?></form>

             -->
            </section>
        </header>
        <nav>
            <ul>
                <li><a  href="#home">Incidencias</a></li>
                <li><a href="#news">Crear Incidencia</a></li>
                <li class="active" style=" float: right;"><a href="#news">cerrarsesion</a></li>
            </ul>

        </nav>
          </body>
          </html>