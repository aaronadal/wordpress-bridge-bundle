<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @WordpressTable(prefix_blog=false)
 */
class User extends AbstractUser
{

    /**
     * @ORM\OneToMany(targetEntity="Aaronadal\WordpressBridgeBundle\Entity\Post", mappedBy="author")
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="Aaronadal\WordpressBridgeBundle\Entity\Comment", mappedBy="user")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="Aaronadal\WordpressBridgeBundle\Entity\UserMeta", mappedBy="user", indexBy="key", cascade={"all"})
     */
    private $metas;

    /**
     * Gets the Posts.
     *
     * @return AbstractPost[]|ArrayCollection
     */
    public function getPosts(): ArrayCollection
    {
        return $this->posts;
    }

    /**
     * Gets the Comments.
     *
     * @return AbstractComment[]|ArrayCollection
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }

    /**
     * Gets the Metas.
     *
     * @return AbstractUserMeta[]|ArrayCollection
     */
    public function getMetas(): ArrayCollection
    {
        return $this->metas;
    }
}
