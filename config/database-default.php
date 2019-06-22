<?php
  return [
    /**
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * ### Notes
     * - Drivers include Mysql Postgres Sqlite Sqlserver
     *   See vendor\cakephp\cakephp\src\Database\Driver for complete list
     * - Do not use periods in database name - it may lead to error.
     *   See https://github.com/cakephp/cakephp/issues/6471 for details.
     * - 'encoding' is recommended to be set to full UTF-8 4-Byte support.
     *   E.g set it to 'utf8mb4' in MariaDB and MySQL and 'utf8' for any
     *   other RDBMS.
     */
    'Datasources' => [
      'default' => [
          'className' => 'Cake\Database\Connection',
          'driver' => 'Cake\Database\Driver\Mysql',
          'persistent' => false,
          'host' => '',
          'username' => '',
          'password' => '',
          'database' => 'cake_sandbox',
          'unix_socket'   => '/Applications/MAMP/tmp/mysql/mysql.sock',
          /*
           * You do not need to set this flag to use full utf-8 encoding (internal default since CakePHP 3.6).
           */
          //'encoding' => 'utf8mb4',
          'timezone' => 'UTC',
          'flags' => [],
          'cacheMetadata' => true,
          'log' => false,

          /**
           * Set identifier quoting to true if you are using reserved words or
           * special characters in your table or column names. Enabling this
           * setting will result in queries built using the Query Builder having
           * identifiers quoted when creating SQL. It should be noted that this
           * decreases performance because each query needs to be traversed and
           * manipulated before being executed.
           */
          'quoteIdentifiers' => false,

          /**
           * During development, if using MySQL < 5.6, uncommenting the
           * following line could boost the speed at which schema metadata is
           * fetched from the database. It can also be set directly with the
           * mysql configuration directive 'innodb_stats_on_metadata = 0'
           * which is the recommended value in production environments
           */
          //'init' => ['SET GLOBAL innodb_stats_on_metadata = 0'],

          'url' => env('DATABASE_URL', null),
      ],
    ]
  ]
?>
