<?php
$custom_config = array(
    'base_url' => 'http://localhost/web/',
    'timezone' => 'Asia/Ho_Chi_Minh',
    'language' => 'vi',
);

//database
$database_config = array(
    'dsn' => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'web',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

//resolve config
$custom_config['base_url'] = rtrim($custom_config['base_url'], '/') . '/';