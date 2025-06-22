<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Alumnos</title>
</head>

<body>

    <h1>Registro de Alumnos</h1>

    <form action="procesar_registro.php" method="POST">
        <label for="nombre">Nombre completo:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="matricula">Matrícula:</label><br>
        <input type="text" id="matricula" name="matricula" required><br><br>

        <label for="grupo">Grupo:</label><br>
        <input type="text" id="grupo" name="grupo" required><br><br>

        <label for="correo">Correo institucional:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="clave_carrera">Clave de la carrera:</label><br>
        <input type="text" id="clave_carrera" name="clave_carrera" required><br><br>

        <input type="submit" value="Registrar Alumno">
    </form>

    <br>
    <a href="./lista_alumnos.php">Ver lista de alumnos</a>

</body>

</html>