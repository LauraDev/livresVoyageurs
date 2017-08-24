<?php

#1 : Doctrine DBAL Activation
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'   => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'livresvoyageurs',
        'user'     => 'lola',
        'password' => 'lola'
    ),
));

#2 : Idiorm Activation
$app->register(new Idiorm\Silex\Provider\IdiormServiceProvider(), array(
    'idiorm.db.options'       => array(
        'connection_string'   => 'mysql:host=localhost;dbname=livresvoyageurs',
        'username'            => 'lola',
        'password'            => 'lola'
        ,
        'id_column_overrides' => array(
        'authors' => 'id_author',
        'books'   => 'id_book',
        'captures'=> 'id_pointer',
        'categories'=> 'id_category',
        'chats'    => 'id_chat',
        'members' => 'id_member',
        'pointers' => 'id_pointer'
        )
    ),
));


#3 : Allow render(controller()) in the view
$app->register(new Silex\Provider\HttpFragmentServiceProvider());
