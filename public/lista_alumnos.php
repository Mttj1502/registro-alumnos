<?php
require_once __DIR__ . '/../src/controllers/alumnoController.php';

$controller = new AlumnoController();
$alumnos = $controller->mostrarLista();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
</head>
<body>
    <h1>Alumnos Registrados</h1>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Matrícula</th>
                <th>Grupo</th>
                <th>Correo</th>
                <th>Carrera</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                <td><?= htmlspecialchars($alumno['matricula']) ?></td>
                <td><?= htmlspecialchars($alumno['grupo']) ?></td>
                <td><?= htmlspecialchars($alumno['correo']) ?></td>
                <td><?= htmlspecialchars($alumno['nombre_carrera']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="./index.php">Volver al inicio</a>
</body>
</html>
