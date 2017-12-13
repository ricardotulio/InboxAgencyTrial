<?php

namespace InboxAgency\Session;

class PHPSession implements Session
{
    private $data;

    public function __construct(&$data = $_SESSION)
    {
        $this->data = $data;
    }

    public function get($key)
    {
    }

    public function set($key, $value)
    {
    }
}
