<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador de Texto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php

function cargarStopwords()
    {
        // Cargar stopwords desde archivo local
        $archivo = 'stopwords.txt'; // Ruta del archivo
        $stopwords = [];

        if (file_exists($archivo)) {
            // Leemos y convertimos a UTF-8 por compatibilidad
            $contenido = mb_convert_encoding(file_get_contents($archivo), 'UTF-8', 'auto');
            $lineas = explode("\n", $contenido); // Separamos por líneas
            foreach ($lineas as $linea) {
                $palabra = trim(mb_strtolower($linea, 'UTF-8')); // Limpiamos espacios y pasamos a minúscula
                if ($palabra !== '') {
                    $stopwords[$palabra] = true; // Guardamos como clave para búsqueda rápida
                }
            }
        }
        return $stopwords;
    }

?>
<h1>Analizador de Texto</h1>
    <form method="post">
        <textarea name="texto" placeholder="Introduce tu texto aquí..."><?php echo htmlspecialchars($texto); ?></textarea><br><br><!--Para evitar que el usuario meta código HTML o JavaScript y se ejecute en el navegador -->
        <button type="submit">Analizar</button>
        <button type="button" onclick="document.querySelector('textarea').value = '';">Borrar</button>
    </form>
    <table>
        <tr>
            <th>Palabra</th>
            <th>Frecuencia</th>
        </tr>
    </table>

</body>

</html>
