<?php
class Contacto {
    private $contacto;
    private $link;

    public function __construct() {
        $this->contacto = array();
        $this->link = new mysqli('localhost', 'root', '', 'dser_agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    public function lista_contactos() {
        self::set_names();
        $sql="select idContacto, Nombre, Apellidos, Telefono from contactos";
        foreach ($this->link->query($sql) as $res) {
            $this->contacto[]=$res;
        }
        return $this->contacto;
        $this->link=null;
    }
}
?>
