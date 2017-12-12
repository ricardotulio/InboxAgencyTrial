<?php

return array(
    "paths" => array(
        "migrations" => "db/migrations",
        "seeds" => "db/seeds"
    ),
    "environments" => array(
        "default_migration_table" => "phinxlog",
        "default_database" => "dev",
        "dev" => array(
            "adapter" => "mysql",
            "host" => $_ENV['DB_HOST'],
            "name" => $_ENV['DB_NAME'],
            "user" => $_ENV['DB_USER'],
            "pass" => $_ENV['DB_PASS'],
            "port" => $_ENV['DB_PORT']
        )
    )
);
