<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Torneo</title>
</head>
<body>
    <h1>Registro de Torneo</h1>
    <form action="procesar_torneo.php" method="POST">
        <label for="nombre">Nombre del Torneo: </label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>
        <label for="deporte">Deporte</label> <br>
        <select name="deporte" id="deporte" required>
            <option value="">Seleccione un deporte</option>
            <option value="Futbol">Futbol</option>
            <option value="Basquet">Basquet</option>
            <option value="Tenis">Tenis</option>
            <option value="Voley">Voley</option>
        </select>
        <br><br>
        <label for="fecha_inicio">Fecha de Inicio: </label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        <br><br>
        <label for="fecha_fin">Fecha de Fin: </label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        <br><br>
        <label for="categoria">Categoría: </label>
        <select name="categoria" id="categoria" required>
            <option value="">Seleccione una categoría</option>
            <option value="Infantil">Infantil</option>
            <option value="Juvenil">Juvenil</option>
            <option value="Adulto">Adulto</option>
        </select>
        <div class="aviso">
            <strong>Informacion sobre las categorias:</strong>
            <ul>
                <li>Infantil: hasta 12 años</li>
                <li>Juvenil: de 13 a 17 años</li>
                <li>Adulto: 18 años en adelante</li>
            </ul>
        </div>
        <br><br>
        <label for="importe">Importe: </label>
        <input type="number" id="importe" name="importe" step="0.01" required>
        <br><br>
        <label for="max_participantes">Cantidad Máxima de Participantes: </label>
        <input type="number" id="max_participantes" name="max_participantes" required>
        <br><br>
        <input type="submit" value="Registrar Torneo">
    </form>
</body>
</html>