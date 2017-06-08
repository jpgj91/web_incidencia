<?php

/**
 * Created by PhpStorm.
 * User: JuanPablo
 * Date: 01/02/2017
 * Time: 15:45
 */
class Incidencia {
    private $id;
    private $description;
    private $asunto;
    private $prioridad;
    private $estado;
    private $assignado;
    private $reportado;
    private $error;
    private $fecha;




    function getid() {
        return $this -> id;
    }
     function getdescription() {
        return $this -> description;
    }
     function getasunto() {
        return $this -> asunto;
    }
     function getprioridad() {
        return $this -> prioridad;
    }
    function getestado() {
        return $this -> estado;
    }
    function getassignado() {
        return $this -> assignado;
    }
    function getreportado() {
        return $this -> reportado;
    }
    function geterror() {
        return $this -> error;
    }
     function getfecha() {
        return $this -> fecha;
    }

    function setid($id) {
        $this -> id = $id;
    }
    function setdescription($description) {
        $this -> description = $description;
    }
    function setassunto($asunto) {
        $this -> asunto = $asunto;
    }
    function setprioridad($prioridad) {
        $this -> prioridad = $prioridad;
    }
    function setrestado($estado) {
        $this -> estado = $estado;
    }
    function setassignado($assignado) {
        $this -> assignado = $assignado;
    }
    function setreportado($reportado) {
        $this -> reportado = $reportado;
    }
    function seterror($error) {
        $this -> error = $error;
    }
    function setfecha($fecha) {
        $this -> fecha = $fecha;
    }

}