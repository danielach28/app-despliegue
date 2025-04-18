README

# Analizador de Texto en PHP

Este proyecto es una pequeña aplicación web que permite analizar textos escritos por el usuario, eliminando puntuación y palabras vacías (*stopwords*), y mostrando una tabla con las palabras significativas ordenadas por frecuencia.

## Tecnologías utilizadas

- Frontend:** HTML + CSS (básico, sin frameworks).
- Backend:** PHP puro.
- Control de versiones:** Git.

## Funcionalidad

El usuario puede:

1. Introducir un texto en un formulario.
2. Al enviarlo, el texto es procesado:
   - Se convierte a minúsculas.
   - Se eliminan signos de puntuación y caracteres especiales.
   - Se eliminan las *stopwords*.
   - Se cuentan las palabras significativas.
3. Se muestra una tabla con cada palabra y su frecuencia, ordenada de mayor a menor.

## ¿Qué son las stopwords?

Son palabras comunes que no aportan significado en un análisis, como "el", "la", "y", "de", etc. Este proyecto utiliza un archivo `stopwords.txt` que contiene una lista de palabras a ignorar.

## 📂 Estructura del proyecto

├── index.php # Página principal con lógica PHP + formulario HTML 
├── stopwords.txt # Lista de palabras vacías (una por línea) 
└── README.md # Este archivo


## Cómo ejecutar el proyecto en local

### Requisitos

- Tener PHP instalado en tu sistema.
- Tener acceso a un navegador.

### Instrucciones

1. Clona o descarga el repositorio.
2. Asegúrate de tener el archivo `stopwords.txt` en la misma carpeta que `index.php`.
3. Abre una terminal y navega a la carpeta del proyecto.
4. Ejecuta un servidor local con PHP:

```bash
php -S localhost:8000

Abre tu navegador y visita:http://localhost:8000
Escribe o pega un texto en el área proporcionada y pulsa "Analizar".

Trabajo en equipo
Este proyecto está planteado para realizarse por parejas utilizando Git como sistema de control de versiones.

## Buenas prácticas seguidas:
Estructura de ramas basada en main, develop y ramas funcionales.

Commits atómicos con mensajes claros.

Pull antes de cada push.

Evitamos subir directamente a la rama main.

## Notas técnicas
No se utilizan funciones automáticas de PHP para el conteo y filtrado de palabras (como str_word_count, array_filter, etc.). La lógica de limpieza y conteo de palabras está implementada manualmente.

El proyecto es compatible con UTF-8, lo que permite trabajar correctamente con caracteres especiales como tildes (á, é, í, ó, ú), la ñ y caracteres como la ü.

Se usa htmlspecialchars para evitar vulnerabilidades de tipo XSS (Cross-Site Scripting) y proteger la salida HTML.

El archivo stopwords.txt debe estar en la misma carpeta que el archivo PHP para que se cargue correctamente.