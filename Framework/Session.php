<?php

namespace Framework;

class Session
{
    //start a session

    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    //set session key-value

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    //get session by key

    public static function get($key, $default = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $default;
    }

    //check if key

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    //clear by key

    public static function clear($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    //clear session data

    public static function clearAll()
    {
        session_unset();
        session_destroy();
    }

    //set flash message

    public static function setFlashMessage($key, $message)
    {
        self::set('flash_' . $key, $message);
    }

   //get flash message

    public static function getFlashMessage($key, $default = null)
    {
        $message = self::get('flash_' . $key, $default);
        self::clear('flash_' . $key);
        return $message;
    }
}
