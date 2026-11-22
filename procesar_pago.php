<?php
    include 'conexion.php';

    $id_inscripcion = $_POST['id_inscripcion'];
    $fecha_pago = $_POST['fecha_pago'];
    $importe = $_POST['importe'];

    // Validacion de campos vacios
    if (empty($id_inscripcion) || empty($fecha_pago) || empty($importe)) {
        echo "<p>Todos los campos son obligatorios.</p>";
        echo "<a href='formulario_pago.php'>volver</a>";
        exit();
    }

    // Validacion de importe
    if (!is_numeric($importe) || $importe <= 0) {
        echo "<p>El importe debe ser un número positivo.</p>";
        echo "<a href='formulario_pago.php'>volver</a>";
        exit();
    }

    $sql = "INSERT INTO pago (id_inscripcion, fecha_pago, importe) VALUES ('$id_inscripcion', '$fecha_pago', '$importe')";
    if (mysqli_query($con, $sql)) {
        header("Location: listado_inscripciones.php");
        exit();
    } else {
        echo "<p>Error al registrar el pago: " . mysqli_error($con) . "</p>";
        echo "<a href='formulario_pago.php'>volver</a>";
    }
?>