<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador de Texto</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php
// Inicializamos las variables para evitar errores al cargar por primera vez
$texto = '';
$resultado = [];


// Si el formulario se envió y el campo 'texto' existe
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['texto'])) {
    $texto = $_POST['texto']; // Captura el texto enviado
    $stopwords = cargarStopwords();           // Carga las palabras vacías (stopwords)
    $resultado = procesarTexto($texto, $stopwords); // Procesa el texto y cuenta las palabras útiles
}

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

    //Función que limpia el texto y lo convierte en un array de palabras útiles.
    function procesarTexto($texto, $stopwords)
    {
        $texto = mb_strtolower($texto, 'UTF-8'); // Convertimos todo a minúsculas

        $texto = preg_replace('/[^a-záéíóúñü0-9\s]/iu', ' ', $texto); // Quitamos puntuación

        $palabras_raw = explode(' ', $texto); // Separamos por espacios

        $palabras_limpias = []; //Array para almacenar las palabras válidas y su frecuencia.

        //Bucle para filtrar y contar palabras
        foreach ($palabras_raw as $palabra) {
            $palabra = trim($palabra);
            if ($palabra !== '' && !isset($stopwords[$palabra])) { // Si no está vacía y no es una stopword, la contamos
                //Si la palabra no está aún en $palabras_limpias, la añade con un valor de 1
                if (!isset($palabras_limpias[$palabra])) {
                    $palabras_limpias[$palabra] = 1;
                } else {
                    //Si ya existe, incrementa su frecuencia.
                    $palabras_limpias[$palabra]++;
                }
            }
        }


        arsort($palabras_limpias);  // Ordenar por frecuencia (de mayor a menor)

        return $palabras_limpias;
    }

?>

<h1>Analizador de Texto</h1>
    <form method="post">
        <textarea class="form-control" name="texto" placeholder="Introduce tu texto aquí..."><?php echo htmlspecialchars($texto); ?></textarea><br><br><!--Para evitar que el usuario meta código HTML o JavaScript y se ejecute en el navegador -->
        <button type="submit">Analizar</button>
        <button type="button" onclick="document.querySelector('textarea').value = '';">Borrar</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") : ?>
        <h2>Frecuencia de Palabras</h2>
        <?php if (!empty($resultado)) : ?>
            <table>
                <tr>
                    <th>Palabra</th>
                    <th>Frecuencia</th>
                </tr>
                <?php foreach ($resultado as $palabra => $frecuencia) : ?>
                    <tr>
                        <td><?= htmlspecialchars($palabra) ?></td>
                        <td><?= $frecuencia ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>No se han encontrado palabras significativas.</p>
        <?php endif; ?>
    <?php endif; ?>

    </body>

</html>
