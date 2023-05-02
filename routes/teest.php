<?php

class Session
{
    public static function set(string $name, mixed $value)
    {
        self::mbStart();
        $_SESSION[$name] = $value;
    }

    public static function get(string $name)
    {
        self::mbStart();
        return $_SESSION[$name] ?? null;
    }

    public static function slice(string $name): mixed
    {
        self::mbStart();
        $val = null;
        if (isset($_SESSION[$name])){
            $val = $_SESSION[$name];
            unset($_SESSION[$name]);
            return $val;
        }
        return $_SESSION[$name] ?? null;
    }

    protected static function mbStart()
    {
        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
print_r($_SESSION)
?>
