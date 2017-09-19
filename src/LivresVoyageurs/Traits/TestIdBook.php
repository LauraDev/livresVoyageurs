<?php

namespace LivresVoyageurs\Traits;

use Silex\Application;


trait TestIdBook {


    public function isUsed(Application $app, $generateIdBook)
    {
        $generateIdBookDB = $app['idiorm.db']->for_table('books')
                                                ->find_one($generateIdBook);
        if ($generateIdBookDB < 1) 
        {
            return false;
        } 
        else 
        {
            // Already a duplicate key, return TRUE to continue the loop
            return true;
        }
    }
}