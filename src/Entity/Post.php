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
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * {@inheritdoc}
     */
    public function setComments(Collection $comments)
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
    public function getChildren(): Collection
    {
        return $this->children;
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
    public function getTaxonomies(): Collection
    {
        return $this->taxonomies;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxonomies(Collection $taxonomies)
    {
        $this->taxonomies = $taxonomies;
    }
}
