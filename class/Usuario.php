<?php


class Usuario {
    private $id;
    private $name;
    private $pass;
    private $mail;
    private $rol;

    function getid() {
        return $this -> id;
    }
     function getname() {
        return $this -> name;
    }
     function getpass() {
        return $this -> pass;
    }
     function getmail() {
        return $this -> mail;
    }
    function getrol() {
        return $this -> rol;
    }

    function setid($id) {
        $this -> id = $id;
    }
    function setname($name) {
        $this -> name = $name;
    }
    function setpass($pass) {
        $this -> pass = $pass;
    }
    function setmail($mail) {
        $this -> mail = $mail;
    }
    function setrol($rol) {
        $this -> rol = $rol;
    }

}
?>