<?php

require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../config/container.php';

$service = $container->get('service_purchase');
$service->runMailWorker();
