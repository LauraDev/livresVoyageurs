<?php

namespace LivresVoyageurs\Controller;

use Silex\Application;

class  AdminController
{

    //Display Administation Page
    public function administrateurAction(Application $app, $pseudoAdmin) {

        return $app['twig']->render('private/admin.html.twig', [
            'pseudoAdmin' => $pseudoAdmin
        ]);
    }

}
