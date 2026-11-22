<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripciones</title>
</head>
<body>
    <h1> Listado de inscripciones</h1>
    <a href="index.php">Volver al menú</a>
    <a href="formulario_inscripcion.php">Registrar nueva inscripción</a>
    <hr>
    <?php
    include 'conexion.php';
    $sql = "SELECT i.id_inscripcion, i.fecha_inscripcion, j.nombre AS nombre_jugador, j.apellido, 
            j.dni, t.nombre AS nombre_torneo, t.deporte, t.categoria, t.importe, COUNT(p.id_pago) AS cantidad_pagos
            FROM inscripciones i
            JOIN jugador j ON i.id_jugador = j.id_jugador
            JOIN torneo t ON i.id_torneo = t.id_torneo
            LEFT JOIN pago p ON i.id_inscripcion = p.id_inscripcion
            GROUP BY i.id_inscripcion, j.nombre, j.apellido, j.dni, t.nombre, t.deporte, t.categoria, t.importe";
    $result = mysqli_query($con, $sql);
    $cant = mysqli_num_rows($result);

    if ($cant > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>ID Inscripción</th>
                <th>Fecha Inscripción</th>
                <th>Nombre Jugador</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Nombre Torneo</th>
                <th>Deporte</th>
                <th>Categoría</th>
                <th>Importe</th>
                <th>Cantidad de Pagos</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo   "<td>" . $row['id_inscripcion'] . "</td>";
            echo   "<td>" . $row['fecha_inscripcion'] . "</td>";
            echo   "<td>" . $row['nombre_jugador'] . "</td>";
            echo   "<td>" . $row['apellido'] . "</td>";
            echo   "<td>" . $row['dni'] . "</td>";
            echo   "<td>" . $row['nombre_torneo'] . "</td>";
            echo   "<td>" . $row['deporte'] . "</td>";
            echo   "<td>" . $row['categoria'] . "</td>";
            echo   "<td>" . $row['importe'] . "</td>";
            echo   "<td>" . ($row['cantidad_pagos'] > 0 ? "pago" : "sin pago") . "</td>";
            echo   "<td><a href='eliminar_inscripcion.php?id=" . $row['id_inscripcion'] . "'>Eliminar</a></td>";
            echo   "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay inscripciones registradas.</p>";
    }
    ?>

</body>
</html>