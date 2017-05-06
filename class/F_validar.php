<?php
class Validar
{
    public $error_clave;
    public $error_mail;
    public $error_user;
    public $error_clave_con;

    public function validacion($user,$password,$confirm_pw,$email) {
        $valid_usuario = $this->validar_campo_usuario($user);
        $valid_pass    = $this->validar_password($password,$confirm_pw);
        $valid_email   = $this->validar_email($email);
        return $valid_usuario && $valid_pass && $valid_email  ?: false;
    }
    
    public function validarLogin($email,$password) {
        $valid_email    = $this->validar_email($email);
        $valid_pass    = $this->validar_clave($password);

        return $valid_email && $valid_pass  ?true : false;
    }
    
    public function validar_password($password,$confirm_pw) {
        return ($this->comparar_passwords($password,$confirm_pw) && $this->validar_clave($password)) ? true : false;
    }

    public function comparar_passwords($password,$confirm_pw) {
        if ($password === $confirm_pw) {
            return true;
        }
        $this->error_clave_con = 'los campos no son iguales ';
        return false;
    }

    public function validar_campo_usuario($user) {
        if(!empty($user))  {
            return true;
        }
        $this->error_user = "Campo vacio";
        return false;
    }
    function validar_clave($clave){
        if(strlen($clave) < 4){
            $this->error_clave = "La clave debe tener al menos 4 caracteres";
            return false;
        }
        return true;
    }
    function validar_email($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            return true;
        }
        $this->error_mail = "Campo Vacio o formato invalido";
        return false;
    }

}