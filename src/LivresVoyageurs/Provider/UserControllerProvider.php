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
                ->match('/inscription', 'LivresVoyageurs\Controller\UserController::inscriptionAction')
                ->method('GET|POST')
                # Route name
                ->bind('livresVoyageurs_inscription');


            # Connexion Page
            $controllers

                # Associate a route with a controller and an action
                ->match('/connexion', 'LivresVoyageurs\Controller\UserController::connexionAction')
                ->method('GET|POST')
                # Route name
                ->bind('livresVoyageurs_connexion');


            # Disconnect
            $controllers

                ->get('/deconnexion', 'LivresVoyageurs\Controller\UserController::deconnexionAction')
                ->bind('livresVoyageurs_deconnexion');

            # Reset Password
            $controllers

                ->match('/mdpPerdu', 'LivresVoyageurs\Controller\UserController::resetPasswordAction')
                ->method('GET|POST')
                ->bind('livresVoyageurs_resetPassword');

            # Reset Password
            $controllers

                ->match('/mdpReset/{token}', 'LivresVoyageurs\Controller\UserController::resetPassword2Action')
                ->method('GET|POST')
                ->bind('livresVoyageurs_newPass');


            #Mentions
            $controllers

                ->get('/mentions', 'LivresVoyageurs\Controller\UserController::mentionsAction')
                ->bind('livresVoyageurs_mentions');


        // Return the controllers (ControllerCollection)
        return $controllers;
    }

}
