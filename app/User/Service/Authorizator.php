<?php

namespace InboxAgency\User\Service;

use Psr\Http\Message\ServerRequestInterface as Request;

interface Authorizator
{
    public function hasAuthorized(Request $request);
}
