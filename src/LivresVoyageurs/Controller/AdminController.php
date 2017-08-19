<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  AdminController
{

    //Affichage de la page d'accueil
    public function connexionAdminAction(Application $app) {
        
        # Page active pour le menu
        $app['current'] = 'Connexion Admin';
        
        return $app['twig']->render('private/connexionAdmin.html.twig');
    }


    //Affichage de la page d'accueil
    public function administrateurAction(Application $app, $prenomAdmin) {
        
        # Page active pour le menu
        $app['current'] = 'Accueil';

        return $app['twig']->render('private/admin.html.twig', [
            'prenomAdmin' => $prenomAdmin
        ]);
    }

}
