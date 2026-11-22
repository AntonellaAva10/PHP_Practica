<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Inscripción</title>
</head>
<body>
    <h1>Registrar inscripción</h1>
    <a href="index.php">Volver al menú</a>
    <hr>
    <form method="POST" action="procesar_inscripcion.php">
        <label for="id_jugador">Jugador:</label>
        <select id="id_jugador" name="id_jugador" required>
            <?php
            include 'conexion.php';
            $sql_jugadores = "SELECT id_jugador, nombre, apellido FROM jugador";
            $res_jugadores = mysqli_query($con, $sql_jugadores);
            while ($jugador = mysqli_fetch_assoc($res_jugadores)) {
                echo "<option value='" . $jugador['id_jugador'] . "'>" . $jugador['nombre'] . " " . $jugador['apellido'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="id_torneo">Torneo:</label>
        <select id="id_torneo" name="id_torneo" required>
            <?php
            $sql_torneos = "SELECT id_torneo, nombre FROM torneo";
            $res_torneos = mysqli_query($con, $sql_torneos);
            while ($torneo = mysqli_fetch_assoc($res_torneos)) {
                echo "<option value='" . $torneo['id_torneo'] . "'>" . $torneo['nombre'] . "</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>