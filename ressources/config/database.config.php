<?php

#1 : Doctrine DBAL Activation
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'livresVoyageurs',
        'user'     => 'root',
        'password' => 'root'
    ),
));

#2 : Idiorm Activation
$app->register(new Idiorm\Silex\Provider\IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string'   => 'mysql:host=localhost;dbname=livresVoyageurs',
        'username'     => 'root',
        'password' => 'root'
        // ,
        // 'id_column_overrides' => array(
        // 'view_articles' => 'IDARTICLE'
        // )
    ),
));


#3 : Allow render(controller()) in the view
$app->register(new Silex\Provider\HttpFragmentServiceProvider());