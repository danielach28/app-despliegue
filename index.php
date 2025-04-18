<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador de Texto</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
