# Carpeta `/public` - Registro de Alumnos

Esta carpeta contiene los archivos accesibles directamente por el navegador (públicos) y sirve como la interfaz visual del sistema.

## Archivos y su función

### `index.php`
- **Propósito:** Redirecciona por defecto a `registro.php`.
- **Tipo:** Router API en modo JSON.
- **Notas:**
  - Solo ejecuta acciones definidas en el `switch` según la URL.
  - No debe usarse como interfaz de usuario HTML.

---

### `login.php`
- **Propósito:** Muestra un formulario para que un colaborador inicie sesión.
- **Tipo:** Página HTML tradicional.
- **Lógica incluida:**
  - Muestra un formulario para ingresar correo y contraseña.
  - Procesa el formulario mediante `POST`.
  - Llama al `AuthController` para verificar credenciales.
  - Si las credenciales son válidas, inicia sesión y redirige al sistema.
  - Si no, muestra un mensaje de error.

---

### `logout.php`
- **Propósito:** Finaliza la sesión del colaborador.
- **Acción:** Llama a `AuthController` para destruir la sesión y redirigir a `login.php`.

---

### `registro.php`
- **Propósito:** Muestra un formulario HTML para registrar nuevos alumnos.
- **Acceso:** Solo colaboradores autenticados pueden verlo.
- **Validación:**
  - Incluye `template.php` para verificar que haya una sesión activa.
  - Si no hay sesión, redirige automáticamente a `login.php`.

---

### `lista_alumnos.php`
- **Propósito:** Muestra una lista de alumnos registrados (interfaz).
- **Acceso:** Restringido a usuarios con sesión activa.
- **Funcionalidad:** Puede incluir filtros o mostrar todos los registros.

---

### `template.php`
- **Propósito:** Fragmento de código PHP que:
  - Verifica si existe una sesión activa.
  - Muestra el nombre del colaborador autenticado.
  - Proporciona un enlace para cerrar sesión.
- **Uso:** Debe incluirse al inicio de todas las páginas que requieren autenticación:
  ```php
  <?php include 'template.php'; ?>
