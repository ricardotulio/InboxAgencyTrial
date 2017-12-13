<?php

namespace InboxAgency\Session;

interface Session
{
    const SESSION_ATTRIBUTE = 'session';

    public function get($key);

    public function set($key, $value);

    public function destroy();
}
