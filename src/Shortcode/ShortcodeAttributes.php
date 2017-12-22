<?php

namespace Aaronadal\WordpressBridgeBundle\Shortcode;


/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class ShortcodeAttributes
{

    private $attributes;
    private $defaults;

    /**
     * Creates a new ShortcodeAttributes instance.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;
        $this->defaults   = [];
    }

    /**
     * Gets one parameter by its name. If the parameter is not set, the default is returned (see setDefaults method).
     * If no default is provided, $default is returned.
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->attributes[$name] ?? $this->defaults[$name] ?? $default;
    }

    /**
     * Sets the defaults values. Theese values are returned when the shortcode does not provide the requested
     * attribute.
     *
     * @param array $defaults
     */
    public function setDefaults($defaults)
    {
        $this->defaults = $defaults;
    }
}
