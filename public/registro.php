
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrar Alumno</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'template.php'; ?>
<h1>Registrar Alumno</h1>

<?php
// Mostrar mensaje de éxito o error si se redirige después del registro
if (isset($_GET['mensaje'])) {
    echo '<p style="color:green;">' . htmlspecialchars($_GET['mensaje']) . '</p>';
}
if (isset($_GET['error'])) {
    echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
}
?>

<form action="registro.php" method="POST">
  <label for="nombre">Nombre:</label><br />
  <input type="text" id="nombre" name="nombre" required /><br />

  <label for="matricula">Matrícula:</label><br />
  <input type="text" id="matricula" name="matricula" required /><br />

  <label for="grupo">Grupo:</label><br />
  <input type="text" id="grupo" name="grupo" required /><br />

  <label for="correo">Correo:</label><br />
  <input type="email" id="correo" name="correo" required /><br />

  <label for="clave_carrera">Carrera:</label><br />
  <select id="clave_carrera" name="clave_carrera" required>
    <option value="">Selecciona una carrera</option>
    <option value="DGS">Ingeniería en Desarrollo y Gestión de Software</option>
    <option value="IND">Ingeniería Industrial</option>
    <option value="LOG">Ingeniería en Logística</option>
  </select><br /><br />

  <button type="submit" name="registrar">Registrar</button>
  <a href="/public/lista_alumnos.php">Ver lista de alumnos</a>
</form>

</body>
</html>

<?php
// 👇 Lógica de registro al final del mismo archivo PHP

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    require_once __DIR__ . '/../src/Controllers/AlumnoController.php';

    // Convertimos el arreglo POST al formato que espera el controlador
    $datos = [
        'nombre' => $_POST['nombre'] ?? '',
        'matricula' => $_POST['matricula'] ?? '',
        'grupo' => $_POST['grupo'] ?? '',
        'correo' => $_POST['correo'] ?? '',
        'clave_carrera' => $_POST['clave_carrera'] ?? ''
    ];

    // Creamos el controlador
    $controller = new AlumnoController();

    // Adaptamos la lógica del método registrar para que no use JSON
    try {
        $controller->registrarDesdeFormulario($datos);
        // Redirigir con mensaje de éxito
        header('Location: registro.php?mensaje=Alumno+registrado+correctamente');
        exit;
    } catch (Exception $e) {
        // Redirigir con error
        header('Location: registro.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}
