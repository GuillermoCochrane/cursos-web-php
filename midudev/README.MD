# Curso de PHP 8 desde Cero — Midudev

Este módulo contiene los apuntes, ejercicios prácticos y el proyecto final basados en el curso introductorio de PHP 8 de **midudev**. El contenido refleja el progreso incremental desde un script plano con sintaxis básica hasta la modularización avanzada y la Programación Orientada a Objetos (POO).

## 🔗 Recursos Originales
* **Clase 1:** [Aprende PHP 8 desde cero: Curso para principiantes + Aplicación con Deploy](https://www.youtube.com/watch?v=BcGAPkjt_IE)
* **Clase 2:** [CURSO de PHP: Aprende Funciones, Clases, Imports y más](https://www.youtube.com/watch?v=V2Q1eRUlnlM)
* **Repositorio de Referencia:** [midudev/curso-php](https://github.com/midudev/curso-php)

---

## 📂 Estructura del Módulo

El código está estructurado de manera incremental dentro de la carpeta `midudev/`, reflejando la evolución del proyecto:

```text
midudev/
├── clase 1/
│   ├── example.php          # Pruebas iniciales de sintaxis, variables y tipado gradual.
│   └── index.php            # Script monolítico original: Consumo de la API con cURL y Pico CSS.
└── clase 2/
    ├── constants.php        # Definición de constantes globales de la aplicación.
    ├── functions.php        # Funciones globales con Type Hinting y el sistema render_template.
    ├── classes.php          # Pruebas e implementación base de Clases y Objetos.
    ├── class_index.php      # Archivo de prueba para testing exclusivo de POO.
    ├── index.php            # Punto de entrada principal (Orquestador con Tipado Estricto).
    │
    ├── classes/
    │   └── NextMovie.php    # Clase constructora del Objeto de la API (Property Promotion & Readonly).
    ├── sections/
    │   ├── head.php         # Metadatos del documento HTML.
    │   ├── main.php         # Estructura e interpolación visual del componente principal.
    │   └── styles.php       # Hoja de estilos embebida basada en Pico.css.
    └── templates/
        ├── head.php         # Variación de componentes/plantillas para renderizado dinámico.
        ├── main.php
        ├── main_adapted.php # Adaptación personalizada de la UI de la película.
        └── styles.php

```

---

## 🛠️ Conceptos Clave e Índice de Contenido

### 🔹 Clase 1: Sintaxis y Fundamentos Básicos

* **Tipado Gradual:** Pruebas con `var_dump()` y `gettype()` para entender cómo PHP infiere tipos dinámicamente pero permite conversiones implícitas (ej. `$cadena + $numero`).
* **Interpolación de Strings:** Uso de comillas dobles para interpolación directa frente a comillas simples (texto literal) y el operador de concatenación (`.`).
* **Estructuras Alternativas:** Implementación de condicionales utilizando la sintaxis de dos puntos (`endif;`), ideal para mezclar lógica backend con bloques HTML.
* **Estructura Match (PHP 8):** Reemplazo del clásico `switch` por expresiones `match`, logrando evaluaciones condicionales más limpias, estrictas y asignables a variables.
* **Arrays Asociativos:** Estructuración de datos en formato clave-valor para manejar la información parseada del JSON.

### 🔹 Clase 2: Modularización, Tipado Estricto y POO

* **Tipado Estricto (`[00:12:53]`):** Activación de `declare(strict_types=1);` para forzar al motor de PHP a validar exactamente los tipos en funciones y métodos, evitando el tipado débil.
* **Ámbito de Variables (`[00:16:06]`):** Aislamiento del scope dentro de las funciones y paso de dependencias mediante parámetros.
* **Control de Inclusiones (`[00:26:18]` / `[00:29:24]`):** Uso estratégico de `require` (obligatorio) y `require_once` para modularizar la aplicación sin duplicar funciones o clases en memoria.
* **Property Promotion en PHP 8 (`[01:02:58]`):** Optimización en `NextMovie.php` para declarar y asignar propiedades directamente desde los parámetros del constructor `__construct`.
* **Encapsulamiento e Inmutabilidad (`[01:04:55]`):** Uso de modificadores `private` y la palabra clave moderna `readonly` para proteger las propiedades del objeto una vez instanciadas.
* **Métodos Estáticos (`[01:13:20]`):** Implementación de `public static function` para resolver la lógica de petición de la API e instanciar el objeto directamente (`NextMovie::fetch_and_create_movie()`) sin usar `new` de forma redundante en el flujo principal.

---

## 🚀 Proyecto: NextMovie App

Desarrollado y refactorizado a lo largo de las dos clases. Consiste en una aplicación web que consume una API pública para calcular y mostrar cuántos días faltan para el estreno de la próxima película de Marvel.

* **Evolución del Consumo:** En la `clase 1` se implementó mediante peticiones síncronas con **cURL** (`curl_init`). En la `clase 2` (`[00:05:25]`), se contrastó con el método rápido de `file_get_contents()` antes de encapsular toda la lógica de la petición HTTP dentro de la clase estática `NextMovie`.
* **Diseño e Interfaz:** Renderizado dinámico de datos (póster, título, días restantes) utilizando la estructura semántica del framework CSS minimalista **Pico.css**.
* **Arquitectura de Plantillas:** La visualización fue fragmentada de manera limpia. El archivo `functions.php` utiliza una función genérica `render_template()` que recibe variables en un array asociativo y utiliza `extract()` para desempaquetarlas localmente dentro de las vistas en `sections/` o `templates/`.

---

## 💻 Cómo Ejecutar el Entorno Local

1. Navegá mediante tu terminal hasta la carpeta de la clase que quieras probar:
```bash
cd midudev/clase 2

```


2. Levantá el servidor de desarrollo rápido integrado en PHP (`[00:04:48]`):
```bash
php -S localhost:8000

```


3. Abrí en tu navegador: `http://localhost:8000`