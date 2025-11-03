
<?php
function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit();
}

function urlIs($value)
{
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    return $uri === $value;
}
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}
function url($path = '')
{
    $base = '/practice/public';

    return $base.$path;
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("app/view/{$code}.php");
    exit();
}

function base_path($path)
{
    return BASE_PATH.$path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    require base_path('app/view/'.$path);
}

function redirect($path)
{
    header("Location: {$path}");
    exit();
}
