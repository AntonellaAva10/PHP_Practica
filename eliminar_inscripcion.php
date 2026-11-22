<?php
    include 'conexion.php';
    $id = $_GET['id'];

    // verificar si hay pagos asociados a la inscripción
    $sql_pagos = "SELECT id_pago from pago WHERE id_inscripcion = $id";
    $res_pagos = mysqli_query($con, $sql_pagos);

    if (mysqli_num_rows($res_pagos) > 0) {
        echo "<p>No se puede eliminar la inscripción, ya tiene pagos asociados.</p>";
        echo "<a href='listado_inscripciones.php'>Volver al listado</a>";
        exit();
    } else {
        if(isset($_POST['confirmar'])) {
            // obtener id torneo
            $sql_torneo = "SELECT id_torneo FROM inscripcion WHERE id_inscripcion = $id";
            $res_torneo = mysqli_query($con, $sql_torneo);
            $row_torneo = mysqli_fetch_assoc($res_torneo);
            $id_torneo = $torneo['id_torneo'];

            // eliminar la inscripción
            $sql_delete = "DELETE FROM inscripcion WHERE id_inscripcion = $id";

            // Actualizamos la cantidad de inscriptos en el torneo
            $sql_update = "UPDATE torneo SET cantidad_inscriptos = cantidad_inscriptos - 1 WHERE id_torneo = $id_torneo";
            if (mysqli_query($con, $sql_delete) && mysqli_query($con, $sql_update)) {
                header("Location: listado_inscripciones.php");
                exit();
            } else {
                echo "<p>Error al eliminar la inscripción: " . mysqli_error($con) . "</p>";
                echo "<a href='listado_inscripciones.php'>Volver al listado</a>";
            }
        } else {  
            // Mostrar formulario de confirmación
            $sql_select = "SELECT i.id_inscripcion, i.fecha_inscripcion, j.nombre AS nombre_jugador, j.apellido, j.dni, t.nombre AS nombre_torneo, t.deporte
                            FROM inscripcion i
                            JOIN jugador j ON i.id_jugador = j.id_jugador
                            JOIN torneo t ON i.id_torneo = t.id_torneo
                            WHERE i.id_inscripcion = $id";
            $res_select = mysqli_query($con, $sql_select);
            $row_select = mysqli_fetch_assoc($res_select);
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Cancelar Inscripcion</title>
            </head>
            <body>
                <h1>Confirmar cancelación de inscripción</h1>
                <a href="listado_inscripciones.php">Volver al listado</a>
                <hr>

                <p>¿Estás seguro de que deseas cancelar la inscripción?</p>
                <p><strong>Jugador:</strong> <?php echo $row_select['nombre_jugador']; ?>
                <p><strong>Apellido:</strong> <?php echo $row_select['apellido']; ?></p>
                <p><strong>DNI:</strong> <?php echo $row_select['dni']; ?></p>
                <p><strong>Torneo:</strong> <?php echo $row_select['nombre_torneo']; ?></p>
                <p><strong>Deporte:</strong> <?php echo $row_select['deporte']; ?></p>
                <p><strong>Fecha de inscripción:</strong> <?php echo $row_select['fecha_inscripcion']; ?></p>
                <form method="POST" action="eliminar_inscripcion.php?id=<?php echo $id; ?>">
                    <input type="submit" name="confirmar" value="si, cancelar">
                    <a href="listado_inscripciones.php">No, volver al listado</a>
                </form>
            </body>
            </html>
            <?php
        }
    }
    mysqli_close($con);
?>