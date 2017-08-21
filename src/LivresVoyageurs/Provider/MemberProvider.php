<?php
namespace LivresVoyageurs\Provider;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use LivresVoyageurs\Model\Member;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

class MemberProvider implements UserProviderInterface
{
    
    private $_db;
    
    /**
    * Récupération de l'instance de la BDD
    * @param Idiorm ou Doctrine DBAL $db
    */
    public function __construct($db)
    {
        $this->_db = $db;
    }
    
    /**
    * {@inheritDoc}
    * @see \Symfony\Component\Security\Core\User\UserProviderInterface::supportsClass()
    */
    public function supportsClass($class)
    {
        return $class === 'LivresVoayageurs\Model\Member';
    }
    
    /**
    * {@inheritDoc}
    * @see \Symfony\Component\Security\Core\User\UserProviderInterface::refreshUser()
    */
    public function refreshUser(UserInterface $member)
    {
        # use LivresVoayageurs\Model\member;
        # On s'assure de bien avoir un Objet de la classe member
        if(!$member instanceof Member) {
            throw new UnsupportedUserException(
                sprintf('Les instances de "%s" ne sont pas autorisées.', 
                    get_class($member)));
        }
        
        return $this->loadUserByUsername($member->getUsername());
    }
    
    /**
    * {@inheritDoc}
    * @see \Symfony\Component\Security\Core\User\UserProviderInterface::loadUserByUsername()
    */
    public function loadUserByUsername($EMAIL)
    {
        $member = $this->_db->for_table('member')
                            ->where('EMAIL', $EMAIL)
                            ->find_one();
        
        if(empty($member)) {
            throw new UsernameNotFoundException(
                sprintf('Cet utilisateur "%s" n\'existe pas.', $EMAIL));
        }
        
        return new Member($member->ID, $member->NOM, 
            $member->PRENOM, $member->EMAIL, $member->MDP, 
            $member->ROLES);
    }
}