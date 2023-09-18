<!DOCTYPE html>
<html>
<head>
    <title>Liste des fichiers</title>
</head>
<body>
    <h1>Liste des fichiers</h1>

    @if (isset($items))
        <ul>
            @foreach ($items as $item)
                <li>
                    @if ($item['type'] === 'folder')
                        <a href="{{ route('viewFolder', ['path' => $item['path']]) }}">{{ $item['name'] }}</a>
                    @else
                        <a href="{{ route('viewFile', ['path' => $item['path']]) }}">{{ $item['name'] }}</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('listFiles') }}">
    @csrf
    <label for="path">Chemin du répertoire :</label>
    <input type="text" id="path" name="path" value="{{ $path }}" required>
    <button type="submit">Afficher la liste</button>
</form><br>
<a href="javascript:history.back()">Retour à la liste des fichiers</a>
</body>
</html>
