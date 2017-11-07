<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="termmeta")
 * @WordpressTable
 */
class TermMeta extends AbstractTermMeta
{

    /**
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="metas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_id", referencedColumnName="term_id")
     * })
     */
    private $term;

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
    public function setTerm(AbstractTerm $term)
    {
        $this->term = $term;
    }
}
