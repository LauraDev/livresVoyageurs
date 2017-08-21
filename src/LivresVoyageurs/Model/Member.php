<?php
namespace LivresVoyageurs\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class Member implements UserInterface
{
    # Définition des Propriétés
    private $ID,
            $NOM,
            $PRENOM,
            $EMAIL,
            $MDP,
            $ROLES;
    
    /**
    * Création d'un Objet 
    * @param Entier  $ID
    * @param String  $NOM
    * @param String  $PRENOM
    * @param String  $EMAIL
    * @param String  $MDP
    * @param String  $ROLES
    */
    public function __construct(
        $ID,
        $NOM,
        $PRENOM,
        $EMAIL,
        $MDP,
        $ROLES)
    {
        $this->ID         = $ID;
        $this->NOM        = $NOM;
        $this->PRENOM     = $PRENOM;
        $this->EMAIL      = $EMAIL;
        $this->MDP        = $MDP;
        $this->ROLES[]    = $ROLES;
    }


    # -------- Getters --------#
    
    
    /**
    * @return the $ID
    */
    public function getID()
    {
        return $this->ID;
    }

    /**
    * @return the $NOM
    */
    public function getNOM()
    {
        return $this->NOM;
    }

    /**
    * @return the $PRENOM
    */
    public function getPRENOM()
    {
        return $this->PRENOM;
    }

    /**
    * @return the $EMAIL
    */
    public function getEMAIL()
    {
        return $this->EMAIL;
    }

    /**
    * @return the $MDP
    */
    public function getMDP()
    {
        return $this->MDP;
    }

    /**
    * @return the $ROLES
    */
    public function getROLES()
    {
        return $this->ROLES;
    }
    
    # -------- Méthodes Héritées de l'Interface --------#
    
    public function getPassword()
    {
        return $this->MDP;
    }

    public function eraseCredentials() {}

    public function getSalt() { return null; }

    public function getRole()
    {
        return $this->ROLES;
    }

    public function getUsername()
    {
        return $this->EMAIL;
    }
}

