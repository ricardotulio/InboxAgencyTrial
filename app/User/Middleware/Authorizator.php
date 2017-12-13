<?php

namespace InboxAgency\User\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Service\Authorizator as AuthorizatorService;

class Authorizator
{
    public function __invoke(
        Request $request,
        Response $response,
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
