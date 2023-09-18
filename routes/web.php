<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('file-list', ['items' => [], 'path' => '']);
});

Route::match(['GET', 'POST'], '/list-files', function (Request $request) {
    $path = $request->input('path', '/'); // Utilisez le chemin saisi dans le formulaire ou '/' par défaut

    if (is_dir($path)) {
        $items = scandir($path);
        $items = array_diff($items, ['.', '..']); // Exclure les entrées spéciales "." et ".."
        $items = array_map(function ($item) use ($path) {
            $itemPath = $path . '/' . $item;
            return [
                'name' => $item,
                'path' => $itemPath,
                'type' => is_dir($itemPath) ? 'folder' : 'file',
            ];
        }, $items);
    } else {
        $items = [];
    }

    return view('file-list', ['items' => $items, 'path' => $path]);
})->name('listFiles');


Route::post('/list-files', function (Request $request) {
    $path = $request->input('path');

    if (is_dir($path)) {
        $items = scandir($path);
        $items = array_diff($items, ['.', '..']); // Exclure les entrées spéciales "." et ".."
        $items = array_map(function ($item) use ($path) {
            $itemPath = $path . '/' . $item;
            return [
                'name' => $item,
                'path' => $itemPath,
                'type' => is_dir($itemPath) ? 'folder' : 'file',
            ];
        }, $items);
    } else {
        $items = [];
    }

    return view('file-list', ['items' => $items, 'path' => $path]);
})->name('listFiles');

Route::get('/view-file', function (Request $request) {
    $path = $request->input('path');

    if (is_file($path)) {
        $content = file_get_contents($path);
        return view('view-file', ['content' => $content]);
    } else {
        return redirect()->route('listFiles', ['path' => dirname($path)]);
    }
})->name('viewFile');

Route::get('/view-folder', function (Request $request) {
    $path = $request->input('path');
    $items = [];

    if (is_dir($path)) {
        $items = scandir($path);
        $items = array_diff($items, ['.', '..']); // Exclure les entrées spéciales "." et ".."
        $items = array_map(function ($item) use ($path) {
            $itemPath = $path . '/' . $item;
            return [
                'name' => $item,
                'path' => $itemPath,
                'type' => is_dir($itemPath) ? 'folder' : 'file',
            ];
        }, $items);
    }

    return view('file-list', ['items' => $items, 'path' => $path]);
})->name('viewFolder');

