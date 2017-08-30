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
            ->match('/{pseudo}', 'LivresVoyageurs\Controller\MemberController::espacePersoAction')
            ->method('GET|POST')
            # Specify the type of parameters / using Regex
            ->assert('pseudo' , '[^/]+')
            # Route name
            ->bind('livresVoyageurs_espace');
            
        # Personal space - Change a book disponibility
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/{pseudo}/dispo', 'LivresVoyageurs\Controller\MemberController::espacePersoPost')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_espace_post');


        # Personal space - Get new book sticker
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/{pseudo}/sticker={uniqueId}/title={title}', 'LivresVoyageurs\Controller\MemberController::stickerAction')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_espace_sticker');
        
        # Chat
        $controllers
        
                    # Associate a route with a controller and an action
                    ->get('/histoire/livre={id_book}', 'LivresVoyageurs\Controller\MemberController::historyAction')
                    # Specify the type of parameters / using Regex
                    ->assert('receiver' , '[^/]+')
                    # Route name
                    ->bind('livresVoyageurs_history');

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
