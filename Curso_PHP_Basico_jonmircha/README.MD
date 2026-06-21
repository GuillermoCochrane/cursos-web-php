# Fundamentos de PHP Nativo y Gestión de Estado
> **Material de Referencia:** Curso PHP Básico - Jon Mircha (Ciclo 2012)  
> **Duración del Sprint:** 15 días  
> **Enfoque de Implementación:** Pragmático (KISS) con interfaz estilizada mediante **Pico.css (Classless)** para aislar la lógica del backend del HTML crudo.

Este módulo representa el "kilómetro cero" del desarrollo en PHP. El objetivo principal fue domar el comportamiento nativo del lenguaje, comprender el flujo de las peticiones HTTP (GET/POST), la manipulación de archivos en el disco del servidor y los mecanismos primitivos de persistencia de estado (Cookies y Sesiones) antes de saltar a arquitecturas modernas o middlewares automatizados.

---

## 🔗 Recursos Originales
* **Playlist Youtube:** [Curso PHP Básico](https://www.youtube.com/playlist?list=PL469D93BF3AE1F84F)

---

## 📂 Contenido Técnico Aprendido

### 1️⃣ Manipulación de Formularios y Validaciones Híbridas (Clases 2, 3 y 4)
* **Estrategia de Envío:** Implementación y captura de datos mediante métodos estándar `GET` (visibles en URL) y `POST` (encapsulados de forma segura en el cuerpo de la petición HTTP).
* **Flujo Híbrido de Validación:** Intercepción del evento de envío en el cliente utilizando JavaScript nativo (`document.querySelector` simplificado). Se controlan los campos vacíos mediante estructuras interactivas (`alert()`) y redirección de foco programática (`.focus()`) antes de ejecutar el `.submit()`.
* **Procesamiento en Backend (`validaciones.php`):** Captura de superglobales mediante la detección de banderas ocultas (`<input type="hidden">`). Si las credenciales estáticas fallan, se aplica un cortocircuito mediante cabeceras nativas (`header("Location: ...")`) inyectando query strings para la gestión de errores en la vista.

### 2️⃣ Control de Archivos y Depuración de Datos (Clase 5)
* **Auditoría de Superglobales (`upload.php`):** Inspección profunda del array asociativo bidimensional `$_FILES` mediante iteraciones `foreach` para mapear las propiedades críticas del archivo en su ciclo de vida temporal (`name`, `type`, `tmp_name`, `error`, `size`).
* **Validación de Tipo y Persistencia:** Restricción estricta del Content-Type del lado del servidor (permitiendo únicamente `text/plain`). Los archivos válidos son movidos desde el directorio temporal del sistema hacia su destino definitivo en el disco mediante `move_uploaded_file()`.

### 3️⃣ Persistencia de Estado Local mediante Cookies (Clase 6)
* **Concepto:** Mecanismo de almacenamiento de datos persistentes directamente en el cliente (navegador del usuario).
* **Arquitectura del Flujo (Simulación de i18n / Idiomas):**
  * `save_cookie.php`: Captura el parámetro de la URL, inicializa el registro con `setcookie()` y calcula el timestamp dinámico de expiración en segundos (`time() + 86400` para 24 horas).
  * `use_cookie.php`: Actúa como un middleware interceptor rústico que lee la superglobal `$_COOKIE` y redirige el flujo hacia la vista correspondiente (`spanish.php` / `english.php`).
  * `delete_cookie.php`: Fuerza la destrucción inmediata del registro en el navegador restándole tiempo al reloj del sistema (`time() - 86400`).

### 4️⃣ Autenticación Centralizada mediante Sesiones (Clase 7)
* **Concepto:** Persistencia de estado del lado del servidor, vinculada de forma unívoca al cliente mediante una cookie de identificación automatizada generada por el motor de PHP (`PHPSESSID`).
* **Estructura del Sistema de Autenticación:**
  * **Validador de Credenciales (`control.php`):** Verifica las credenciales contra un origen estático. Si son válidas, invoca `session_start()`, inicializa la sesión y puebla el mapa asociativo de `$_SESSION`.
  * **Middleware de Blindaje (`session.php`):** Script modular reutilizado en la primera línea de las vistas protegidas (`archivo_protegido.php`). Si detecta una sesión huérfana o inexistente, ejecuta una redirección forzada y detiene en seco la ejecución del hilo mediante `exit()`.
  * **Purgado de Memoria (`salir.php`):** Desconexión segura del usuario que recupera el ID de sesión activo y destruye el almacenamiento en el servidor mediante `session_destroy()`.

### 5️⃣ Interacción con Bases de Datos Relacionales (Clases 9 y 10)
* **Modelado de Datos (`mis_contactos.sql`):** Estructuración de una base de datos relacional compuesta por una tabla principal (`contactos`) y un catálogo indexado (`pais`). Se configuró bajo el motor clásico `MyISAM` y se optimizó el rendimiento de búsquedas masivas mediante una llave compuesta de texto completo (`FULLTEXT KEY buscador`).
* **API Procedimental Extinta (`operaciones-basicas-bd.php`):** Implementación de operaciones CRUD estándar utilizando las funciones nativas `mysql_*` (obsoletas desde PHP 5.5 y removidas por completo en PHP 7.0):
  * **Conexión y Selección:** Apertura del canal con `mysql_connect()` acoplada al control rústico de excepciones (`or die()`), y selección del esquema mediante `mysql_select_db()`.
  * **Ejecución y Parseo:** Envío de instrucciones SQL crudas a través de `mysql_query()`. Extracción y mapeo de los buffers del servidor en arrays asociativos dinámicos recorridos mediante bucles `while` con `mysql_fetch_array()`.

---

## 🧠 Reflexión Crítica: Anti-DRY vs Modularidad Moderna

El desarrollo de este sprint funciona como una excelente bitácora histórica y lógica de control. Al auditar estos archivos con la mentalidad de un desarrollador actual, saltan a la vista los vicios y limitaciones de la arquitectura web de principios de la década pasada:

1. **Violación Sistemática de DRY (Don't Repeat Yourself):** Se evidencia en la duplicidad de formularios espejados para procesar `GET` y `POST` de forma aislada, repitiendo bloques lógicos idénticos tanto en los scripts de JavaScript como en los manejadores de procesamiento en PHP.
2. **Acoplamiento Estricto:** La mezcla de procesamiento de datos, redirecciones de cabeceras HTTP y renderizado de interfaz en un mismo archivo genera código difícil de escalar y mantener.
3. **Vulnerabilidades de Seguridad Críticas (Inyección SQL):** El uso de la extensión antigua `mysql_*` fomenta la concatenación directa de variables del usuario dentro de strings SQL. Sin capas de sanitización o sentencias preparadas, el sistema queda expuesto a ataques de inyección (SQLi).
4. **Dependencia del Motor:** Las llamadas a funciones están atadas exclusivamente a MySQL. Cambiar el motor de persistencia (por ejemplo, a PostgreSQL o SQLite) obligaría a reescribir toda la lógica de acceso a datos del proyecto.

**Conclusión:** Domar el comportamiento procedural rústico y el manejo manual de las variables súper globales sin el uso de abstracciones o frameworks es un ejercicio indispensable. Permite entender qué ocurre realmente bajo el capó de los sistemas modernos y enseña a valorar la seguridad y la elegancia que aportan soluciones contemporáneas como el patrón MVC, el uso de sentencias preparadas en PDO o los ORM avanzados.