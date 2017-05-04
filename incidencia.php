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

    function setid($id) {
        $this -> id = $id;
    }
    function setdescription($description) {
        $this -> description = $description;
    }
    function setassunto($asunto) {
        $this -> asunto = $asunto;
    }
    function setmail($prioridad) {
        $this -> prioridad = $prioridad;
    }
    function setrestadol($estado) {
        $this -> estado = $estado;
    }
    function setrol($assignado) {
        $this -> assignado = $assignado;
    }
    function setrol($reportado) {
        $this -> reportado = $reportado;
    }

}
?>