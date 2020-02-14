<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="children")
     * @ORM\JoinColumn(name="comment_parent", referencedColumnName="comment_ID")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="parent")
     */
    private $children;

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

    public function __construct(int $id = null)
    {
        parent::__construct($id);

        $this->metas = new ArrayCollection();
        $this->children = new ArrayCollection();
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
    public function setParent(AbstractComment $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function setChildren(Collection $children): void
    {
        $this->children = $children;
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
    public function setMetas(Collection $metas): void
    {
        $this->metas = $metas;
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
    public function setPost(AbstractPost $post): void
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
    public function setUser(?AbstractUser $user): void
    {
        $this->user = $user;
    }
}
