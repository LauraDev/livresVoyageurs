<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;


// Implements Controller Provider Interface
class ChatControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {

        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];
        
        # Chat
        $controllers
        
            # Associate a route with a controller and an action
            ->get('/{receiver}', 'LivresVoyageurs\Controller\ChatController::chatAction')
            # Specify the type of parameters / using Regex
            ->assert('receiver' , '[^/]+')
            # Route name
            ->bind('livresVoyageurs_chat');


        // Return the controllers (ControllerCollection)
        return $controllers;
    }

}