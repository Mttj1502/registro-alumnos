<?php
// TODO el PHP que debe correr antes de cualquier salida va aquí:
session_start();

if (!isset($_SESSION['colaborador'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    require_once __DIR__ . '/../src/Controllers/AlumnoController.php';

    $datos = [
        'nombre' => $_POST['nombre'] ?? '',
        'matricula' => $_POST['matricula'] ?? '',
        'grupo' => $_POST['grupo'] ?? '',
        'correo' => $_POST['correo'] ?? '',
        'clave_carrera' => $_POST['clave_carrera'] ?? ''
    ];

    $controller = new AlumnoController();

    try {
        $controller->registrarDesdeFormulario($datos);
        header('Location: registro.php?mensaje=Alumno+registrado+correctamente');
        exit;
    } catch (Exception $e) {
        header('Location: registro.php?error=' . urlencode($e->getMessage()));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registrar Alumno</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<p>Bienvenido, <?php echo htmlspecialchars($_SESSION['colaborador']); ?> | 
<a href="logout.php">Cerrar sesión</a></p>
<hr>

<h1>Registrar Alumno</h1>

<?php
if (isset($_GET['mensaje'])) {
    echo '<p style="color:green;">' . htmlspecialchars($_GET['mensaje']) . '</p>';
}
if (isset($_GET['error'])) {
    echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
}
?>

<form action="registro.php" method="POST">
  <!-- formulario igual que antes -->
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

