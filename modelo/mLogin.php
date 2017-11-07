<?php

if ($_SERVER["REQUEST_URI"] == "/dserAgenda/login/login.php") {
    session_start();
  }
class comprobarUsuario {
    private $username;
    private $password;
    private $link;

    public function __construct() {
        $this->link = new mysqli('localhost', 'root', '', 'dser_agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    public function comprobarUsuario() {
        self::set_names();

  if ((isset($_POST['username'])) && (isset($_POST['password']))){
        $username = $_POST['username'];
        $password = $_POST['password'];


        $sql="select idUsuario, username, password, rol from usuarios where username = '$username'";
        $result = mysqli_query($this->link, $sql);

        if (mysqli_num_rows($result) > 0) {

          $row = $result->fetch_array(MYSQLI_ASSOC);
          if (password_verify($password, $row['password'])) {
            if ($row['rol'] !== "2") {
              echo ("No eres administrador");
            } else {
              echo "Creando sesion";
             $_SESSION['loggedin'] = true;
             $_SESSION['username'] = $username;
             $_SESSION['start'] = time();
             $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
             header('Location: ../index.php');
             return true;
           }
        } else {
          return false;
        }
        $this->link=null;
    } else {
      echo "No existe ese usuario en la BBDD";
    }
    }
}
}
?>
