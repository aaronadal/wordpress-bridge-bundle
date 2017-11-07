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
 * @ORM\Table(name="comments")
 * @WordpressTable
 */
class Comment extends AbstractComment
{

    /**
     * @ORM\OneToOne(targetEntity="Comment", inversedBy="child")
     * @ORM\JoinColumn(name="comment_parent", referencedColumnName="comment_ID")
     */
    private $parent;

    /**
     * @ORM\OneToOne(targetEntity="Comment", mappedBy="parent")
     */
    private $child;

    /**
     * @ORM\OneToMany(targetEntity="CommentMeta", mappedBy="comment", indexBy="key")
     */
    private $metas;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comment_post_ID", referencedColumnName="ID", nullable=false)
     * })
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="ID")
     * })
     */
    private $user;

    /**
     * {@inheritdoc}
     */
    public function getChild(): ?Comment
    {
        return $this->child;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?AbstractComment
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(AbstractComment $parent)
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getPost(): AbstractPost
    {
        return $this->post;
    }

    /**
     * {@inheritdoc}
     */
    public function setPost(AbstractPost $post)
    {
        $this->post = $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getUser(): ?AbstractUser
    {
        return $this->user;
    }

    /**
     * {@inheritdoc}
     */
    public function setUser(AbstractUser $user)
    {
        $this->user = $user;
    }
}
