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
 * @ORM\Table(name="terms")
 * @WordpressTable
 */
class Term extends AbstractTerm
{

    /**
     * @ORM\OneToOne(targetEntity="Aaronadal\WordpressBridgeBundle\Entity\Taxonomy", mappedBy="term")
     */
    private $taxonomy;

    /**
     * @ORM\OneToMany(targetEntity="TermMeta", mappedBy="term", indexBy="key", cascade={"all"})
     */
    private $metas;

    public function __construct(int $id = null)
    {
        parent::__construct($id);

        $this->metas = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxonomy(): AbstractTaxonomy
    {
        return $this->taxonomy;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetas(): Collection
    {
        return $this->metas;
    }
}
