<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  MemberController
{

    //Display Chat Page
    public function chatAction(Application $app, $receiver) {

        # Define messages sender
        // $sender = $app['pseudo']; 
$sender = 'Lolo';
        
        return $app['twig']->render('member/chat.html.twig', [
            'receiver' => $receiver,
            'sender'   => $sender
        ]);
    }


    //Display Personal Space
    public function espacePersoAction(Application $app, $pseudo) {
        
        return $app['twig']->render('member/espacePerso.html.twig', [
            'pseudo' => $pseudo
        ]);
    }

}