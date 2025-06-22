<?php
require_once __DIR__ . '/../src/Controllers/AuthController.php';
$auth = new AuthController();
$auth->cerrarSesion();
