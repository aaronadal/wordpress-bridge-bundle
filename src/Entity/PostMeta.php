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
 * @ORM\Table(name="postmeta")
 * @WordpressTable
 */
class PostMeta extends AbstractPostMeta
{

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="metas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="post_id", referencedColumnName="ID")
     * })
     */
    private $post;

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
}
