<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class  UserController
{

    //Display Home page
    public function indexAction(Application $app) {

        return $app['twig']->render('user/index.html.twig');
    }


    //Display Inscription page
    public function inscriptionAction(Application $app) {

        return $app['twig']->render('user/inscription.html.twig');
    }


    //Display Connexion page
    public function connexionAction(Application $app, Request $request) {

        return $app['twig']->render('user/connexion.html.twig',[
            'error'         => $app['security.last_error']($request),
            'last_username' => $app['session']->get('_security.last_username')
        ]);
    }

    // Display mentions page
    public function mentionsAction(Application $app){
        return $app['twig']->render('user/mentions.html.twig');
    }

    // Contact
    public function contactAction(Application $app){
        return $app['twig']->render('user/contact.html.twig');
    }


    //Display the menu
    public function menu(Application $app, $active_page) {

        return $app['twig']->render('menu.html.twig', [
            'active_page' => $active_page ]);
    }

    //Disconnection
    public function deconnexionAction(Application $app) {
        # Empty Session
        $app['session']->clear();
        # Redirect to Home
        return $app->redirect( $app['url_generator']->generate('livresVoyageurs_home') );
    }


}
