<!DOCTYPE html>
<html>
<head>
    <title>Afficher le contenu du fichier</title>
</head>
<body>
    <h1>Contenu du fichier</h1>

    @if (isset($content))
        <pre>{{ $content }}</pre>
    @else
        <p>Le fichier n'a pas pu être trouvé.</p>
    @endif
    <a href="javascript:history.back()">Retour à la liste des fichiers</a>

</body>
</html>
