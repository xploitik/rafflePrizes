<?php

$config = require_once(__DIR__ . '/../app/config/params.php');
$dbConfig = $config['db'];

return [
    "paths" => [
        "migrations" => "db/migrations",
        "seeds" => "db/seeds"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "current",
        "current" => [
            "adapter" => 'mysql',
            "host" => $dbConfig['host'],
            "name" => $dbConfig['dbname'],
            "user" => $dbConfig['username'],
            "pass" => $dbConfig['password'],
            "port" => $dbConfig['port'],
            "charset" => "utf8"
        ]
    ]
];