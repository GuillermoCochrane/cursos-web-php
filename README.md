# 🎯 Roadmap PHP: De lo Procedimental al MVC Moderno

Este repositorio documenta un sprint intensivo de 15 días destinado a dominar el ecosistema PHP. Lejos de ser un simple acopio de tutoriales, funciona como un laboratorio evolutivo que contrasta las prácticas rústicas de la vieja escuela con la ingeniería de software moderna, la POO estricta y el patrón Modelo-Vista-Controlador.

---

## 🧩 Los Tres Pilares del Repositorio

El proyecto se divide metodológicamente en tres módulos que marcan la maduración de la arquitectura de código:

### 1. Sintaxis Moderna y POO [(Basado en Midudev)](./midudev/README.MD)
* **Objetivo:** Dominar PHP 8 desde cero, implementando tipado estricto y Programación Orientada a Objetos.
* **Proyecto:** Aplicación *NextMovie*, modularizada y diseñada para consumir APIs externas separando la lógica de la UI.
* **Conceptos clave:** *Property Promotion*, métodos estáticos, interpolación de strings, manejo de arrays asociativos y encapsulamiento con modificadores `readonly`.

### 2. Fundamentos y Estado Nativo [(Basado en Jon Mircha)](./Curso_PHP_Basico_jonmircha/README.MD)
* **Objetivo:** Comprender las bases de las peticiones HTTP y el estado antes de la llegada de los frameworks.
* **Proyecto:** Manejo de estado circular (Cookies/Sesiones), subida de archivos y un CRUD monolítico ("Mis Contactos").
* **Conceptos clave:** Intercepción de formularios con JavaScript, middlewares nativos de autenticación y el análisis de la extinta API procedimental `mysql_*` para entender los riesgos de acoplamiento y vulnerabilidad a inyección SQL.

### 3. Sistema Empresarial MVC [(Basado en Carlos Alfaro)](./CRUD_en_PHP_y_MySQL_POO_MVC_JS_Carlos_Alfaro/README.MD)
* **Objetivo:** Construir una arquitectura robusta, asíncrona y segura aislando las responsabilidades (SRP).
* **Proyecto:** CRUD completo de Gestión de Usuarios, reestructurado con una jerarquía de directorios moderna (estilo Express/React).
* **Conceptos clave:** Conexión PDO con sentencias preparadas, enrutamiento asíncrono con endpoints receptores (AJAX/Fetch) e interfaces limpias mediante Bulma y SweetAlert2.

---

## 📁 Estructura del Repositorio

La organización refleja el estado final de la refactorización arquitectónica aplicada sobre el proyecto principal, aislando recursos públicos y encapsulando la lógica de negocio:

```text
===== ESTRUCTURA COMPLETA DEL REPOSITORIO ===== 

.\cursos-web-php:
|   .gitignore
|   estructura_repositorio.txt
|   lista_anidada.bat
|   README.md
|   
+---CRUD_en_PHP_y_MySQL_POO_MVC_JS_Carlos_Alfaro
|   |   README.MD
|   |   
|   \---CRUD
|       |   .htaccess
|       |   autoload.php
|       |   index.php
|       |   
|       +---app
|       |   +---ajax
|       |   |       buscadorAjax.php
|       |   |       usuarioAjax.php
|       |   |       
|       |   +---controllers
|       |   |       loginController.php
|       |   |       searchController.php
|       |   |       userController.php
|       |   |       viewsController.php
|       |   |       
|       |   +---models
|       |   |   |   mainModel.php
|       |   |   |   viewsModel.php
|       |   |   |   
|       |   |   \---DB
|       |   |           db.sql
|       |   |           
|       |   \---views
|       |       +---components
|       |       |       btn_back.php
|       |       |       error_alert.php
|       |       |       head.php
|       |       |       navbar.php
|       |       |       script.php
|       |       |       session_start.php
|       |       |       
|       |       \---templates
|       |               404-view.php
|       |               dashboard-view.php
|       |               home.php
|       |               login-view.php
|       |               logOut-view.php
|       |               userList-view.php
|       |               userNew-view.php
|       |               userPhoto-view.php
|       |               userSearch-view.php
|       |               userUpdate-view.php
|       |               
|       +---config
|       |       app.php
|       |       server.php
|       |       
|       \---public
|           +---css
|           |       bulma.min.css
|           |       styles.css
|           |       sweetalert2.min.css
|           |       
|           +---img
|           |   |   bulma.png
|           |   |   
|           |   \---fotos
|           |           default.png
|           |           
|           \---js
|                   ajax.js
|                   script.js
|                   sweetalert2.all.min.js
|                   
+---Curso_PHP _B�sico_jonmircha
|   |   README.MD
|   |   
|   +---clase_10_Operaciones_b�sicas_con_MySQL
|   |       operaciones-basicas-bd.php
|   |       
|   +---clase_2_ Conceptos_Fundamentales
|   |       index.php
|   |       info.php
|   |       
|   +---clase_3_Env�o_de_datos_por_GET_y_POST
|   |       index.php
|   |       procesa_formularios.php
|   |       
|   +---clase_4_Validaciones
|   |       index.php
|   |       validaciones.php
|   |       
|   +---clase_5_Subir_archivos
|   |   |   index.php
|   |   |   upload.php
|   |   |   
|   |   \---uploaded
|   |           USER_PROFILE.txt
|   |           
|   +---clase_6_Cookies
|   |       delete_cookie.php
|   |       english.php
|   |       index.php
|   |       save_cookie.php
|   |       spanish.php
|   |       use_cookie.php
|   |       
|   +---clase_7_Session
|   |   |   archivo_protegido.php
|   |   |   archivo_protegido2.php
|   |   |   control.php
|   |   |   index.php
|   |   |   salir.php
|   |   |   session.php
|   |   |   
|   |   \---templates
|   |           footer.php
|   |           header.php
|   |           
|   \---clase_9_BDs_SQL,MySQL_y_phpMyAdmin
|           diagrama_entdad_relacion_DB.png
|           mis_contactos.sql
|           
+---midudev
|   |   README.MD
|   |   
|   +---clase 1
|   |       example.php
|   |       index.php
|   |       
|   \---clase 2
|       |   classes.php
|       |   class_index.php
|       |   constants.php
|       |   functions.php
|       |   index.php
|       |   
|       +---classes
|       |       NextMovie.php
|       |       
|       +---sections
|       |       head.php
|       |       main.php
|       |       styles.php
|       |       
|       \---templates
|               head.php
|               main.php
|               main_adapted.php
|               styles.php

```

---

## 🧠 Filosofía de Desarrollo

El hilo conductor de este repositorio es la aplicación de la "Navaja de Ockham": construir la solución más simple y efectiva posible.

Al atravesar la evolución histórica de PHP (desde la mezcla de lógica y HTML de 2012 hasta la abstracción PDO de 2024), se consolida la importancia crítica de aplicar los principios **DRY (Don't Repeat Yourself)** y **KISS (Keep It Simple, Stupid)**. Solo entendiendo la redundancia del código heredado se puede estructurar un backend verdaderamente limpio, seguro y escalable.