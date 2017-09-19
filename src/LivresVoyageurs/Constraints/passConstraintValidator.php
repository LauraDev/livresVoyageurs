<?php
namespace LivresVoyageurs\Constraints;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
class passConstraintValidator extends ConstraintValidator{
    /**
    * @inheritDoc
    * Validate constraint condition
    * @method validate
    * @param  string     $value
    * @param  Constraint $constraint
    */
    public function validate($value, Constraint $constraint){
        /*Regex: at least 8 caracters (at least 1 letter and 1 number)*/
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/',$value, $matches)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}