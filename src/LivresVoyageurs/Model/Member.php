<?php
namespace LivresVoyageurs\Model;

use Symfony\Component\Security\Core\User\UserInterface;

class Member implements UserInterface
{
    # Attributes
    private $id_members;
    private $pseudo_member;
    private $mail_member;
    private $pass_member;
    private $avatar_member;
    private $token_member;
    private $date_member;
    private $role_member;
    private $active_member;

    /**
     * @param int $id_members
     * @param string $pseudo_member
     * @param string $mail_member
     * @param string $pass_member
     * @param string $avatar_member
     * @param string $token_member
     * @param mixed $date_member
     * @param string $role_member
     * @param int $active_member
     */
    public function __construct(
        $id_members,
        $pseudo_member,
        $mail_member,
        $pass_member,
        $avatar_member,
        $token_member,
        $date_member,
        $role_member,
        $active_member
    ) {
        $this->id_members    = $id_members;
        $this->pseudo_member = $pseudo_member;
        $this->mail_member   = $mail_member;
        $this->pass_member   = $pass_member;
        $this->avatar_member = $avatar_member;
        $this->token_member  = $token_member;
        $this->date_member   = $date_member;
        $this->role_member   = $role_member;
        $this->active_member = $active_member;
    }

    /*getters*/

    /**
     * @return int
     */
    public function getId_members()
    {
        return $this->id_members;
    }

    /**
     * @return string
     */
    public function getPseudo_member()
    {
        return $this->pseudo_member;
    }

    /**
     * @return string
     */
    public function getMail_member()
    {
        return $this->mail_member;
    }

    /**
     * @return string
     */
    public function getPass_member()
    {
        return $this->pass_member;
    }

    /**
     * @return string
     */
    public function getAvatar_member()
    {
        return $this->avatar_member;
    }

    /**
     * @return string
     */
    public function getToken_member()
    {
        return $this->token_member;
    }

    /**
     * @return mixed
     */
    public function getDate_member()
    {
        return $this->date_member;
    }

    /**
     * @return string
     */
    public function getRole_member()
    {
        return $this->role_member;
    }

    /**
     * @return int
     */
    public function getActive_member()
    {
        return $this->active_member;
    }

    /*setters*/
    /**
     * @param mixed $id_members
     *
     * @return static
     */
    public function setId_members($id_members)
    {
        $this->id_members = $id_members;
        return $this;
    }

    /**
     * @param mixed $pseudo_member
     *
     * @return static
     */
    public function setPseudo_member($pseudo_member)
    {
        $this->pseudo_member = $pseudo_member;
        return $this;
    }

    /**
     * @param mixed $mail_member
     *
     * @return static
     */
    public function setMail_member($mail_member)
    {
        $this->mail_member = $mail_member;
        return $this;
    }

    /**
     * @param mixed $pass_member
     *
     * @return static
     */
    public function setPass_member($pass_member)
    {
        $this->pass_member = $pass_member;
        return $this;
    }

    /**
     * @param mixed $avatar_member
     *
     * @return static
     */
    public function setAvatar_member($avatar_member)
    {
        $this->avatar_member = $avatar_member;
        return $this;
    }

    /**
     * @param mixed $token_member
     *
     * @return static
     */
    public function setToken_member($token_member)
    {
        $this->token_member = $token_member;
        return $this;
    }

    /**
     * @param mixed $date_member
     *
     * @return static
     */
    public function setDate_member($date_member)
    {
        $this->date_member = $date_member;
        return $this;
    }

    /**
     * @param mixed $role_member
     *
     * @return static
     */
    public function setRole_member($role_member)
    {
        $this->role_member = $role_member;
        return $this;
    }

    /**
     * @param mixed $active_member
     *
     * @return static
     */
    public function setActive_member($active_member)
    {
        $this->active_member = $active_member;
        return $this;
    }

    # -------- Inherited methods from Interface --------#

    public function getPassword()
    {
        return $this->mail_member;
    }

    public function eraseCredentials() {}

    public function getSalt()
    {
        return null;
    }

    public function getRole()
    {
        return $this->role_member;
    }

    public function getUsername()
    {
        return $this->mail_member;
    }
}
