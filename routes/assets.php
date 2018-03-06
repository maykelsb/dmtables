<?php
// Source: https://github.com/a-h-abid/lumen-ng4-quickstart

$router->get('/node_modules/{jsfile:[@0-9a-zA-Z\-\_\.\/]+\.js$}', function ($jsfile) use ($router){

    die(var_dump($jsfile));


    $js_file_path = $router->app->basePath().'/node_modules/'.$jsfile;
    if (file_exists($js_file_path)) {
        $h = fopen($js_file_path, 'r');
        $contents = fread($h, filesize($js_file_path));
        fclose($h);
        return $contents;
    } else {
        abort(404);
    }
});

$router->get('angular/{jsfile:[@0-9a-zA-Z\-\_\.\/]+\.js$}', function ($jsfile) use ($router){

    die(var_dump($jsfile));


    $js_file_path = $router->app->basePath().'/resources/angular/src/'.$jsfile;
    if (file_exists($js_file_path)) {
        $h = fopen($js_file_path, 'r');
        $contents = fread($h, filesize($js_file_path));
        fclose($h);
        return $contents;
    } else {
        abort(404);
    }
});

