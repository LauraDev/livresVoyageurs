<?php

namespace LivresVoyageurs\Controller\Provider;

use Silex\Api\ControllerProviderInterface;


// Implémentation de l'interface Controller Provider
// L'interface fait le lien entre les routes et l'application
class AdminControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {
        # Créer une instance de Silex\ControllerCollection
        $controllers = $app['controllers_factory'];


            # Page Connexion Admin
            $controllers

                # On associe une route à un controller et une action
                ->get('/connexionAdmin', 'LivresVoyageurs\Controller\AdminController::connexionAdminAction')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_connexionAdmin');


            # Page Administrateur
            $controllers

                # On associe une route à un controller et une action
                ->get('/admin/{prenomAdmin}', 'LivresVoyageurs\Controller\AdminController::administrateurAction')
                # Nom de la route qui servira plus tard à la création de lien
                ->bind('livresVoyageurs_administrateur');

        // On retourne la liste des controllers (ControllerCollection)
        return $controllers;
    }



}
