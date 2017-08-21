<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  ChatController
{

    //Display Chat Page
    public function chatAction(Application $app, $receiver) {

        # Define messages sender
        // $sender = $app['pseudo'];
$sender = 'Lolo';
        
        return $app['twig']->render('chat/chat.html.twig', [
            'receiver' => $receiver,
            'sender'   => $sender
        ]);
    }

}