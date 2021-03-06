<?php

namespace InboxAgency\Session;

class PhpSession implements SessionInterface
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

    /**
     * @codeCoverageIgnore
     */
    public function destroy()
    {
        $_SESSION = [];
    }
}
