<?php

namespace LivresVoyageurs\Controller\Provider;

use Silex\Api\ControllerProviderInterface;


// Implémentation de l'interface Controller Provider
// L'interface fait le lien entre les routes et l'application
class ChatControllerProvider implements ControllerProviderInterface
{

    public function connect(\Silex\Application $app)
    {

        # Créer une instance de Silex\ControllerCollection
        $controllers = $app['controllers_factory'];
        
        # Chat
        $controllers
        
            # On asscie une route à un controller et une action
            ->get('/{receiver}', 'LivresVoyageurs\Controller\ChatController::chatAction')
            # Spécifier le type de parametre attendu avec une Regex
            ->assert('receiver' , '[^/]+')
            # Nom de la route qui servira plus tard à la création de lien
            ->bind('livresVoyageurs_chat');


        // On retourne la liste des controllers (ControllerCollection)
        return $controllers;
    }

}