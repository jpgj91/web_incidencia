<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
    <body>
     <header>
        <div id="head"> 
        </div>
        <div id="nav">
        </div>
     </header>

  
        <div></div>
        <form  class="wrap_log" action="" method="post">
        <div id="cabecera">
            <header>Login</header>
        </div>
        <section id="login_txt">
        <div id="login_txt_usu">
            <label>E-mail</label><input type="text" name="email">
             <span class="error"><?php echo (isset($Usuerror)) ? $Usuerror : '';?><?php echo (isset($usuarioerr)) ? $usuarioerr : '';?></span>
        </div>
        <div id="login_txt_pass">
            <label>Password</label><input type="password" name="pass">
             <span class="error"><?php echo (isset($passerr)) ? $passerr : '';?></span>
        </div>
        <div id="login_btn">
            <input  class="btn" type="submit" value="Logearse" name="Logearse">
            <a href="F_registro.php" class="btn"  name="Login" >Registrarse</a>
        </div>
        </section>
        </form>
   
    </body>
</html>