<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\Common\Collections\Collection;
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
     * @return AbstractPost[]|Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * Gets the Comments.
     *
     * @return AbstractComment[]|Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * Gets the Metas.
     *
     * @return AbstractUserMeta[]|Collection
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }
}
