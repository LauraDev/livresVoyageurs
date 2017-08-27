<?php

namespace LivresVoyageurs\Provider;

use Silex\Api\ControllerProviderInterface;



// Implements Controller Provider Interface
class OverviewControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {
        # Silex\ControllerCollection instance
        $controllers = $app['controllers_factory'];


            # OverviewPage
            $controllers
            
                # Associate a route with a controller and an action
                ->get('/liste_des_livres_disponibles', 'LivresVoyageurs\Controller\OverviewController::bookListAction')
                # Route name
                ->bind('livresVoyageurs_bookList');


            $controllers

                # Associate a route with a controller and an action
                ->match('/enregistrer_une_capture', 'LivresVoyageurs\Controller\OverviewController::newCaptureAction')
                ->method('GET|POST')
                # Route name
                ->bind('livresVoyageurs_newCapture');

            $controllers
                
                # Associate a route with a controller and an action
                ->get('/recherche', 'LivresVoyageurs\Controller\OverviewController::searchAction')
                # Route name
                ->bind('livresVoyageurs_search');

            #Contact
            $controllers
                            
                # Associate a route with a controller and an action
                ->match('/contact', 'LivresVoyageurs\Controller\OverviewController::contactAction')
                ->method('GET|POST')
                # Route name
                ->bind('livresVoyageurs_contact');

        // Return the controllers (ControllerCollection)
        return $controllers;
    }



}