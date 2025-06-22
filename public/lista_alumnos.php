<?php
require_once __DIR__ . '/../src/controllers/alumnoController.php';

$controller = new AlumnoController();

// Filtros y paginación
$filtros = [
    'clave_carrera' => $_GET['carrera'] ?? '',
    'grupo' => $_GET['grupo'] ?? '',
    'cuatrimestre' => $_GET['cuatrimestre'] ?? ''
];
$pagina = isset($_GET['pagina']) ? max((int)$_GET['pagina'], 1) : 1;

$resultado = $controller->mostrarListaFiltrada($filtros, $pagina);
$carreras = $controller->obtenerCarreras();
$grupos = $controller->obtenerGrupos();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
</head>

<body>

    <h1>Alumnos Registrados</h1>

    <form method="GET">
        <label for="carrera">Carrera:</label>
        <select name="carrera" id="carrera">
            <option value="">Todas</option>
            <?php foreach ($carreras as $c): ?>
                <option value="<?= $c['clave_carrera'] ?>" <?= $filtros['clave_carrera'] === $c['clave_carrera'] ? 'selected' : '' ?>>
                    <?= $c['nombre_carrera'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="grupo">Grupo:</label>
        <select name="grupo" id="grupo">
            <option value="">Todos</option>
            <?php foreach ($grupos as $g): ?>
                <option value="<?= $g ?>" <?= $filtros['grupo'] == $g ? 'selected' : '' ?>>
                    <?= $g ?>
                </option>
            <?php endforeach; ?>
        </select>



        <label for="cuatrimestre">Cuatrimestre:</label>
        <select name="cuatrimestre" id="cuatrimestre">
            <option value="">Todos</option>
            <?php for ($i = 1; $i <= 11; $i++): ?>
                <option value="<?= $i ?>" <?= $filtros['cuatrimestre'] == $i ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit">Filtrar</button>
    </form>

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
            <?php if (count($resultado['alumnos']) > 0): ?>
                <?php foreach ($resultado['alumnos'] as $alumno): ?>
                    <tr>
                        <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                        <td><?= htmlspecialchars($alumno['matricula']) ?></td>
                        <td><?= htmlspecialchars($alumno['grupo']) ?></td>
                        <td><?= htmlspecialchars($alumno['correo']) ?></td>
                        <td><?= htmlspecialchars($alumno['nombre_carrera']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No se encontraron resultados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div>
        <?php for ($i = 1; $i <= $resultado['total_paginas']; $i++): ?>
            <a href="?<?= http_build_query(array_merge($_GET, ['pagina' => $i])) ?>">
                <?= $i === $resultado['pagina_actual'] ? "<strong>$i</strong>" : $i ?>
            </a>
        <?php endfor; ?>
    </div>

    <br>
    <a href="./index.php">Registrar nuevo alumno</a>

</body>

</html>