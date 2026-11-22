<?php 
    include "conexion.php";

    $id_jugador = $_POST['id_jugador'];
    $id_torneo = $_POST['id_torneo'];
    $fecha_inscripcion = $_POST['fecha_inscripcion'];

    // Validacion de campos vacios
    if (empty($id_jugador) || empty($id_torneo) || empty($fecha_inscripcion)) {
        echo "<p>Todos los campos son obligatorios.</p>"
        echo "<a href='formulario_inscripcion.php'>volver</a>"
        exit();
    }

    // Trae los datos del torneo
    $sql_torneo = "SELECT nombre, categoria, fecha_inicio, max_participantes, cantidad_inscriptos FROM torneo WHERE id_torneo = $id_torneo";
    $res_torneo = mysqli_query($con, $sql_torneo);
    $torneo = mysqli_fetch_assoc($res_torneo);

    // Validación 1: verificar que el torneo no haya comenzado
    if ($fecha_inscripcion >= $torneo['fecha_inicio']) {
        echo "<p>No se puede inscribir, el torneo ya ha comenzado</p>"
        echo "<a href='formulario_inscripcion.php'>volver</a>"
        exit();
    }

    // Validación 2: verificar que el torneo no haya alcanzado el maximo de participantes
    if ($torneo['cantidad_inscriptos'] >= $torneo['max_participantes']) {
        echo "<p>El torneo ha alcanzado la cantidad máxima de participantes.</p>"
        echo "<a href='formulario_inscripcion.php'>volver</a>"
        exit();
    }

    // Validacion 3: verificar que el jugador no este inscripto previamente en el mismo torneo
    $sql_dni = "SELECT j.dni FROM jugador j WHERE j.id_jugador = $id_jugador";
    $res_dni = mysqli_query($con, $sql_dni);
    $jugador = mysqli_fetch_assoc($res_dni);
    $dni_jugador = $jugador['dni']

    $sql_dup = "SELECT i.id_inscripcion FROM inscripcion i, jugador j WHERE i.id_jugador = j.id_jugador AND j.dni = '$dni_jugador' AND i.id_torneo = $id_torneo";
    $res_dup = mysqli_query($con, $sql_dup);

    if (mysqli_num_rows($res_dup) > 0) {
        echo "<p>El jugador ya está inscripto en este torneo.</p>"
        echo "<a href='formulario_inscripcion.php'>volver</a>"
        exit();
    }

    // Validacion 4: verificar que la categoria del torneo corresponda con la edad del jugador
    $sql_jug = "SELECT fecha_nacimiento FROM jugador WHERE id_jugador = '$id_jugador'";
    $res_jug = mysqli_query($con, $sql_jug);
    $jug = mysqli_fetch_assoc($res_jug);

    $fecha_nac = new DataTime($jug['fecha_nacimiento']);
    $hoy = new DataTime();
    $edad = $hoy->diff($fecha_nac)->y:

    $categoria_torneo = $torneo['categoria'];
    $categoria_valida = false;

    if($categoria_torneo == 'Infantil' && $edad <= 12) { $categoria_valida = true; }
    elseif ($categoria_torneo == 'Juvenil' && $edad >= 13 $$ $edad <= 17) { $categoria_valida = true; }
    elseif ($categoria_torneo == 'Adultos' && $edad >= 18) { $categoria_valida = true; }

    if(!$categoria_valida) {
        echo "<p>La edad del jugador no corresponde a la categoría del torneo ($categoria_torneo).</p>"
        echo "<a href='formulario_inscripcion.php'>volver</a>"
        exit();
    }

    // Insertamos la inscripción
    $sql_insert = "INSERT INTO inscripcion (fecha_inscripcion, id_jugador, id_torneo) VALUES ('$fecha_inscripcion', '$id_jugador', '$id_torneo'"

    // Actualizamos la cantidad de inscriptos del torneo
    $sql_update = "UPDATE torneo SET cantidad_inscriptos = cantidad_inscriptos + 1 WHERE id_torneo = $id_torneo";

    if (mysqli_query($con, $sql_insert) && mysqli_query($con, $sql_update)) {
        header("location: listado_inscripciones.php");
        exit();
    } else {
        echo "Error al registrar la inscripción: " . mysqli_error($con);
    }

    mysqli_close($con);

    ?>