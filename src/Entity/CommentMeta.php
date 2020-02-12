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
 * @ORM\Table(name="commentmeta")
 * @WordpressTable
 */
class CommentMeta extends AbstractCommentMeta
{

    /**
     * @ORM\ManyToOne(targetEntity="Comment", inversedBy="metas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comment_id", referencedColumnName="comment_ID")
     * })
     */
    private $comment;

    /**
     * {@inheritdoc}
     */
    public function getComment(): AbstractComment
    {
        return $this->comment;
    }

    /**
     * {@inheritdoc}
     */
    public function setComment(AbstractComment $comment): void
    {
        $this->comment = $comment;
    }
}
