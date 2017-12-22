<?php

namespace Aaronadal\WordpressBridgeBundle\Shortcode;


/**
 * Base class for creating shortcodes.
 *
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
abstract class AbstractShortcode implements ShortcodeInterface
{

    private $parser;

    /**
     * Sets the parser. It allows you to parse shortcodes inside your shortcodes.
     *
     * @param ShortcodeParser
     */
    public function setShortcodeParser(ShortcodeParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @return ShortcodeParser
     */
    public function getShortcodeParser()
    {
        return $this->parser;
    }

    /**
     * Parses the shortcodes in the provided string.
     *
     * @param string $content
     *
     * @return string
     */
    public function parseShortcodes($content)
    {
        return $this->getShortcodeParser()->parseShortcodes($content);
    }
}
