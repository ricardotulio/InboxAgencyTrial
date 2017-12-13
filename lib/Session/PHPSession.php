<?php

namespace InboxAgency\Session;

class PHPSession implements Session
{
    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return unserialize($_SESSION[$key]);
        }

        return false;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = serialize($value);
    }

    public function destroy()
    {
        $_SESSION = [];
    }
}
