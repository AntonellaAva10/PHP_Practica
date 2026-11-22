<?php
    include 'conexion.php';

    $nombre = $_POST['nombre'];
    $deporte = $_POST['deporte'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $categoria = $_POST['categoria'];
    $importe = $_POST['importe'];
    $max_participantes = $_POST['max_participantes'];

    // validacion de campos vacios
    if (empty($nombre) || empty($deporte) || empty($fecha_inicio) || empty($fecha_fin) || empty($categoria) || empty($importe) || empty($max_participantes)) {
        echo "<p>Todos los campos son obligatorios.</p>";
        echo "<a href='formulario_torneo.php'>volver</a>";
        exit();
    }

    // validacion de fechas
    if ($fecha_inicio >= $fecha_fin) {
        echo "<p>La fecha de inicio debe ser anterior a la fecha de fin.</p>";
        echo "<a href='formulario_torneo.php'>volver</a>";
        exit();
    }

    // validacion importe y max_participantes
    if (!is_numeric($importe) || $importe <= 0) {
        echo "<p>El importe debe ser un número positivo.</p>";
        echo "<a href='formulario_torneo.php'>volver</a>";
        exit();
    }
    if (!is_numeric($max_participantes) || $max_participantes <= 0) {
        echo "<p>La cantidad máxima de participantes debe ser un número positivo.</p>";
        echo "<a href='formulario_torneo.php'>volver</a>";
        exit();
    }

    $sql = "INSERT INTO torneo (nombre, deporte, fecha_inicio, fecha_fin, categoria, importe, max_participantes) VALUES ('$nombre', '$deporte', '$fecha_inicio', '$fecha_fin', '$categoria', $importe, $max_participantes)";
    if (mysqli_query($con, $sql)) {
        header("Location: listado_torneos.php");
        exit();
    } else {
        echo "<p>Error al registrar el torneo: " . mysqli_error($con) . "</p>";
        echo "<a href='formulario_torneo.php'>volver</a>";
    }
?>