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
abstract class AbstractTerm
{

    /**
     * @ORM\Id
     * @ORM\Column(name="term_id", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @ORM\Column(name="term_group", type="bigint", length=10, nullable=false)
     */
    private $group = 0;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

    /**
     * Gets the Id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the Name.
     *
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Gets the Taxonomy Description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getTaxonomy()->getDescription();
    }

    /**
     * Gets the Slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Sets the Slug.
     *
     * @param string $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Gets the Group.
     *
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Sets the Group.
     *
     * @param int $group
     */
    public function setGroup($group): void
    {
        $this->group = $group;
    }

    /**
     * Gets the Taxonomy.
     *
     * @return AbstractTaxonomy
     */
    public abstract function getTaxonomy(): AbstractTaxonomy;

    /**
     * Sets the Taxonomy.
     *
     * @param AbstractTaxonomy $taxonomy
     */
    public abstract function setTaxonomy(AbstractTaxonomy $taxonomy): void;

    /**
     * Gets the TermMetas.
     *
     * @return Collection|AbstractTermMeta[]
     */
    public abstract function getMetas(): Collection;

    /**
     * Sets the Metas.
     *
     * @param Collection|AbstractTermMeta[] $metas
     */
    public abstract function setMetas(Collection $metas): void;

    /**
     * Gets one Meta by key.
     *
     * @param $key
     *
     * @return AbstractTermMeta|null
     */
    public function getMeta($key): ?AbstractTermMeta
    {
        foreach ($this->getMetas() as $meta) {
            if($meta->getKey() === $key) {
                return $meta;
            }
        }

        return null;
    }
}
