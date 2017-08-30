<?php

// Define routes
$app->mount('/', new LivresVoyageurs\Provider\UserControllerProvider() );
$app->mount('/livres', new LivresVoyageurs\Provider\OverviewControllerProvider() );
$app->mount('/espace', new LivresVoyageurs\Provider\MemberControllerProvider() );
$app->mount('/contacts', new LivresVoyageurs\Provider\FriendControllerProvider() );
$app->mount('/private', new LivresVoyageurs\Provider\AdminControllerProvider() );

