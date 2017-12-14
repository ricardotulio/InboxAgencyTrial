<?php

namespace InboxAgency\User\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Authorizator
{
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        $next
    ) {
        $session = $request->getAttribute('session');

        if ($session->get('user') == null
            && $request->getUri()->getPath() != '/login/') {
            return $response->withRedirect(
                '/login/',
                301
            );
        }

        return $next($request, $response);
    }
}
