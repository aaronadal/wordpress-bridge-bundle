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
 * @ORM\Table(name="term_taxonomy")
 * @WordpressTable
 */
class Taxonomy extends AbstractTaxonomy
{

    /**
     * @ORM\ManyToOne(targetEntity="Taxonomy", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="term_taxonomy_id")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Taxonomy", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\OneToOne(targetEntity="Term", inversedBy="taxonomy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_id", referencedColumnName="term_id", unique=true)
     * })
     */
    private $term;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="taxonomies")
     */
    private $posts;

    public function __construct(int $id = null)
    {
        parent::__construct($id);

        $this->children = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(): ?AbstractTaxonomy
    {
        return $this->parent;
    }

    /**
     * {@inheritdoc}
     */
    public function setParent(?AbstractTaxonomy $parent = null): void
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
    public function getTerm(): AbstractTerm
    {
        return $this->term;
    }

    /**
     * {@inheritdoc}
     */
    public function setTerm(AbstractTerm $term): void
    {
        $this->term = $term;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosts(Collection $posts): void
    {
        $this->posts = $posts;
    }
}
