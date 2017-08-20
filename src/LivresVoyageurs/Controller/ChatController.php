<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  ChatController
{

    //Display page: Chat
    public function chatAction(Application $app, $receiver) {
        
        # Active page for the menu
        $app['current'] = 'Chat';

        # Define messages sender
        // $sender = $app['pseudo'];
$sender = 'Loic';
        
        return $app['twig']->render('chat/chat.html.twig', [
            'receiver' => $receiver,
            'sender'   => $sender
        ]);
    }

}