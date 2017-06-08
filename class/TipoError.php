<?php


class TipoError{
    private $id;
    private $name;
    

    function getid() {
        return $this -> id;
    }
     function getname() {
        return $this -> name;
    }
    

    function setid($id) {
        $this -> id = $id;
    }
    function setname($name) {
        $this -> name = $name;
    }
    

}
?>