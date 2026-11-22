<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Jugadores</title>
</head>
<body>
    <h1>Listado de Jugadores</h1>
    <a href="index.php">Volver al menú</a>
    <a href="formulario_jugador.php">Registrar nuevo jugador</a>
    <hr>
    <?php
    include 'conexion.php';
    $sql = "SELECT * FROM jugador";
    $result = mysqli_query($con, $sql);
    $cant = mysqli_num_rows($result);
    
    if ($cant > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>ID jugador</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>DNI</th>
                <th>Fecha de Nacimiento</th>
                <th>Teléfono</th>
                <th>Email</th>
            </tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id_jugador'] . "</td>";
            echo "<td>" . $row['nombre'] . "</td>";
            echo "<td>" . $row['apellido'] . "</td>";
            echo "<td>" . $row['dni'] . "</td>";
            echo "<td>" . $row['fecha_nacimiento'] . "</td>";
            echo "<td>" . $row['telefono'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No hay jugadores registrados.</p>";
    }
    mysqli_close($con);
    ?>
</body>
</html>