<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;


// Implements Controller Provider Interface
class MemberControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {

        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];


        # Personal space
        $controllers
        
            # Associate a route with a controller and an action
            ->get('/{pseudo}', 'LivresVoyageurs\Controller\MemberController::espacePersoAction')
            # Specify the type of parameters / using Regex
            ->assert('pseudo' , '[^/]+')
            # Route name
            ->bind('livresVoyageurs_espace');
            
        
        # Chat
        $controllers
        
            # Associate a route with a controller and an action
            ->get('/chat/{receiver}', 'LivresVoyageurs\Controller\MemberController::chatAction')
            # Specify the type of parameters / using Regex
            ->assert('receiver' , '[^/]+')
            # Route name
            ->bind('livresVoyageurs_chat');




        // Return the controllers (ControllerCollection)
        return $controllers;
    }

}