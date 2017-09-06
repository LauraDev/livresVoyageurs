<?php
namespace LivresVoyageurs\Constraints;
use Symfony\Component\Validator\Constraint;
/**
* @Annotation
*/
class passConstraint extends Constraint{
    /*message when constraint failed*/
    public $message = 'Veuillez saisir 6 caractères minimum dont au moins un chiffre et une majuscule';
    public function validateBy(){
        return passConstraintValidator::class;
    }
}