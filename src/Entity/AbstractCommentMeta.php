<?php

namespace Aaronadal\WordpressBridgeBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Entity
 *
 * @ORM\MappedSuperclass
 */
abstract class AbstractCommentMeta
{

    /**
     * @ORM\Id
     * @ORM\Column(name="meta_id", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="meta_key", type="string", length=255, nullable=true)
     */
    private $key;

    /**
     * @ORM\Column(name="meta_value", type="wp_serialized", nullable=true)
     */
    private $value;

    public function __construct(int $id = null)
    {
        $this->id = $id;
    }

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
     * Gets the Key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Sets the Key.
     *
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * Gets the Value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Sets the Value.
     *
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * Gets the Comment.
     *
     * @return AbstractComment
     */
    public abstract function getComment(): AbstractComment;

    /**
     * Sets the Comment.
     *
     * @param AbstractComment $comment
     */
    public abstract function setComment(AbstractComment $comment): void;
}
