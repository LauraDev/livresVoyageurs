<?php

namespace LivresVoyageurs\Controller\Provider;

use Silex\Api\ControllerProviderInterface;


// Implémentation de l'interface Controller Provider
// L'interface fait le lien entre les routes et l'application
class UserControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {
        # Créer une instance de Silex\ControllerCollection
        $controllers = $app['controllers_factory'];


            # Page d'accueil
            $controllers

                # On asscie une route à un controller et une action
                ->get('/', 'LivresVoyageurs\Controller\UserController::indexAction')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_home');




            # Page d'inscription
            $controllers

                # On asscie une route à un controller et une action
                ->get('/inscription', 'LivresVoyageurs\Controller\UserController::inscriptionAction')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_inscription');


            # Page de connexion
            $controllers

                # On asscie une route à un controller et une action
                ->get('/connexion', 'LivresVoyageurs\Controller\UserController::connexionAction')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_connexion');


            # Espace Personnel
            $controllers
            
                # On asscie une route à un controller et une action
                ->get('/espace_personnel/{pseudo}', 'LivresVoyageurs\Controller\UserController::espacePersoAction')
                # Spécifier le type de parametre attendu avec une Regex
                ->assert('pseudo' , '[^/]+')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_espace_personnel');


        // On retourne la liste des controllers (ControllerCollection)
        return $controllers;
    }

}
