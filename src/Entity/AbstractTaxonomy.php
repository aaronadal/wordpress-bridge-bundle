<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractTaxonomy
{

    /**
     * @ORM\Id
     * @ORM\Column(name="term_taxonomy_id", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="taxonomy", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\Column(name="count", type="bigint", length=20, nullable=false)
     */
    private $count = 0;

    /**
     * Gets the Id.
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the Name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Sets the Name.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Gets the Description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the Description.
     *
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Gets the Count.
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Sets the Count.
     *
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = $count;
    }

    /**
     * Gets the Parent.
     *
     * @return AbstractTaxonomy|null
     */
    public abstract function getParent(): ?AbstractTaxonomy;

    /**
     * Sets the Parent.
     *
     * @param AbstractTaxonomy|null $parent
     */
    public abstract function setParent(?AbstractTaxonomy $parent);

    /**
     * Gets the Children.
     *
     * @return AbstractTaxonomy[]|Collection
     */
    public abstract function getChildren(): Collection;

    /**
     * Gets the Term.
     *
     * @return AbstractTerm
     */
    public abstract function getTerm(): AbstractTerm;

    /**
     * Sets the Term.
     *
     * @param AbstractTerm $term
     */
    public abstract function setTerm(AbstractTerm $term);

    /**
     * Gets the Posts.
     *
     * @return AbstractPost[]|Collection
     */
    public abstract function getPosts(): Collection;

    /**
     * Sets the Posts.
     *
     * @param AbstractPost[]|Collection $posts
     */
    public abstract function setPosts(Collection $posts);
}
