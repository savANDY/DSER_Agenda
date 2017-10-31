<?php
class comprobarUsuario {
    private $nombre;
    private $password;
    private $link;

    public function __construct() {
        $this->usuario = array();
        $this->link = new mysqli('localhost', 'root', '', 'dser_agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    public function comprobarUsuario() {
        self::set_names();

        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        $sql="select idUsuario, Nombre, Password, idRol from usuarios where Nombre = '$usuario'";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) > 0) {

          $row = $result->fetch_array(MYSQLI_ASSOC);
          if (password_verify($password, $row['Password'])) {

            $nombre = $row['Nombre'];
             $_SESSION['loggedin'] = true;
             $_SESSION['username'] = $nombre;
             $_SESSION['start'] = time();
             $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
             return true;
        } else {
          return false;
        }
        $this->link=null;
    }
}
}
?>
