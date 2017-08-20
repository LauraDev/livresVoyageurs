<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  UserController
{

    //Affichage de la page d'accueil
    public function indexAction(Application $app) {

        # Page active pour le menu
        $app['current'] = 'Accueil';


        return $app['twig']->render('user/index.html.twig');
    }


    //Affichage de la page Inscriptiom
    public function inscriptionAction(Application $app) {

        
        # Page active pour le menu
        $app['current'] = 'Inscription';

        return $app['twig']->render('user/inscription.html.twig');
    }


    //Affichage de la page Connexion
    public function connexionAction(Application $app) {
    
        # Page active pour le menu
        $app['current'] = 'Connexion';

        return $app['twig']->render('user/connexion.html.twig');
    }


    //Affichage de l'espace personnel
    public function espacePersoAction(Application $app, $pseudo) {

        if( isset($app['pseudo']) ) 
        {
            # Page active pour le menu
            $app['current'] = 'Espace Personnel';
    
            return $app['twig']->render('user/espacePerso.html.twig', [
                'pseudo' => $pseudo
            ]);
        }
        else 
        {
            # Page active pour le menu
            $app['current'] = 'Connexion';
        
            return $app->redirect($app['url_generator']->generate('livresVoyageurs_connexion'));
        }
    }

    
    //Affichage du menu
    public function menu(Application $app) {
        
        # Page active pour le menu
        $current = ucfirst($app['current']);

        # Transmission à la vue
        return $app['twig']->render('menu.html.twig', [
            'current' => $current ]);
    }

}
