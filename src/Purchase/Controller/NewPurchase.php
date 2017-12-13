<?php

namespace InboxAgency\Purchase\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use InboxAgency\Cart\Service\Cart as CartService;
use InboxAgency\Purchase\Service\Purchase as PurchaseService;
use InboxAgency\User\Entity\User;
use InboxAgency\Purchase\Entity\Purchase;

class NewPurchase
{
    private $cartService;

    private $purchaseService;

    private $view;

    public function __construct(
        CartService $cartService,
        PurchaseService $purchaseService
    ) {
        $this->cartService = $cartService;
        $this->purchaseService = $purchaseService;
        $this->view = $view;
    }

    public function __invoke(
        Request $request,
        Response $response
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

        $cart->cleanCart();
        $this->cartService->persistCart($cart);

        return $response->withRedirect(
            getenv('BASE_URL') . '/purchase/success/',
            301
        );
    }
}
