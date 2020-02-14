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
abstract class AbstractOption
{

    /**
     * @ORM\Id
     * @ORM\Column(name="option_id", type="wp_id", length=20, nullable=false)
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(name="option_name", type="string", length=191, nullable=false)
     */
    private $key;

    /**
     * @ORM\Column(name="option_value", type="wp_serialized", nullable=false)
     */
    private $value;

    /**
     * @ORM\Column(name="autoload", type="wp_statement", length=20, nullable=false)
     */
    private $autoload = true;

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
     * Gets the Autoload.
     *
     * @return bool
     */
    public function isAutoload(): bool
    {
        return $this->autoload;
    }

    /**
     * Sets the Autoload.
     *
     * @param bool $autoload
     */
    public function setAutoload(bool $autoload): void
    {
        $this->autoload = $autoload;
    }
}
