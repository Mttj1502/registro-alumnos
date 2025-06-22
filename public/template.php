<?php
session_start();
if (!isset($_SESSION['colaborador'])) {
    header("Location: login.php");
    exit;
}
?>

<p>Bienvenido, <?php echo htmlspecialchars($_SESSION['colaborador']); ?> | 
<a href="logout.php">Cerrar sesión</a></p>
<hr>
