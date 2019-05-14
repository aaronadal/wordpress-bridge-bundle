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
 * @ORM\Table(name="posts")
 * @WordpressTable
 */
class Post extends AbstractPost
{

    /**
     * @var Collection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post", cascade={"all"})
     */
    private $comments;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_author", referencedColumnName="ID")
     * })
     */
    private $author;

    /**
     * @var Post|null
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="children")
     * @ORM\JoinColumn(name="post_parent", referencedColumnName="ID")
     */
    private $parent;

    /**
     * @var Collection|Post[]
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="parent")
     */
    private $children;

    /**
     * @var Collection|PostMeta[]
     *
     * @ORM\OneToMany(targetEntity="PostMeta", mappedBy="post", indexBy="key", cascade={"all"})
     */
    private $metas;

    /**
     * @var Collection|Taxonomy[]
     *
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
     *
     * @return Collection|Comment[]
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
     *
     * @return Post|null
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
     *
     * @return Post|null
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
     *
     * @return Collection|Post[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * {@inheritdoc}
     *
     * @return Collection|PostMeta[]
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }

    /**
     * {@inheritdoc}
     *
     * @return Collection|Taxonomy[]
     */
    public function getTaxonomies(?string $taxonomy = null): Collection
    {
        $collection = new ArrayCollection();
        foreach($this->taxonomies as $key => $tax) {
            if($tax->getName() === $taxonomy) {
                $collection[$key] = $tax;
            }
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function setTaxonomies(Collection $taxonomies)
    {
        $this->taxonomies = $taxonomies;
    }
}
