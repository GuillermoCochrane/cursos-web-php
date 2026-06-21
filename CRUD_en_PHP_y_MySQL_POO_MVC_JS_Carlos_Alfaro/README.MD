# Sistema de Gestión de Usuarios (CRUD) — PHP, MySQL, MVC y AJAX

Este módulo contiene la implementación completa de un Sistema de Gestión de Usuarios empresarial basado en el curso de Carlos Alfaro. El proyecto original fue **reestructurado por completo** para adaptarlo a estándares modernos de desarrollo (estilo Express/React), optimizando la separación de responsabilidades y la organización de assets estáticos.

## 🔗 Recursos Originales
* **Playlist Youtube:** [Ver en YouTube: Como HACER un CRUD con PHP - MySQL - POO - PDO - MVC - AJAX desde CERO](https://www.youtube.com/playlist?list=PLH_tVOsiVGzl-l_yDiedZyOKZSUayupki)
* **Repositorio de Referencia:** [Carlos007007/CRUD](https://github.com/Carlos007007/CRUD)

---

## 📐 Reestructuración y Arquitectura del Proyecto

A diferencia del repositorio original del curso, este proyecto fue reestructurado aplicando patrones modernos de diseño de software:

* **Estandarización de Directorio Raíz (`public/`):** Se extrajeron todos los recursos estáticos (`css`, `js`, `img`, `fotos`) de la capa de vistas y se aislaron en una carpeta pública en la raíz. Esto previene la mezcla de código de servidor con assets de cliente, emulando la estructura de proyectos en **Express** o **Laravel**.
* **Pensamiento de Componentes (React Style):** Se renombraron las carpetas de la interfaz de `inc/` y `content/` a `components/` y `templates/`, segmentando el layout visual en módulos reutilizables y limpios.
* **Encapsulamiento de Persistencia:** La carpeta de la base de datos (`DB/`) se movió al núcleo de datos interno (`app/models/DB/`), agrupando todo lo relacionado con la persistencia en su capa correspondiente.
* **Enrutamiento Asíncrono (Endpoints):** La carpeta `app/ajax/` funciona conceptualmente como el sistema de *routing* de una API, interceptando las peticiones asíncronas de JavaScript (`fetch`), procesando los payloads (`FormData`) y comunicándose con los controladores sin recargar la página.

```text
. (Raíz del Proyecto)
├── .htaccess                 # Reescritura de URLs y Front Controller
├── index.php                 # Despachador central de peticiones
├── autoload.php              # Cargador automático de clases dinámico
├── config/                   # Configuración global del entorno (app, server)
├── public/                   # Estáticos y Assets del Cliente (Aislado de las vistas)
│   ├── css/                  # Bulma CSS & SweetAlert2
│   ├── js/                   # Captura de formularios (ajax.js) y scripts globales
│   └── img/                  # Logotipos y almacenamiento de fotos de perfil
└── app/                      # Núcleo de la Aplicación (Backend)
    ├── ajax/                 # Endpoints receptores de peticiones Fetch (Equivalente a Routers)
    ├── controllers/          # Lógica de Control (Login, Usuarios, Búsquedas)
    ├── models/               # Capa de Datos (Abstracción PDO, Consultas Preparadas)
    │   └── DB/               # Script SQL de la Base de Datos (db.sql)
    └── views/                # Capa de Presentación Modularizada
        ├── components/       # Fragmentos de UI (Navbar, Head, Scripts, Botones)
        └── templates/        # Vistas de páginas completas (Dashboard, Formularios, Listados)

```

---

## 🛠️ Stack Tecnológico Utilizado

* **PHP 8 (POO):** Programación Orientada a Objetos, herencia de modelos, encapsulamiento y métodos estáticos.
* **PDO (PHP Data Objects):** Conexión segura a MySQL utilizando consultas preparadas (`prepare()`) y vinculación de parámetros (*parameter binding*) para mitigar ataques de Inyección SQL (SQLi).
* **JavaScript (Vanilla) & AJAX:** Intercepción del evento `submit` nativo y envío asíncrono mediante la API `fetch` y objetos `FormData`.
* **Bulma CSS:** Framework CSS basado en Flexbox para el diseño de la interfaz responsiva y limpia.
* **SweetAlert2:** Renderizado de modales interactivos y alertas estéticas para las respuestas del servidor.

---

## 🧭 Índice de Desarrollo (Mapeo de la Playlist - 56 Videos)

El desarrollo del sistema se compone de los siguientes bloques lógicos y conceptuales:

1. **Enrutamiento y Autolading (Videos 1-6):** Configuración de URLs amigables mediante `.htaccess` y automatización de la carga de dependencias en memoria con `spl_autoload_register`.
2. **Modelo Base y Seguridad (Videos 7-13):** Conexión centralizada PDO en `mainModel.php`. Helpers de saneamiento de entradas frente a ataques XSS, encriptación segura mediante `password_hash()` y validación estricta con expresiones regulares.
3. **Motor de Plantillas Dinámico (Videos 14-19):** Creación del `viewsController` para validar una lista blanca de accesos y renderizar componentes fragmentados.
4. **Autenticación y Sesiones (Videos 20-25):** Control de acceso protegido por roles de sesión en PHP, persistencia del estado del usuario y validación de credenciales con `password_verify()`.
5. **Núcleo CRUD de Usuarios (Videos 26-41):** Implementación de la lógica del modelo de negocio (Inserción, Selección, Modificación y Eliminación) integrada con paginación dinámica optimizada mediante desplazamientos (`LIMIT` y `OFFSET`).
6. **Interoperabilidad AJAX (Videos 42-50):** Conexión de los formularios del frontend con los scripts de `app/ajax/`, devolviendo payloads JSON procesados para disparar alertas dinámicas en el cliente.
7. **Buscador Completo e Imágenes (Videos 51-56):** Persistencia de términos de búsqueda en variables de sesión usando comodines SQL (`LIKE`), junto con lógica de validación, subida y almacenamiento seguro de imágenes de perfil.

---

## 🚀 Instrucciones de Instalación Local

### 1. Clonado y Despliegue

Copiá la carpeta `CRUD` dentro del directorio raíz de tu servidor local (ej. `htdocs` en XAMPP/Laragon) o remoto.

### 2. Configuración de Base de Datos

1. Asegurate de tener activo tu servidor MySQL.
2. Importá el script `db.sql` ubicado en la ruta `app/models/DB/db.sql` a tu gestor de bases de datos (phpMyAdmin, DBeaver, etc.).

### 3. Variables de Entorno

Configurá los siguientes archivos dentro de la carpeta `config/` con los parámetros correspondientes a tu entorno local:

* **`app.php`:** Define la `APP_URL` base del proyecto (ej: `http://localhost/CRUD/`) y el nombre del sistema.
* **`server.php`:** Define las credenciales de conexión (`SG_DB`, `SG_USER`, `SG_PASS`, etc.).

### 4. Credenciales por Defecto

Para el acceso inicial al sistema de administración:

* **Usuario:** `Administrador`
* **Contraseña:** `Administrador`
