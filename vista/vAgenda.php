<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Agenda - Ejercicio de Repaso</title>
</head>
<body>
    <h1>Contactos</h1>
    <table border="1">
        <tr>
            <td><strong>Nombre</strong></td>
            <td><strong>Apellidos</strong></td>
            <td><strong>Telefono</strong></td>
        </tr>
        <?php
            for($i=0;$i<count($row);$i++)
            {
                ?>
                    <tr>
                        <td><?php echo $row[$i]["Nombre"]; ?></td>
                        <td><?php echo $row[$i]["Apellidos"]; ?></td>
                        <td><?php echo $row[$i]["Telefono"]; ?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
</body>
</html>
