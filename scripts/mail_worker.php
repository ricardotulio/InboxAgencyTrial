<?php

require_once __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../config/container.php';

while(true) {
    try {
        $service = $container->get('service_purchase');
        $service->runMailWorker();
    } catch(\Exception $e) {
        echo "Trying to connect with rabbitmq \n";
    }

    sleep(2);
}
