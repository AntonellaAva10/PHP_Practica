<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de torneos</title>
</head>
<body>
    <h1>Listado de torneos</h1>
    <a href="index.php">Volver al menú</a>
    <a href="formulario_torneo.php">Registrar nuevo torneo</a>
    <hr>
    <?php
    include 'conexion.php';
    $sql = "SELECT * FROM torneo";
    $result = mysqli_query($con, $sql);
    $cant = mysqli_num_rows($result);

    if ($cant > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>ID Torneo</th>
                <th>Nombre</th>
                <th>Deporte</th>
                <th>Categoría</th>
                <th>Importe</th>
                <th>Acciones</th>
              </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_torneo'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['deporte'] . "</td>";
            echo "<td>" . $row['categoria'] . "</td>";
            echo "<td>" . $row['importe'] . "</td>";
            echo "<td><a href='eliminar_torneo.php?id=" . $row['id_torneo'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<p>No hay torneos registrados.</p>";
    }
    mysqli_close($con);
    ?>
</body>
</html>