<?php

namespace InboxAgency\Currency\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Currency\Service\CurrencyServiceInterface;

/**
 * @codeCoverageIgnore
 */
class SetCurrency
{
    private $currencyService;

    public function __construct(CurrencyServiceInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $data = $request->getParsedBody();

        $this->currencyService->set($data['currency']);

        return $response->withRedirect(
            getenv('BASE_URL') . '/',
            301
        );
    }
}
