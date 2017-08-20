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
        
        if( isset($app['pseudoAdmin']) ) 
        {
            # Page active pour le menu
            $app['current'] = 'Accueil';

            return $app['twig']->render('private/admin.html.twig', [
                'prenomAdmin' => $prenomAdmin
            ]);
        }
        else 
        {    
            # Page active pour le menu
            $app['current'] = 'Accueil';
            
            return $app->redirect($app['url_generator']->generate('livresVoyageurs_connexionAdmin'));
        }
    
    }

}
