<?php
class Contacto {
    private $contacto;
    private $grupo;
    private $link;

    public function __construct() {
        $this->contacto = array();
        $this->link = new mysqli('localhost', 'root', '', 'dser_agenda');
    }

    private function set_names() {
        return $this->link->query("SET NAMES 'utf8'");
    }

    // public function insertarContacto($nombrePost, $apellidosPost, $telefonoPost, $email1Post, $email2Post, $grupoPost){
    //
    //   $sql="INSERT INTO contactos (contactos.Nombre, contactos.Apellidos, contactos.Telefono) VALUES ('$nombrePost', '$apellidosPost', '$telefonoPost');";
    //   mysqli_query($link, $sql);
    //   $sql="SELECT idContacto as id from contactos WHERE Nombre = '$nombrePost' AND Apellidos = '$apellidosPost' AND Telefono = '$telefonoPost'";
    //   $result = mysql_query($sql, $link) or die(mysql_error());
    //   $rowIdContacto = mysql_fetch_assoc($result);
    //   var idContacto = $rowIdContacto['id'];
    //
    //   sql="INSERT INTO emails (email, idContacto) VALUES ('$email1Post', '$idContacto')";
    //   mysqli_query($link, $sql);
    //
    //   if (!isEmpty($email2Post)){
    //   sql="INSERT INTO emails (email, idContacto) VALUES ('$email2Post', '$idContacto')";
    //   mysqli_query($link, $sql);
    //   }
    //
    //   sql="INSERT INTO grupos (idGrupo, idContacto) VALUES ('$grupoPost', '$idContacto')";
    //   mysqli_query($link, $sql);
    //
    //
    // }

    public function insertarContacto($nombrePost, $apellidosPost, $telefonoPost, $email1Post, $email2Post, $grupo1Post, $grupo2Post) {

      $consulta=$this->link->query("CALL spInsertUpdate()");
    }
    

    public function lista_grupos() {
      $sql="SELECT * FROM `grupos`";
      foreach ($this->link->query($sql) as $res) {
          $this->grupo[]=$res;
      }
      return $this->grupo;
      $this->link=null;
    }

    public function lista_contactos($orden, $nombre, $apellidos, $grupo) {
        self::set_names();

        switch ($orden) {
          case 'sinfiltro':
          $sql="select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
                from contactos c, emails e, grupos g, rel_grupos rg
                WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) $nombre $apellidos $grupo
                group by c.idContacto";
            break;
          case 'nombre':
          $sql="select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
                from contactos c, emails e, grupos g, rel_grupos rg
                WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) $nombre $apellidos $grupo
                group by c.idContacto order by c.Nombre";
            break;
          case 'apellido':
          $sql="select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
                from contactos c, emails e, grupos g, rel_grupos rg
                WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) $nombre $apellidos $grupo
                group by c.idContacto order by c.Apellidos";
            break;
          case 'grupo':
          $sql="select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
                from contactos c, emails e, grupos g, rel_grupos rg
                WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) $nombre $apellidos $grupo
                group by c.idContacto
                order by g.Nombre";
            break;
          default:
          $sql="select c.idContacto id, c.Nombre, c.Apellidos, c.Telefono, group_concat(distinct e.email separator '<br>') Email, group_concat(distinct g.Nombre separator '<br>') as Grupo
                from contactos c, emails e, grupos g, rel_grupos rg
                WHERE (rg.idContacto = c.idContacto) AND (g.idGrupo = rg.idGrupo) AND (e.idContacto = c.idContacto) $nombre $apellidos $grupo
                group by c.idContacto order by c.Nombre";
            break;
        }


        foreach ($this->link->query($sql) as $res) {
            $this->contacto[]=$res;
        }
        return $this->contacto;
        $this->link=null;
    }
}
?>
