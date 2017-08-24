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
    * Database connection object
    * @param Idiorm $db
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
        # use LivresVoyageurs\Model\member;
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
    public function loadUserByUsername($mail_member)
    {
        $member = $this->_db->for_table('members')
                            ->where('mail_member', $mail_member)
                            ->find_one();

        if(empty($member)) {
            throw new UsernameNotFoundException(
                sprintf('Cet utilisateur "%s" n\'existe pas.', $mail_member));
        }

        return new Member($member->id_member, $member->pseudo_member,
            $member->mail_member, $member->pass_member, $member->avatar_member,
            $member->token_member,$member->date_member,$member->role_member,$member->active_member);
    }
}
