<?php
class comprobarSiExiste {

  public function __construct() {
      $this->contacto = array();
      $this->link = new mysqli('localhost', 'root', '', 'dser_agenda');
  }

  public function comprobar() {
  $sql = "SELECT * FROM usuarios WHERE Nombre='$nombre' LIMIT 1";
  $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        return false;
    } else {
      return true;
    }
  }
}
?>
