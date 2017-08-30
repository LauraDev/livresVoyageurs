<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;


// Implements Controller Provider Interface
class FriendControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {

        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];



        # Add a friend    
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/demande_contact/{pseudo}', 'LivresVoyageurs\Controller\FriendController::addFriendAction')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_addFriend');


        # Accept a friend    
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/ajout_contact/{pseudo}', 'LivresVoyageurs\Controller\FriendController::acceptFriendAction')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_acceptFriend');

        
        # Decline a friend    
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/decline_contact/{pseudo}', 'LivresVoyageurs\Controller\FriendController::declineFriendAction')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_declineFriend');


        # Block a friend    
        $controllers
        
            # Associate a route with a controller and an action
            ->match('/block_contact/{pseudo}', 'LivresVoyageurs\Controller\FriendController::blockFriendAction')
            ->method('GET|POST')
            # Route name
            ->bind('livresVoyageurs_blockFriend');



        // Return the controllers (ControllerCollection)
        return $controllers;
    }     

}

