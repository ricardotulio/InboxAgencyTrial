<?php

namespace InboxAgency\Session;

interface Session
{
    public function get($key);

    public function set($key, $value);
}
