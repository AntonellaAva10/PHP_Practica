<?php
    include 'conexion.php';
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    // validacion || campos vacios
    if (empty($nombre) || empty($apellido) || empty($dni) || empty($fecha_nacimiento) || empty($telefono) || empty($email)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }
    // validacion || dni 8 digitos && dni duplicado
    if (!preg_match('/^\d{8}$/', $dni)) {
        echo "El DNI debe tener 8 dígitos.";
        exit();
    }

    $sql_check_dni = "SELECT * FROM jugadores WHERE dni = '$dni'";
    $result_check_dni = mysqli_query($con, $sql_check_dni);

    if (mysqli_num_rows($result_check_dni) > 0) {
        echo "El DNI ya está registrado.";
        exit();
    }

    // validacion || telefono 9 digitos
    if (!preg_match('/^\d{9}$/', $telefono)) {
        echo "El teléfono debe tener 9 dígitos.";
        exit();
    }

    // validacion || email formato correcto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no tiene un formato válido.";
        exit();
    }

    // validacion || fecha de nacimiento && fechas futuras 
    $fecha_actual = date("Y-m-d");
    if ($fecha_nacimiento > $fecha_actual) {
        echo "La fecha de nacimiento no puede ser futura.";
        exit();
    }

    $sql = "INSERT INTO jugadores (nombre, apellido, dni, fecha_nacimiento, telefono, email) VALUES ('$nombre', '$apellido', '$dni', '$fecha_nacimiento', '$telefono', '$email')";
    if (mysqli_query($con, $sql)) {
        header("Location: listado_jugadores.php");
        exit();
    } else {
        echo "Error al registrar el jugador: " . mysqli_error($con);
    }

?>
