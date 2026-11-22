<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pago</title>
</head>
<body>
    <h1>Registrar Pago</h1>
    <a href="index.php">Volver al menú</a>
    <hr>
    <?php include 'conexion.php';?>
    <form method="POST" action="procesar_pago.php">
        <label>inscripcion: </label><br>
        <select name="id_inscripcion">
            <?php
            $sql = "SELECT i.id_inscripcion, j.nombre AS nombre_jugador, j.apellido, t.nombre AS nombre_torneo 
            FROM inscripcion i
            INNER JOIN jugador j ON i.id_jugador = j.id_jugador
            INNER JOIN torneo t ON i.id_torneo = t.id_torneo";
            $res = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                echo "<option value='" . $row['id_inscripcion'] . "'>" . $row['nombre_jugador'] . " " . $row['apellido'] . " - " . $row['nombre_torneo'] . "</option>";
            }
            ?>
        </select><br><br>

        <laber>fehca de pago: </label><br>
        <input type="date" name="fecha_pago"><br><br>

        <label>importe: </label><br>
        <input type="number" name="importe" step="0.01"><br><br>
        <input type="submit" value="Registrar Pago">
    </form>
</body>
</html>