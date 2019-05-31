<?php
return [
/**
 * Connection information used by the ORM to connect
 * to your application's datastores.
 */
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'dungbuidev',
            'password' => '',
            'database' => 'cms_cake',
            'prefix' => false,
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'unix_socket'   => '/Applications/MAMP/tmp/mysql/mysql.sock'
        ],

        /**
         * The test connection is used during the test suite.
         */
        'test' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => getenv('MYSQL_HOST') ? getenv('MYSQL_HOST') : 'localhost',
            //'port' => 'nonstandard_port_number',
            'username' => getenv('MYSQL_USER') ? getenv('MYSQL_USER') : 'root',
            'password' => getenv('MYSQL_PASSWORD') ? getenv('MYSQL_PASSWORD') : '',
            'database' => getenv('MYSQL_DATABASE') ? getenv('MYSQL_DATABASE') : 'test',
            'encoding' => 'utf8',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
            'log' => false,
            //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],
        ]
    ]
];
