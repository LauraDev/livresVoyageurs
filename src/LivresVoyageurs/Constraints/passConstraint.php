<?php

namespace LivresVoyageurs\Constraints;
use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class passConstraint extends Constraint{

    /*message when constraint failed*/
    public $message = '8 caractères minimum dont au moins un chiffre et une lettre';

    public function validateBy(){
        return passConstraintValidator::class;
    }
}
