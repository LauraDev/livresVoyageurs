<?php

// Define routes
$app->mount('/', new LivresVoyageurs\Provider\UserControllerProvider() );
$app->mount('/chat', new LivresVoyageurs\Provider\ChatControllerProvider() );
$app->mount('/private', new LivresVoyageurs\Provider\AdminControllerProvider() );

