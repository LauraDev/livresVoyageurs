<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;


// Implements Controller Provider Interface
class UserControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {
        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];


            # Home Page
            $controllers

                # Associate a route with a controller and an action
                ->get('/', 'LivresVoyageurs\Controller\UserController::indexAction')
                # Route name
                ->bind('livresVoyageurs_home');


            # Inscription Page
            $controllers

                # Associate a route with a controller and an action
                ->get('/inscription', 'LivresVoyageurs\Controller\UserController::inscriptionAction')
                # Route name
                ->bind('livresVoyageurs_inscription');


            # Connexion Page
            $controllers

                # Associate a route with a controller and an action
                ->get('/connexion', 'LivresVoyageurs\Controller\UserController::connexionAction')
                # Route name
                ->bind('livresVoyageurs_connexion');


            # Disconnect
            $controllers

                ->get('/deconnexion', 'LivresVoyageurs\Controller\UserController::deconnexionAction')
                ->bind('livresVoyageurs_deconnexion');

            #Contact
            $controllers

                ->get('/contact', 'LivresVoyageurs\Controller\UserController::contactAction')
                ->bind('livresVoyageurs_contact');

            #Mentions
            $controllers

                ->get('/mentions', 'LivresVoyageurs\Controller\UserController::mentionsAction')
                ->bind('livresVoyageurs_mentions');



        // Return the controllers (ControllerCollection)
        return $controllers;
    }

}
