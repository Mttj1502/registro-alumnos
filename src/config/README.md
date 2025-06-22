# Carpeta `src/config/`

Configuración de conexión a la base de datos.

## Archivos:

- `Database.php`: Clase que genera la conexión PDO a MySQL.

#  Configuración e Importación de la Base de Datos

Este proyecto utiliza MySQL para almacenar la información de alumnos, carreras y usuarios colaboradores. A continuación se explican los pasos para importar y configurar correctamente la base de datos en un entorno local (XAMPP, WAMP, Laragon, etc.).



##  Archivos SQL incluidos

Este directorio contiene los siguientes scripts SQL:

| Archivo                               | Descripción                                       |
|--------------------------------------|---------------------------------------------------|
| `registro_alumnos_alumnos.sql`       | Crea e inserta registros en la tabla `alumnos`    |
| `registro_alumnos_carreras.sql`      | Crea e inserta datos en la tabla `carreras`       |
| `registro_alumnos_usuarios_colaboradores.sql` | Crea e inserta registros en la tabla `usuarios_colaboradores` |

---

##  Estructura de la base de datos

Nombre de la base de datos: `registro_alumnos`

### Tablas:

- **`usuarios_colaboradores`**
  - Autenticación de usuarios con correo y contraseña.
  
- **`carreras`**
  - Lista de carreras con `clave_carrera` y `nombre_carrera`.

- **`alumnos`**
  - Alumnos registrados, con relación a una carrera mediante `clave_carrera`.

---

##  Cómo importar la base de datos

### Opción 1: phpMyAdmin

1. Abre `http://localhost/phpmyadmin`
2. Crea una nueva base de datos llamada: `registro_alumnos`
3. Importa los archivos `.sql` en este orden:
   - `registro_alumnos_carreras.sql`
   - `registro_alumnos_usuarios_colaboradores.sql`
   - `registro_alumnos_alumnos.sql`

>  **Importante:** Asegúrate de que el nombre de la base de datos sea exactamente `registro_alumnos` para evitar problemas de conexión.

---

### Opción 2: MySQL Workbench

1. Abre MySQL Workbench y conecta a tu servidor local.
2. Ejecuta los archivos `.sql` uno por uno.
3. Verifica que las tablas se hayan creado correctamente en `registro_alumnos`.

---

##  Usuario de prueba

En la tabla `usuarios_colaboradores`, ya se incluye un usuario por defecto para login:

```txt
Correo: cortega@utfv.edu.mx
Contraseña: admin1234
