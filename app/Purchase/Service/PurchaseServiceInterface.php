<?php

namespace InboxAgency\Purchase\Service;

use InboxAgency\Purchase\Entity\PurchaseInterface as Purchase;

interface PurchaseServiceInterface
{
    public function finishPurchase(Purchase $purchase);
}
