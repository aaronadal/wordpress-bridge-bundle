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
 * @ORM\Table(name="posts")
 * @WordpressTable
 */
class Post extends AbstractPost
{

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"all"})
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_author", referencedColumnName="ID")
     * })
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="children")
     * @ORM\JoinColumn(name="post_parent", referencedColumnName="ID")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="PostMeta", mappedBy="post", indexBy="key", cascade={"all"})
     */
    private $metas;

    /**
     * @ORM\ManyToMany(targetEntity="Taxonomy", inversedBy="posts")
     * @ORM\JoinTable(name="term_relationships",
     *   joinColumns={
     *     @ORM\JoinColumn(name="object_id", referencedColumnName="ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="term_taxonomy_id", referencedColumnName="term_taxonomy_id")
     *   }
     * )
     */
    private $taxonomies;

    /**
     * {@inheritdoc}
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }

    /**
     * {@inheritdoc}
     */
    public function setComments(ArrayCollection $comments)
    {
        $this->comments = $comments;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthor(): AbstractUser
    {
        return $this->author;
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor(AbstractUser $author)
    {
        $this->author = $author;
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): AbstractPost
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(AbstractPost $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren(): ArrayCollection
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetas(): ArrayCollection
    {
        return $this->metas;
    }

    /**
     * {@inheritdoc}
     */
    public function setMetas(ArrayCollection $metas)
    {
        $this->metas = $metas;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxonomies(): ArrayCollection
    {
        return $this->taxonomies;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxonomies(ArrayCollection $taxonomies)
    {
        $this->taxonomies = $taxonomies;
    }
}
