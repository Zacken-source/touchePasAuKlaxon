<?php

namespace App\Core;

/**
 * Gestion des sessions PHP.
 */
class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function destroy()
    {
        session_destroy();
    }

    /** Stocke un message à afficher une seule fois */
    public static function setFlash($message)
    {
        $_SESSION['_flash'] = $message;
    }

    public static function getFlash()
    {
        $flash = $_SESSION['_flash'] ?? null;
        unset($_SESSION['_flash']);
        return $flash;
    }
}