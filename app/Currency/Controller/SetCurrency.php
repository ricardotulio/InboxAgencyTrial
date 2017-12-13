<?php

namespace InboxAgency\Currency\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Currency\Service\CurrencyServiceInterface as CurrencyService;

/**
 * @codeCoverageIgnore
 */
class SetCurrency
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function __invoke(
        Request $request,
        Response $response
    ) {
        $data = $request->getParsedBody();

        $this->currencyService->set($data['currency']);

        return $response->withRedirect(
            getenv('BASE_URL') . '/',
            301
        );
    }
}
