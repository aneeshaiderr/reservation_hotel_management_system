<?php 
namespace App\Middleware;
class Session{
    public static function has($key){
        return static::get($key);
    }
    public static function put($key, $value){
        $_SESSION[$key] = $value;

    }
    public static function get($key, $default =null){
        return $_SESSION[$key] ?? $default;
    }

       public static function unflash(){
        unset($_SESSION['_flash']);
    }

    
    public static function flush($key = null, $value = null){
        
        $_SESSION =[];
    }

    public static function destroy(){
           static::flush();
session_destroy();
$params =session_get_cookie_params();
setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    }
}


