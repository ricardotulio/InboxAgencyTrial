<?php

namespace InboxAgency\Session;

interface SessionInterface
{
    const SESSION_ATTRIBUTE = 'session';

    public function get($key);

    public function set($key, $value);

    public function destroy();
}
