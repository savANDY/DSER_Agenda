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
