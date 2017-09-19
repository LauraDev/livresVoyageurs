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
                ->match('/{pseudoAdmin}', 'LivresVoyageurs\Controller\AdminController::administrateurAction')
                ->method('GET|POST')
                # Route name
                ->bind('livresVoyageurs_administrator');

            # Change a category
            $controllers
                ->match('/change/categorie_{id}', 'LivresVoyageurs\Controller\AdminController::changeCatAction')
                ->method('GET|POST')
                ->bind('livresVoyageurs_changeCat');

            # Delete a category
            $controllers
                ->get('/delete/{id_category}', 'LivresVoyageurs\Controller\AdminController::removeCatAction')
                ->bind('livresVoyageurs_deleteCat');

        // Return the controllers (ControllerCollection)
        return $controllers;
    }



}
