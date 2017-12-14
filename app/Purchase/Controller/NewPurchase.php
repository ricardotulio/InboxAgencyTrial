<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use InboxAgency\Cart\Service\CartServiceInterface;
use InboxAgency\Purchase\Service\PurchaseServiceInterface;
use InboxAgency\User\Entity\User;
use InboxAgency\Purchase\Entity\Purchase;

/**
 * @codeCoverageIgnore
 */
class NewPurchase
{
    private $cartService;

    private $purchaseService;

    private $view;

    public function __construct(
        CartServiceInterface $cartService,
        PurchaseServiceInterface $purchaseService
    ) {
        $this->cartService = $cartService;
        $this->purchaseService = $purchaseService;
        $this->view = $view;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        $cart = $this->cartService->getCart();

        if (!$cart->hasItems()) {
            return $response->withRedirect(
                getenv('BASE_URL') . '/',
                301
            );
        }

        $user = new User();
        $user->setEmail('ledo.tulio@gmail.com');

        $purchase = new Purchase(
            $user,
            $cart
        );

        $this->purchaseService->finishPurchase($purchase);

        $this->cartService->cleanCart();

        return $response->withRedirect(
            getenv('BASE_URL') . '/purchase/success/',
            301
        );
    }
}
