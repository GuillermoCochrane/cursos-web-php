# Curso de PHP desde Cero — midudev

Este módulo contiene los apuntes, ejercicios prácticos y el proyecto final basados en el curso introductorio de PHP 8 de **midudev**. El contenido refleja el progreso desde la sintaxis básica hasta la modularización avanzada y la Programación Orientada a Objetos (POO).

## 🔗 Recursos Originales
* **Clase 1:** [Aprende PHP 8 desde cero: Curso para principiantes + Aplicación con Deploy](https://www.youtube.com/watch?v=BcGAPkjt_IE)
* **Clase 2:** [CURSO de PHP: Aprende Funciones, Clases, Imports y más](https://www.youtube.com/watch?v=V2Q1eRUlnlM)

---

## 📂 Estructura del Módulo

* **`clase 1/`**: Fundamentos del lenguaje y primer contacto con el entorno.
  * Uso de etiquetas de apertura, `echo` y renderizado de variables.
  * Tipos de datos, *type-casting* y tipado gradual (`var_dump`, `gettype`).
  * Estructuras de control y condicionales (`if`, sintaxis alternativa, ternarias y `match`).
  * Iteración de datos con arrays y diccionarios usando `foreach`.
  * Primera llamada a una API y estructuración básica con HTML, CSS y el framework Pico CSS.

* **`clase 2/`**: Modularización, manejo de estado y refactorización a objetos.
  * `functions.php` y `constants.php`: Creación de funciones con tipado estricto y ámbito de variables (scope).
  * `sections/` y `templates/`: Sistema de plantillas implementado mediante `require` e `include` para separar la lógica de la presentación (`head.php`, `main.php`, `styles.php`).
  * `classes/NextMovie.php`: Clase encargada de encapsular la lógica del consumo de la API mediante POO, aplicando propiedades, constructores (con *Properties Promotion*), visibilidad (`readonly`, `private`) y métodos estáticos.

---

## 🛠️ Conceptos Clave Aprendidos

* **Integración HTML/PHP:** Mezcla limpia de código backend y frontend, utilizando sintaxis alternativa para mantener la legibilidad.
* **Consumo de APIs:** Uso de funciones nativas (`curl` y `file_get_contents`) para realizar peticiones HTTP y decodificar respuestas JSON.
* **Modularización de Archivos:** Diferencias estratégicas y casos de uso entre `require`, `require_once` e `include` para estructurar proyectos sin frameworks.
* **Programación Orientada a Objetos:** Transición de funciones sueltas a un diseño basado en clases, controlando el acceso a los datos y tipando estrictamente los parámetros de entrada y salida.

---

## 🚀 Proyecto: NextMovie App
Desarrollado y refactorizado a lo largo de las dos clases. Consiste en una aplicación web que consume una API pública para calcular y mostrar cuál es la próxima película del universo Marvel a estrenarse. Se implementó un diseño responsivo utilizando Pico CSS y toda la lógica de obtención de datos fue encapsulada en la clase `NextMovie`.