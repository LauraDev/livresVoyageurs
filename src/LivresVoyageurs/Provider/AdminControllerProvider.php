<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;



// Implements Controller Provider Interface
class AdminControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {
        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];


            # Admin Page
            $controllers

                # Associate a route with a controller and an action
                ->get('/{pseudoAdmin}', 'LivresVoyageurs\Controller\AdminController::administrateurAction')
                # Route name
                ->bind('livresVoyageurs_administrator');

        // Return the controllers (ControllerCollection)
        return $controllers;
    }



}
