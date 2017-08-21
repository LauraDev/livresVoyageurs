<?php

// Define routes
$app->mount('/', new LivresVoyageurs\Provider\UserControllerProvider() );
$app->mount('/espace', new LivresVoyageurs\Provider\MemberControllerProvider() );
$app->mount('/private', new LivresVoyageurs\Provider\AdminControllerProvider() );

