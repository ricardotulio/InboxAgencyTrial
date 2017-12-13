<?php

namespace InboxAgency\Currency\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Currency\Service\Currency as CurrencyService;

/**
 * @codeCoverageIgnore
 */
class SetCurrency
{
    private $service;

    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $this->service->set($data['currency']);

        return $response->withRedirect(
            getenv('BASE_URL') . '/',
            301
        );
    }
}
