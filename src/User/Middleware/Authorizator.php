<?php

namespace InboxAgency\User\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\User\Service\Authorizator as AuthorizatorService;

class Authorizator
{
    private $service;

    public function __construct(AuthorizatorService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        Request $request,
        Response $response,
        $next
    ) {
        if (!$this->service->hasAuthorized($request)) {
            return $response->withRedirect(
                '/login/',
                301
            );
        }

        return $next($request, $response);
    }
}
