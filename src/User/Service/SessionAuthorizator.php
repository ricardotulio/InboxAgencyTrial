<?php

namespace InboxAgency\User\Service;

use Psr\Http\Message\ServerRequestInterface as Request;

class SessionAuthorizator implements Authorizator
{
    public function hasAuthorized(Request $request)
    {
        return $this->isLoginPage($request) || $_SESSION['logged'] === true;
    }

    public function isLoginPage(Request $request)
    {
        return str_replace(getenv('BASE_URL'), '', $request->getUri())
            === '/login/';
    }
}
