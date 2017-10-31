<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="usermeta")
 * @WordpressTable(prefix_blog=false)
 */
class UserMeta extends AbstractUserMeta
{

    /**
     * @ORM\ManyToOne(targetEntity="Aaronadal\WordpressBridgeBundle\Entity\User", inversedBy="metas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="ID")
     * })
     */
    private $user;

    /**
     * Gets the User.
     *
     * @return AbstractUser
     */
    public function getUser(): AbstractUser
    {
        return $this->user;
    }

    /**
     * Sets the User.
     *
     * @param AbstractUser $user
     */
    public function setUser(AbstractUser $user)
    {
        $this->user = $user;
    }
}
